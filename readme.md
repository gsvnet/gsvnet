# GSVnet 3.x how-to
GSVnet is gemaakt met [Laravel 5](http://laravel.com/) als server-side framework. De front-end is vrij traditionele HTML5, CSS3 en JavaScript. De CSS wordt geschreven door middel van [SASS](http://sass-lang.com/) om het modulair te maken, en de JavaScript is min of meer opgesplitst per pagina. [Gulp](http://gulpjs.com/) zorgt ervoor dat SASS wordt omgezet in CSS, de JavaScriptbestanden worden samengevoegd, en dat alle CSS en JavaScript wordt geminified tot een klein bestand.

## Een lokale kopie draaien
Voor het testen is het noodzakelijk om een lokale kopie van de site te draaien. Ik werk zelf met Vagrant + Homestead op basis van VirtualBox. VirtualBox maakt een virtuele machine aan die heel vergelijkbaar is met de productie-omgeving (GSVnet draait momenteel op een Ubuntu 14 LTS server). Een virtuele machine moet je zien als een OS binnen het OS waar je op zit. Vagrant maakt het makkelijk om met een script het hele OS vol te zetten met de nodige programma's (zoals MySQL, PHP, nginx etc) om een server te simuleren. Homestead is dan dat script. 

Het installeren is het beste beschreven op de site van Laravel zelf: http://laravel.com/docs/5.1/homestead

Als het installeren is gelukt is het tijd om een kopie van de site te downloaden. Dat gaat door middel van Git (versiebeheer software): https://bitbucket.org/harmenstoppels/gsvnet. Maak op je computer op een geschikte plek een mapje `websites` of iets dergelijks. Ga daarin en voer het commando `git clone git@bitbucket.org:harmenstoppels/gsvnet.git`. Dat maakt het mapje `gsvnet` aan, met daarin de hele eigen code. Ga dat mapje in en kopieer het bestand `.env.example` naar `.env`. Dit bestandje bevat alle omgevingsvariabelen die niet met de buitenwereld worden gedeeld (zoals wachtwoorden of lokale instellingen). Het voorbeeld .env-file hoef je hoef je niet echt aan te passen.

Pas vervolgens het `Homestead.yaml` file aan zoals beschreven staat in de documentatie van Laravel over Homestead (https://laravel.com/docs/5.3/homestead#configuring-homestead) Iets wat niet in de tutorial staat maar wel belangrijk is: zorg dat de namen en locatie van de ssh sleutels in het Homestead.yaml file (standaard ~/.ssh/id_rsa.pub en ~/.ssh/id_rsa) overeen komen met de namen en locatie van de ssh sleutel op je computer, in het geval je geen ssh sleutels op je computer hebt moet je ze aanmaken, want je hebt ze nodig om in te loggen in de virtuele machine. Run `vagrant destroy` en `vagrant up` of iets beters uit de documentatie vanuit de Homestead map om het lokale gsvnet bereikbaar te maken voor de virtuele machine. Dat eenmaal gedaan, log je via `ssh` in op de virtuele machine (`vagrant ssh`) en voer je de volgende commando's uit in de `~/gsvnet`-map.

1. `composer install` om alle externe dependencies van het project automatisch te downloaden (superhandig!)
2. `php artisan migrate` om de database in te stellen
3. `php artisan db:seed` om de database te vullen met random data, zodat je dat zelf niet hoeft te doen
4. `npm install` om alle Javascript-ontwikkelaarsdependencies te installeren (geeft dit een protocol error symlink (als je bijvoorbeeld vagrant vanaf windows draait) dan kun je de tag '--no-bin-links' gebruiken om symlinks uit te zetten)
5. `bower install` om de front-end dependencies te downloaden (zoals jQuery e.d.)
5. `gulp` om het filesystem te watchen, zodat elke verandering van een SASS of JavaScript-bestand gelijk een nieuwe build van geminifiede CSS en JavaScript triggert (ook superhandig!).

## Versiebeheer met Git
Heel belangrijk voor het ontwikkelen is Git. Git is een heel uitgebreide versiebeheertool met een simpele interface, die de hele wereld gebruikt (en zou moeten gebruiken). Het idee erachter is om *veranderingen* in bestanden op te slaan, en niet (alleen) de huidige versie. Dus stel je verandert een bestand, dan weet Git waar de veranderingen hebben plaatsgevonden, en kun jij die veranderingen toelichten met een klein berichtje. Globaal kun je uit de voeten met deze commando's in Git:

1. `git add [bestand]` om veranderde bestanden sinds de vorige commit in de lijst te zetten voor de volgende commit
2. `git commit -m "[hier je toelichting]"` om die lijst bestanden van 1. daadwerkelijk te committen
3. `git pull origin master` om veranderingen (=commits van anderen of je andere computer) te mergen met jouw lokale code
4. `git push origin master` om commits van jouzelf naar de server te sturen, zodat anderen kunnen pullen.

De server waar GSVnet op draait gebruikt zelf ook Git om nieuwe versies van GSVnet te online te zetten. Dit moet overigens wel handmatig.

## Het domeinmodel
In dit stuk licht ik een paar domein-gerelateerde (gerelateerd aan de GSV) programmeerzaken toe. Hiermee bedoel ik de manier waarop geprobeerd is de GSV te modelleren via de code. Vrij centraal is het `User` model, dat te vinden is in `GSVnet\Users\User`. Een `User` model bevat minimale informatie, zoals een emailadres en wachtwoord om in te loggen en een volledige naam. Er is een aantal verschillende soorten `User`s voor GSVnet, namelijk:

1. Gasten `User::VISITOR`. Kan berichten plaatsen op het externe forum.
2. Potentials `User::POTENTIAL`. Heeft zich aangemeld via het word lid-formulier en heeft een GSV-profiel
3. Leden `User::MEMBER`. Kan intern en heeft eigen profiel. Staat vermeld in de jaarbundel.
4. Oud-leden `User::FORMERMEMBER`. Kan intern en heeft een eigen profiel.
5. Commissies `User::COMMITTEE`. Kan ook intern, maar staat niet in de jaarbundel.

Al deze types gebruikers kunnen inloggen op GSVnet. Een `User` van het type `POTENTIAL`, `MEMBER` en `FORMERMEMBER` is 1 op 1 gekoppeld met een `GSVnet\Users\Profiles\UserProfile`. Daarin staan allerlei specifieke (GSV-gerelateerde) persoonsgegevens. Een `UserProfile` is ∞ op 1 gekoppeld aan een `GSVnet\Users\YearGroup`. Dat model representeert een jaarverband. N.B.: dit is de enige plek waarop de koppeling via `UserProfile` gaat, op alle andere plekken wordt gekoppeld met het unieke `id` van een `User`.

Verder kan een `User` gekoppeld worden aan één of meerdere senaten (`GSVnet\Senates\Senate`). Voor de functie in een senaat wordt een nummer gebruikt, namelijk:

    1 → Praeses,
    2 → Abactis,
    3 → Fiscus,
    4 → Assessor Primus,
    5 → Assessor Secundus
    
    (ook te vinden in config/gsvnet.php)

Op een vergelijkbare wordt een `User` gekoppeld aan een commissie (`GSVnet\Committees\Committee`). In die koppeling wordt ook bijgehouden vanaf en tot wanneer iemand in een bepaalde commissie zit. Dit is erg belangrijk, omdat hier ook rechten aan ontleend worden. Zie ook het kopje Het permissiesysteem.

Tenslotte heeft een `User` ook een ∞ op ∞ met zichzelf, waarmee GSV-familiegegevens worden geregistreerd.

-----

Verder is er nog een aantal modellen dat niet direct te maken heeft met de GSV, namelijk `File` voor een geüploaded bestand in GSVdocs, `Album` voor een fotoalbum, `Photo` voor een losse foto in een album, `Threat` voor een forumtopic en `Reply` voor een reactie op een topic. Daarnaast is er `GSVnet\Forum\Like` dat zowel een like op een `Threat` als een `Reply` representeert. Zo'n `Like` is natuurlijk van een `User`.

## Het permissiesysteem
Een `User` ontleent zijn rechten aan drie dingen, namelijk zijn type (zie de lijst boven), zijn actieve lidmaatschappen van commissies en huidige senatorschap. Iemand die gebruiker type `MEMBER` is kan bijvoorbeeld intern berichten plaatsen op het forum, maar kan niet noodzakelijk foto's uploaden. Daarvoor moet diegene (op het moment van schrijven) in de reebocie, de webcie of de prescie zitten. Een ander voorbeeld is het recht om iemand anders profiel bij te werken, daarvoor moet je senator zijn of in de webcie, novcie of malversacie zitten.

Elk recht heeft een unieke naam (zoals `users.manage`) die te vinden is in `config/permissions.php`. Daarin wordt ook geregistreerd wie die permissies heeft. Standaard heeft geen enkele user die, tenzij hij aan één van die eisen voldoet. Voor commissies geldt dat de slug-naam wordt gebruikt. Dat is dezelfde naam die in de URL wordt gebruikt als je de commissies doorklikt.

## Design Patterns
Als je aan de slag wil gaan met GSVnet is het handig om een paar dingetjes van het backend-ontwerp te weten. De mooist geschreven code is die van het forum, vooral omdat die code het concept van de Command Bus gebruikt. Dat is dus de code die je het beste kunt bestuderen nadat je wat tutorials over Laravel hebt gezien.

Heel in het kort komt dat hier op neer: er wordt een commando (Command) gemaakt in de vorm van een klasse, waarvan de naam duidelijk de intentie aangeeft (bijvoorbeeld `ReplyToThreadCommand`). Dit Command zou vanuit elke plek in het project kunnen worden gedispatched, zoals dat heet. In ons geval wordt dit alleen gedaan vanuit de `ForumRepliesController` als iemand een formulier verstuurd heeft. Het ReplyToThreadCommand is een heel kleine klasse die alleen de relevante informatie bevat:
```php
class ReplyToThreadCommand extends Command {

    public $threadSlug;
    public $authorId;
    public $reply;

    public function __construct($threadSlug, $authorId, $reply)
	{
        $this->threadSlug = $threadSlug;
        $this->authorId = $authorId;
        $this->reply = $reply;
    }
}
```
    
Vervolgens is er een Command Handler die het Command daadwerkelijk afhandelt en alle logica doet:
```php
class ReplyToThreadCommandHandler {

    private $replies;
    private $threads;

    function __construct(ThreadRepository $threads, ReplyRepository $replies)
    {
        $this->replies = $replies;
        $this->threads = $threads;
    }

	public function handle(ReplyToThreadCommand $command)
	{
        $threadId = $this->threads->getIdBySlug($command->threadSlug);

        $reply = $this->replies->getNew([
            'thread_id' => $threadId,
            'author_id' => $command->authorId,
            'body' => $command->reply
        ]);

        $this->replies->save($reply);

        event(new ThreadWasRepliedTo($threadId, $reply->id));
	}
}
```
    
In de functie `handle` wordt het Command-object doorgestuurd, en wordt allereerst het `id` van het topic erbij gezocht. Vervolgens wordt een nieuwe `Reply` aangemaakt. Deze wordt opgeslagen via een Repository; een repository is een klasse die zorgt dat queries aan en persistence naar de database wordt gedaan (en maakt de code een stukje mooier). Tenslotte wordt er een nieuwe Event aangemaakt, met een naam in de verleden tijd omdat het refereert naar een feit dat al heeft plaatsgevonden, namelijk `ThreadWasRepliedTo` met relevante informatie.

Nu is er een Event Listener met de naam `UpdateThreadDetails` die dit feit oppikt en er wat mee doet. In ons geval is het vrij simpel: in het `Thread`-model van het topic waarop gereageerd is wordt het veld `reply_count` met 1 opgehoogd. Dat wordt gedaan omdat we niet elke keer willen berekenen hoeveel reacties er op een topic is -- zeker niet als er 1000+ reacties zijn. Het is dus een vorm van caching.

Je vraagt je natuurlijk af waarom bovenstaande op een andere plek wordt afgehandeld. Daarvoor zijn verschillende redenen:

1. Het Command heet `ReplyToThread` en moet dus niets meer doen dan die taak (single responsibility)
2. Het is prima als het commando succesvol wordt uitgevoerd, terwijl het `reply_count` ophogen mislukt. Dan is het commando nog steeds geslaagd. Als het `reply_count` afhandelen gebeurde achterin de `handle`-functie en mislukte, zou het raar zijn om te zeggen dat het commando `ReplyToThread` mislukt is, want er is wel degelijk gereageerd op het topic; alleen het optellen is verkeerd gegaan.
3. Het ophogen van `reply_count` is niet iets waar de GSV'er op hoeft te wachten. Dit kan asynchroon op de achtergrond worden uitgevoerd, terwijl alvast de nieuwe pagina met de reactie voor de GSV'er wordt gerenderd. Dit gebeurt dat ook echt op de site door middel van queueing van de event handler.

De laatste truc wordt ook gebruikt bij het versturen van mailtjes. Dat is proces dat al gauw een seconde duurt en niet relevant is voor het renderen van de volgende pagina. Oftewel: de gebruiker hoeft er niet op te wachten en het kan dus net zo goed op de achtergrond worden uitgevoerd.

## Statistiekjes die je eens moet proberen

**Laatste forumbezoeken en aantal gelezen topics per persoon**

```sql
SELECT 
    u.firstname AS voornaam, 
    u.middlename AS tussenvoegsel, 
    u.lastname AS achternaam,
    yg.name AS jaarverband,
    MAX(DATE(ftv.visited_at)) AS laatste_bezoek,
    COUNT(ftv.user_id) AS totaal_aantal_topics_bekeken
FROM forum_thread_visitations AS ftv
INNER JOIN users AS u ON u.id = ftv.user_id
INNER JOIN user_profiles AS up ON up.user_id = u.id
INNER JOIN year_groups AS yg ON yg.id = up.year_group_id
GROUP BY ftv.user_id
ORDER BY laatste_bezoek DESC, yg.year DESC
LIMIT 500
```

**Likes van een reactie**

```sql
SELECT u.username
FROM likeable_likes AS ll
LEFT JOIN users AS u ON u.id = ll.user_id
WHERE ll.likable_id = 340884
AND ll.likable_type = 'GSVnet\\Forum\\Replies\\Reply'
```

```sql
-- Select number of likes received per year group
SELECT count(1) AS likes_received, yg.name, yg.year
FROM likeable_likes as ll
INNER JOIN forum_replies as fr
ON fr.id = ll.likable_id
INNER JOIN user_profiles as up
ON fr.author_id = up.user_id
INNER JOIN year_groups as yg
ON yg.id = up.year_group_id
WHERE ll.likable_type = 'GSVnet\\Forum\\Replies\\Reply'
GROUP BY yg.id
ORDER BY likes_received DESC;

-- Select number of likes given by year group
SELECT count(1) AS likes_given, yg.name, yg.year
FROM likeable_likes as ll
INNER JOIN user_profiles as up
ON ll.user_id = up.user_id
INNER JOIN year_groups as yg
ON yg.id = up.year_group_id
WHERE ll.likable_type = 'GSVnet\\Forum\\Replies\\Reply'
GROUP BY yg.id
ORDER BY likes_given DESC;
```

```sql
-- Select number of likes received per region
SELECT up.region, count(1) AS likes_received
FROM likeable_likes AS ll
INNER JOIN forum_replies AS fr
ON fr.id = ll.likable_id
INNER JOIN user_profiles AS up
ON fr.author_id = up.user_id
WHERE ll.likable_type = 'GSVnet\\Forum\\Replies\\Reply'
GROUP BY up.region;

-- Select number of likes given per region
SELECT up.region, count(1) AS likes_given
FROM likeable_likes AS ll
INNER JOIN user_profiles AS up
ON ll.user_id = up.user_id
WHERE ll.likable_type = 'GSVnet\\Forum\\Replies\\Reply'
GROUP BY up.region;
```
