# Werken op gsvnet via SSH

Om in te loggen op de server van gsvnet waar de website draait,
moet je gebruikmaken van Secure Shell (SSH).

### SSH keys

Daarvoor moet je eerst een SSH key pair aanmaken. Dit paar bestaat uit een private
key, die je never nooit niet aan iemand anders geeft, en een public key, die je
aan iedereen geeft. Dat wat met je public key versleuteld wordt kun je alleen ontsleutelen
met je private key, dus op die manier kun je aan iedereen met je public key laten
zien dat jij degene bent met de bijbehorende private key: wanneer men je iets stuurt
dat met de public key versleuteld is, ben jij de enige die het kan ontsleutelen.
Zo ben je herkenbaar voor servers als die van gsvnet. Als je nog geen SSH keys
hebt, kun je die aanmaken met de guide op [GitHub](https://help.github.com/articles/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent/).
Zodra je de keys gegenereerd hebt, moet je **id\_rsa.pub** (die waarschijnlijk in
je _~/.ssh_ folder staat) geven aan iemand van de webcie die 'm als vertrouwde
key op de server kan zetten.  
Vervolgens kun je inloggen op de server d.m.v. het commando:

```shell
ssh root@gsvnet.nl
```

Dikke kans dat ssh nu om je wachtwoord vraagt omdat-ie bij je private key wil.
Hiervoor moet je gewoon het wachtwoord geven van je linux-systeem.

### MySQL

Om in te loggen op het databasesysteem MySQL moet je het volgende commando
intikken:

```shell
mysql -uroot -p
```

Het systeem vraagt je vervolgens om een wachtwoord. Dit wachtwoord is **harmen**.
Eenmaal ingelogd kun je met SQL-commando's tabellen selecteren en bewerken. Om
bijvoorbeeld mijn row in de users-tabel te zien, typ je het volgende:

```sql
USE gsvnet; -- Om de juiste database te selecteren.
SELECT * FROM users WHERE firstname = 'loran';
```

### Emails herleiden

Het domein gsvnet.nl kan ook emails ontvangen (denk aan _abactis@gsvnet.nl_).
Deze emails worden echter altijd doorgezonden naar andere accounts (mails naar
_abactis@gsvnet.nl_ worden bijvoorbeeld altijd doorgestuurd naar _gsvsenaat@gmail.com_).
Naar welk adres welk mailtje wordt doorgestuurd staat in het bestand `/etc/postfix/virtual`.
Je kan het als volgt openen:

```shell
cd /etc/postfix
vim virtual
```

Dit opent de vim editor. Deze editor werkt waarschijnlijk wat anders dan je gewend
bent. Het makkelijkst is om, zodra je het bestand virtual geopend hebt, op **i**
te drukken om in **insert mode** te komen. Dan kun je met je pijltjestoetsen navigeren
en normaal typen. De structuur van elke regel van het bestand virtual is zoals hieronder:

```
[gsvnet_mailadres] [andermans_mailadres1] [andermans_mailadres2] ...
```

waarbij een mailtje naar `[gsvnet_mailadres]` wordt herleid naar alle `[andermans_mailadresX]`-adressen.
Een concreet voorbeeld:

```
webcie@gsvnet.nl haampie@gmail.com rickrozemuller10@gmail.com ...
```

Als je wilt veranderen waarnaar de emailadressen doorverwijzen, moet je dus een
van de `[andermans_mailadresX]`-adressen aanpassen of een emailadres aan de regel
toevoegen of verwijderen.  
Wanneer je klaar bent met je aanpassingen, druk je op **ESC** om uit **insert mode**
te komen. Door nu **:wq** (write and quit) te typen en op **Enter** te drukken
sla je je veranderingen op en verlaat je vim. Heb je alles helemaal vercrackt en wil
je uit vim zonder veranderingen op te slaan? Typ dan in plaats van **:wq**, **:q!**
(quit without save).  
Om je aanpassingen in virtual daadwerkelijk op het emailherleidsysteem toe te passen,
voer je onderstaande (gewoon weer in de shell) uit:

```shell
postmap /etc/postfix/virtual
```

Je krijgt waarschijnlijk geen feedback van dit commando, maar zodra je dit hebt
uitgevoerd, zijn je aanpassingen, als het goed is, toegepast.
