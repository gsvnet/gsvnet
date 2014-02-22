GSVnet 3
========

## Setup met vagrant
'cd' naar de laravel map en gebruik 'vagrant up'. Daarna:
   vagrant ssh
   cd /vagrant
   composer install

De website is nu te vinden op 'localhost:8080'.

## Vagrant sluiten
'vagrant suspend' of 'vagrant desroy'


Wat er moet gebeuren op korte termijn:
--------------------------------------

 - Auth & User systeem
   - Permissiesysteem
   - Profielpagina
 - Word lid-pagina:
   - Nu wordt er alleen een mailtje gestuurd, maar opslaan in de database is ook wel handig.
   - Invoer: Naam, e-mailadres, telefoonnummer, jaar van eerste inschrijving rug, adres, postcode/plaats, adres ouders, postcode/plaats ouders, telefoonnummer ouders, studie, geboortedatum (dd-mm-jjjj), kerk, geslacht, opmerkingen, foto uploaden, captcha
 - Activiteiten
   - Toevoegen, bewerken, verwijderen
   - Pagination
 - Fotoalbum
   - Galleries toevoegen, bewerken, verwijderen
   - Foto's toevoegen, bewerken, verwijderen
   - Pagination

Op lange termijn
----------------

  - Forum
