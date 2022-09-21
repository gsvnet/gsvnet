    <div class="column-holder" role="main">

        <h2>Wat leuk dat je lid wilt worden van de GSV!</h2> 

        <p>
            Wil je eerst nog meer informatie? Neem dan nog een kijkje op <a href="https://www.gsvgroningen.nl">gsvgroningen.nl</a>, bijvoorbeeld het kopje ‘waarom lid worden’ of onze socials! Je kunt ons ook altijd mailen met je vraag naar: prescie@gmail.com Om je inschrijving compleet te maken is het volgen van het novitiaat verplicht. Het novitiaat is een intensieve kennismaking met de GSV van anderhalve week lang. Hierbij ga je eerst een week op kamp waar je kennis kunt maken met de structuur en activiteiten van de GSV. Ook leer je je eigen jaarverband goed kennen. In de halve week daarna maak je kennis met de GSV-leden zelf door allerlei bruisende activiteiten in de stad. Het novitiaat van de GSV heeft een ontgroenend karakter en vindt dit jaar (2022) plaats van 22 augustus t/m 31 augustus. Houd deze dagen dus alvast vrij in je agenda!
        </p>

        @if (count($errors) > 0)
            <div class="error-bar">
                <p><strong>Het formulier is niet helemaal goed ingevuld!</strong></p>
                @foreach($errors->all('<li>:message</li>') as $error)
                    {!! $error !!}
                @endforeach
            </div>
        @endif

        <h4>Op dit moment zijn de aanmeldingen gesloten. Als je vragen hebt over de aanmelding of de GSV kan je contact opnemen met de PRescie via <a href="mailto:prescie@gmail.com">prescie@gmail.com</a>.</h4>
