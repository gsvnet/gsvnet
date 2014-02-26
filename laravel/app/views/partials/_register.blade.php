{{ Former::text('register-username')->label('Gebruikersnaam')}}
{{ Former::text('register-firstname')->label('Voornaam')}}
{{ Former::text('register-middlename')->label('Tussenvoegsel')->size('3')}}
{{ Former::text('register-lastname')->label('Achternaam')}}
{{ Former::text('register-email')->label('Email')}}
{{ Former::password('register-password')->label('Wachtwoord')}}
{{ Former::password('register-password_confirmation')->label('Herhaal wachtwoord')}}