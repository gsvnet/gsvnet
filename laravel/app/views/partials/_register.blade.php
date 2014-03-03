{{ Former::text('register-username')->label('Gebruikersnaam')->placeholder('Gebruikersnaam')}}
{{ Former::text('register-firstname')->label('Voornaam')->placeholder('Voornaam')}}
{{ Former::text('register-middlename')->label('Tussenvoegsel')->size('3')->placeholder('Tussenvoesel')}}
{{ Former::text('register-lastname')->label('Achternaam')->placeholder('Achternaam')}}
{{ Former::text('register-email')->label('Email')->placeholder('Email')}}
{{ Former::password('register-password')->label('Wachtwoord')->placeholder('Wachtwoord')}}
{{ Former::password('register-password_confirmation')->label('Herhaal wachtwoord')->placeholder('Herhaal')}}