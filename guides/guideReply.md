# Reageren op een thread

Het proces begint in `routes.php`, waar ergens onder de regel

```php
Route::group(['prefix' => 'forum', middleware => ['auth', 'approved']], function() {
```

de regel

```php
Route::post('{slug}',    'ForumRepliesController@postCreateReply');
```

staat. M.a.w., de functie `postCreateReply()` wordt aangeroepen in `ForumRepliesController.php`.
`{slug}` (een korte titel van een topic/thread) uit de regel in `routes.php` wordt `$threadSlug` (het tweede argument van
`postCreateReply()`) in `ForumRepliesController.php`. Het eerste argument van `postCreateReply()`,
`$validator`, wordt automatisch gecreëerd zodra `postCreateReply()` wordt aangeroepen.
(Dat proces heet _dependency injection_.) In `postCreateReply()` wordt eerst een
geïndexeerde array (array met strings als keys) genaamd `$data` aangemaakt die de
`$threadslug`, het id van het user-object van de `Auth` class (d.w.z. het id van
de gebruiker die de reply heeft gepost) en de info die de functie `get('body')`
uit de `Input` class retourneert (d.w.z. de reply) opslaat.  
Vervolgens wordt de `validate()`-functie van het `$validator`-object gebruikt
om ervoor te zorgen dat `$data` (en vooral de reply daarin) geen gekke tekens
of pogingen tot cross-site scripting attacks o.i.d. bevat.  

### ReplyToThreadCommandHandler

Daarna komt de magie. Met behulp van de functie `dispatchFromArray()` worden de
elementen van de `$data` array als argumenten naar de constructorfunctie van het
object dat met `ReplyToThreadCommand::class` wordt aangemaakt gestuurd. In die
constructorfunctie worden de elementen van `$data` overgezet naar de properties
van het `ReplyToThreadCommand` object. Dat is alles wat `ReplyToThreadCommand`
doet: het is een wrapper voor de informatie in `$data`. Vervolgens wordt op magische
wijze een `ReplyToThreadCommandHandler` object aangemaakt, waarbij natuurlijk
eerst de constructorfunctie van `ReplyToThreadCommandHandler` wordt uitgevoerd.
Deze stopt een `ThreadRepository` en `ReplyRepository` (die je kan zien als
de verzamelingen van alle topics en alle reacties die het forum rijk is (het zijn
objecten die verbonden zijn aan de `forum_threads`- en `forum_replies`-tabellen
in de database)) in de
properties `$replies` en `$threads` van het `ReplyToThreadCommandHandler` object,
respectievelijk. Als de constructorfunctie dat heeft gedaan, wordt automatisch
`handle()` aangeroepen, waarvan ons `ReplyToThreadCommand` object een argument is
in de vorm van `$command`. De functie `requireBySlug()` filtert uit alle threads
in `$threads` de thread met de slug `$threadSlug`, die vervolgens in `$thread`
wordt gestopt. Diens id (`$thread->id`) wordt samen met `$command->authorId` en
`$command->body` gebruikt om een object te maken die je kunt zien als een row in
de `forum_replies`-tabel d.m.v. de `getNew()`-functie. Dit object wordt vervolgens
in `$reply` gestopt en in de database opgeslagen met `save()`. Ten slotte wordt
een nieuw evenementsobject gelanceerd, genaamd `threadWasRepliedTo`, met `$thread` en
`$reply` als argumenten naar de constructor van het evenementsobject. Ergens in
de code zit een functie die ziet dat dat evenement is afgevuurd en de daaraan meegegeven
data (`$thread` en `$reply`) gebruikt om forumgebruikers te laten weten dat iemand
op een bepaalde thread geantwoord heeft.
