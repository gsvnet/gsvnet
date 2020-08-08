@extends('layouts.default')

@section('title', 'KEI-week 2020')
@section('description', 'Bekijk hier het programma van de GSV in de KEI-week van 2020!')

@section('content')

    <article class="artikel column-holder">
        <div>
            <h1>KEI-week 2020</h1>
            <p class="lead">
                Wat leuk dat je een kijkje neemt op onze KEI-week pagina! Voordat je verder gaat naar de activiteiten eerst even dit: <br>
                Naar aanleiding van de persconferentie van afgelopen donderdag een update over de activiteiten in de KEI-week. We zijn in overleg met de Gemeente Groningen, de onderwijsinstellingen in Groningen, de GGD en de veiligheidsregio Groningen over wat de conferentie betekent voor ons. Alles wat wij zullen organiseren is dus in overleg met deze instanties en uiteraard in lijn met de adviezen van het RIVM.
            </p>
            <p>
                Naar aanleiding van dit overleg kunnen de activiteiten op maandag en dinsdag in ieder geval doorgang vinden in de KEI-week! Meld je daarvoor hieronder aan, of meld je aan bij de deur als je je niet online hoeft aan te melden. <br>
                Na dinsdag zullen de activiteiten doorgaan tot nader order. Ook dan kun je in ieder geval langskomen op de sociëteit voor een rondleiding. Verder kun je ons uiteraard ook vinden op de informatiemarkt! <br>
                Verdere ontwikkelingen kun je volgen via deze pagina of via social media.
            </p>
        </div>

        <img src="/images/KEI2020.jpg" alt="Programma KEI-week"> <br>

        <p>
            <br>
            Als vanzelfsprekend houden we rekening met de coronamaatregelen van de horeca. Daaronder valt dat je vooraf moet reserveren. Dit betekent dat je je moet opgeven voor de activiteiten die op de poster staan. <br>
            Ook zal de GSV te zien zijn op het online platform dat opgezet is door het dagelijks bestuur van stichting KEI in de vorm van Q&A’s en de specifieke video. Houd voor al onze updates deze pagina in de gaten en volg ons op {!! HTML::link('https://www.instagram.com/gsvgroningen', 'Instagram') !!} en {!! HTML::link('https://nl-nl.facebook.com/GSVgroningen', 'Facebook') !!}.

            <br>
            Wij hebben er zin in en hopen dat je net zo enthousiast bent als de KEI-commissie die deze week voor jou organiseert!
        </p>

        <p><i>Voor de activiteiten waar niets wordt vermeld over opgaven hoef je je niet op te geven, maar kan je je aanmelden bij de deur. Er is genoeg plaats, dus je hoeft niet bang te zijn dat het vol is. Voor vragen of opmerkingen kan je ons een berichtje sturen op {!! HTML::link('https://www.instagram.com/gsvgroningen', 'Instagram') !!} of een mailtje sturen naar {!! HTML::mailto('prescie@gmail.com') !!}.</i></p>

        <h2>Iedere dag</h2>
        <h3>Avondeten</h3>
        <p>Heb je geen zin of tijd om te koken? Don’t worry, bij ons kan je van maandag tot en met donderdag gratis een hapje mee-eten. Kijk voor de activiteiten per dag wat er op het menu staat.</p>
        <h3>Lunch</h3>
        <p>Zin in een stevige lunch voor de rest van de dag of heb je gewoon lekkere trek tussen de middag? Van dinsdag tot en met vrijdag kun je bij ons gratis lunchen. We staan voor je klaar met lekkere broodjes, fruit en koffie!</p>
        <h3>Rondleiding op soos</h3>
        <p>Ben jij benieuwd naar hoe ons pand er uit ziet en wil je een indruk krijgen van de sfeer bij GSV? Je bent elke dag, ook tijdens activiteiten, welkom om een rondleiding te krijgen door ons pand! <i>Voor de In House Tours moet je je opgeven via Stichting KEI, maar ook op andere momenten ben je welkom.</i></p>
        <h3>Online Q&A-sessie</h3>
        <p>Op maandag en woensdag zullen twee GSV’ers al je vragen over het studie- en studentenleven digitaal voor je beantwoorden. <i>Hier hoef je je niet voor op te geven, maar moet je inloggen op het digitaal platform van stichting KEI.</i></p>

        <h2>Maandag - Paradise</h2>
        <h3>Avondeten: salades</h3>
        <p>Vanavond staan de lekkerste huisgemaakt pasta-, couscous- en fruitsalades voor je klaar. </p>
        <h3>Cocktail Paradise</h3>
        <p>Hou jij wel van een lekker drankje in paradijselijke sferen? Kom dan op maandagavond bij ons langs om de lekkerste cocktails te drinken die speciaal voor jou gemaakt worden! Ook voor de niet-alcoholische versie ben je natuurlijk welkom.</p>

        <h2>Dinsdag - IJstijd</h2>
        <h3>IJstijd</h3>
        <p>Bereid je voor op een ijskoude middag met koud bier, ijskoude ijsjes en Ice Age, afkoelen maar!</p>
        <h3>Running dinner</h3>
        <p>Op dinsdag hebben wij geen eten in ons pand, maar kan je in verschillende GSV-huizen je voor- hoofd- en nagerecht eten. Kom dan op dinsdag bij GSV’ers thuis eten en leer onze leden en de huizen kennen. <i>Hier moet je je (in een duo of alleen) voor opgeven voor maandag 20.00 uur. Geef je hier op: {!! link_to('https://forms.gle/7gzt1cCmkPG74AJh6', null, ['target' => '_blank']) !!}.</i></p>
        <h3>Pubquiz</h3>
        <p>Heb jij veel kennis of heb jij gewoon zin in een gezellige avond borrelen met GSV’ers? Blijf dan na het eten hangen bij het adres waar je was en speel gezellig mee met de pubquiz. Ook als je niet bij de Running Dinner bent, kan je je alsnog opgeven om mee te doen met de pubquiz. <i>Hier moet je je (in een duo of alleen) voor opgeven. Geef je hier op: {!! link_to("https://forms.gle/rq7Kq1fWhTEGCDQ78", null, ['target' => '_blank']) !!}.</i></p>

        <h2>Woensdag - Goudgele eeuw</h2>
        <h3>Escape room</h3>
        <p>Houd jij wel van een puzzel en kan jij die ook oplossen als er een hoge tijdsdruk is? Kom dan langs in ons pand aan de Hereweg en bevrijd jezelf en je team van de gevaren uit de historie. Wil je alleen meedoen? Dat is geen enkel probleem, er zijn genoeg mensen aanwezig die samen met jou de escaperoom willen oplossen. <i>Vanwege de beperkte capaciteit vragen we je om je hiervoor op te geven. Vragen naar beschikbaarheid aan de deur is ook mogelijk. Geef je op via de volgende link: {!! link_to("https://forms.gle/rzMZ7VH6PVkYJEMp6", null, ['target' => '_blank']) !!}.</i></p>
        <h3>Avondeten: Mexicaans</h3>
        <p>Ook deze avond zal er weer een heerlijke maaltijd voor je klaar staan. Kom gezellig langs en geniet van een gratis Mexicaanse maaltijd!</p>
        <h3>Lezing</h3>
        <p>Lezingen zijn een belangrijk onderdeel van onze intellectuele pijler. Op woensdagavond zal Jan Adze Nicolai een lezing houden over het basisinkomen. Daarna is er de gelegenheid om vragen te stellen en met elkaar na te praten over het thema.</p>
        <h3>Bourgondische borrel</h3>
        <p>Na de lezing is het tijd om met z’n allen na te genieten op onze sociëteit van een lekker hapje en drankje geheel in bourgondische sferen!</p>

        <h2>Donderdag - Nineties</h2>
        <h3>Spelmiddag</h3>
        <p>Tijdens de spelmiddag zullen we ouderwetse bord- of kaartspelletjes spelen onder het genot van een lekker drankje.</p>
        <h3>BBQ op soos</h3>
        <p>Donderdag zal er een BBQ in de achtertuin van soos zijn! (Ook als je vegetarisch eet, ben je van harte welkom!). <i>Hier moet je je voor opgeven. Geef je op via de volgende link: {!! link_to("https://forms.gle/xp5uqRP7afz2vDSK7", null, ['target' => '_blank']) !!}.</i></p>

        <h2>Vrijdag - Future</h2>
        <p>Als afsluiting van de KEI-week kan je vrijdag vanaf 12 uur bij ons langskomen voor een brunch en een aansluitende vrijdagmiddagborrel met frituurhapjes! </p>

        <p>
            <img src="/images/keicie.jpg" alt="KEI-commissie">
            De KEI-commissie, van links naar rechts zie je: Tim, Sarena, Nienke, Michelle, Aniek en Lydia.
        </p>
    </article>
@stop
