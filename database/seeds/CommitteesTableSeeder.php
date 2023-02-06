<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommitteesTableSeeder extends Seeder
{
    public function run()
    {
        $committees = [];
        $time = Carbon::now();

        $committees[] = [
            'name' => 'Amicaal bezoekcommissie',
            'unique_name' => 'abc',
            'description' => 'Amicale bezoeken commissie, oftewel de ABC. Dit is de commissie die activiteiten organiseert en promoot voor en van zusterverenigingen. Deze commissie organiseert één keer per jaar een amicaal weekend. Ook wordt er door de ABC jaarlijks een zusterfeest georganiseerd.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'Archivaris',
            'unique_name' => 'archivaris',
            'description' => 'De archivaris heeft een mooie taak te vervullen. Hij is de bewaarder van de geschiedenis der GSV. Het archief valt onder zijn beheer en hij brengt hier orde in aan. Ook verdiept de archivaris zich in de rijke geschiedenis en verblijdt hij de GSV met artikelen in de SIC over notoire en beroemde episodes uit de GSV historie.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'Barspeechcommissaris',
            'unique_name' => 'barspeech',
            'description' => 'De Barspeechcommissarissen hebben het recht om mensen een speechtitel te geven en ze de bar op te sturen. Indien er nog sprake is van een beetje barvrees, wordt de Barsleepcommissie inschakelen. Deze commissie mag mensen een letterlijk duwtje in de goede richting geven, zodat barspeeches op soos worden gewaarborgd. Als Barspeechcommissaris/Barsleepcommissie ben je onderdeel van de OVcie.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'BASIC',
            'unique_name' => 'basic',
            'description' => 'De Bezinnende Activiteiten en Sing-In Commissie. De BASIC organiseert onder andere een paar keer per jaar een sing-in. Maar ook een bezinnende workshop of een andere christelijke activiteit is de BASIC niet vreemd. Of je nu een ontbijtsing-in wil, een soossing-in of toch een paassing-in in de Groningse polder; de BASIC is de commissie die dat mogelijk maakt',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'Bezinningsweekendcommissie',
            'unique_name' => 'bezwicie',
            'description' => 'De bezinningsweekendcommissie, oftewel Bezwicie is een grote commissie die als taak heeft om het bezinningsweekend te organiseren. Dat is een weekend waar de hele GSV bezig is met God en met het geloof. Deze commissie regelt de sprekers, de workshops en zorgt dat alles in dit weekend goed geregeld is. Op deze manier is er ruimte voor de GSV om dichter bij elkaar en dichter bij God te komen.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'Bijbelkringcoaches',
            'unique_name' => 'bijbelkringcoaches',
            'description' => 'De Bijbelkringcoaches steunen de Bijbelkringleiders in hun taak. Door het jaar heen houden de coaches contact met de BK-leiders en zijn er bijeenkomsten waarbij de BK-leiders advies en handreikingen krijgen waarmee ze hun BK’s (beter) kunnen leiden. Ook kunnen zij met vragen en problemen altijd bij de Bijbelkringcoaches terecht.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'Bügeltrofeegroep',
            'unique_name' => 'bugeltrofee',
            'description' => 'Dit is een groep bestaande uit drie personen die de belangrijke taak heeft om jaarlijks de Bügeltrofee uit te reiken. Dit is de trofee voor de amice of amica die tijdens Huishoudelijke Vergaderingen zich veel heeft laten horen en gelden als hij – terecht of onterecht – meende dat alles anders moest. Deze trofee wordt doorgaans uitgereikt op de laatste HV van het academisch jaar.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'Bullen- en lintencommissie',
            'unique_name' => 'lullen-en-binten',
            'description' => 'Elk jaar zijn er weer mooie linten en bullen nodig, deze moeten natuurlijk wel gemaakt worden. Aan de bullen- en lintencommissie de taak om dit in goede banen te leiden. Ze naaien, drukken, en stikken bullen en linten voor de nieuwe leden en de vertrekkende Senaat. Ook doen ze het nodige reparatiewerk aan linten en aan zegels op de bullen.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'College van Mores en Advies',
            'unique_name' => 'mores-en-advies',
            'description' => 'Het College van Mores en Advies, oftewel CMA moet ervoor zorgen dat, en de naam zegt het al, de mores van de vereniging in ere worden gehouden. Verder is het o.a. verantwoordelijk voor het tribunaal tijdens het novitiaat. Ook is dit het orgaan waarmee GSV’ers medeleden die de mores overtreden kunnen aanklagen. Door het jaar heen worden er rechtszittingen georganiseerd om deze of gene GSV’er aan te kunnen spreken op ongepast gedrag.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'Commercie',
            'unique_name' => 'commercie',
            'description' => 'De Commercie zorgt voor zoveel mogelijk sponsors voor de GSV zodat je minder HO hoeft te betalen. Een zeer dankbare commissie dus. Ook zoeken ze andere inkomstenbronnen voor de vereniging. Hierbij valt ook te denken aan adverteerders voor in SIC, of contracten met werkgevers. Ook voor andere commissies, zoals de Diescie of Bezinningsweekendcie kan deze commissie worden ingeschakeld.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'Concert- en Kleinkunstcommissie',
            'unique_name' => 'ckc',
            'description' => 'De Concert- en Kleinkunstcommissie organiseert door het jaar heen verschillende activiteiten met een muzikaal of cultureel tintje. Hieronder vallen o.a. het Diesconcert en het Poprockconcert, maar ook de culturele filmavondjes, teken- of schilderworkshops en de muziekagenda in de SIC worden verzorgd door de CKC. Ook cabaret- en kleinkunstavonden vallen onder de verantwoordelijkheid van de CKC.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'Diescommissie',
            'unique_name' => 'diescie',
            'description' => 'De Diescommissie is een grote commissie die maar één doel heeft: een zo tof mogelijke Dies neerzetten die niemand vergeet. Daarvoor moet er ontzettend veel geregeld worden en dat doet deze commissie graag en met veel energie. De Dies is hét gala van de GSV en in de weken en maanden van te voren is er altijd veel om te doen. Dit organiseren is daarom ook een hele leuke en dankbare taak.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'DrEC',
            'unique_name' => 'drec',
            'description' => 'Dit is dé commissie waar je je handen uit de mouwen kunt steken. Boodschappen doen en koken zijn de belangrijkste taken van deze commissie. Zowel op bezinningsweekend, novitiaatsweekend als voor alle HV’s verzorgt de Drank- en EetCommissie de lekkerste gerechten. Ook bakken ze oliebollen en jureren ze bij de jaarlijkse taartenbakwedstrijd.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'GerGem',
            'unique_name' => 'gergem',
            'description' => 'Deze afkorting staat voor: Gereformeerde erudiete redacteuren Genereren eigenzinnige memoires. Deze commissie schrijft over de historie van de GSV. Alle toffe en beruchte episodes die de GSV kent worden door deze commissie verslagen en gepubliceerd in de SIC. Dit is de commissie die waakt over de officiële kronieken van de vereniging en zij doet aan actieve geschiedschrijving. Ook heeft ze de taak om de vereniging te informeren over het wel en wee van zusjes en broertjes in den lande.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'GoeDoecie',
            'unique_name' => 'goedoecie',
            'description' => 'De GoeDoecie is de goededoelencommissie van de GSV. Deze commissie zorgt ervoor dat de vereniging haar christen-zijn ook in praktijk kan brengen door te sjoelen met verstandelijk gehandicapten, of te werken voor voedselprojecten in Afrika. De GoeDoecie zoekt door het jaar heen doelen uit waar de GSV wat voor kan doen, zowel structureel als eenmalige acties pakt deze commissie aan.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'Jaarbundelcommissie',
            'unique_name' => 'jaarbundelcommissie',
            'description' => 'Elk jaar brengt de GSV een jaarbundel uit, een boekje dat onmisbaar is voor elke actieve GSV’er, en dat daarnaast erg leuk is om te hebben. De jaarbundelcommissie zorgt ervoor dat de individuele GSV’er stukjes inleveren, dat alle lijsten er goed en up to date in komen te staan en dat het hele ding er gelikt uitziet. De jaarbundelcommissie presenteert de jaarbundel op de Dies.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'Kascontrolecommisie',
            'unique_name' => 'kascontrolecommisie',
            'description' => 'De kascontrolecommissie is een commissie die twee keer per jaar kritisch de fiscus mag controleren en daarvan verslag over uit mag brengen halverwege het jaar en op de wisselings-HV. Dit om te voorkomen dat de fiscus een nieuwe auto koopt voor eigen gebruik, of een vakantie boekt van GSV geld.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'Keicommissie',
            'unique_name' => 'keicie',
            'description' => 'Eén van de belangrijkste commissies binnen de GSV is de Keicie. Deze commissie is verantwoordelijk voor de invulling van het programma van de GSV tijdens de Keiweek. Daardoor kunnen een heleboel potentiële leden tot de GSV worden gebracht. In deze commissie wordt intensief samengewerkt met ATV. De Keiweekcommissie zorgt er altijd voor dat de eerste week van het GSV jaar altijd weer knallend wordt ingeluid.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'Le Dûc',
            'unique_name' => 'le-duc',
            'description' => 'Dit is de Debiteuren Uitkleed Commissie. Deze persoon zorgt ervoor dat het geld van debiteuren van het voorgaande jaar alsnog binnenkomt. Deze persoon is altijd de fiscus o.t., en hij/zij heeft veel contact met de fiscus h.t.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'MALversacie',
            'unique_name' => 'malversacie',
            'description' => 'Het Monarch Aurelius Lucianus fonds (MALfonds) is een fonds met oud-leden. De MALversacie is verantwoordelijk voor het contact met dit fonds en zorgt ervoor dat oud-leden contact met elkaar kunnen houden. Ze sturen ‘MAiLings’ rond en organiseren jaarlijks  een activiteit voor oud-leden.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'Ministers van de Senaat',
            'unique_name' => 'minister-van-de-senaat',
            'description' => 'De ministers van de Senaat zijn eerstejaarsleden die zich onvoorwaardelijk in dienst stellen van de Senaat. Zij worden aan het begin van het jaar gekozen door de Senaat en hebben de zeer hooggeachte functie om de Senaat bij te staan waar zij kunnen. Dit is een zeer begeerde en gewaardeerde functie.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'Novitiaatscommissie',
            'unique_name' => 'novcie',
            'description' => 'De novitiaatscommissie is een commissie die verantwoordelijk is voor de eerste week van het novitiaat. Deze commissie bereidt de novitiaatsweek voor en leidt de nieuwe leden van de GSV door deze week heen. Dit is een van de belangrijkste commissies van de GSV en soms bepalend voor de toekomst van een heel nieuw jaarverband.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'OV-Commissie',
            'unique_name' => 'ovcie',
            'description' => 'Lezingen worden georganiseerd door de Openbare Vergaderingen commissie, oftewel de OVcie. Door het jaar heen organiseert deze commissie interessante en leuke lezingen van wetenschappers, mensen uit het bedrijfsleven en andere boeiende sprekers. De mensen in deze commissie hebben veel invloed op welke onderwerpen er langs komen en worden besproken op de vereniging.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'PRescie',
            'unique_name' => 'prescie',
            'description' => 'Dit is een hele belangrijke en leuke commissie die naar open dagen en feestjes van middelbare scholen gaat om promotie te maken voor de GSV. Het gaat er in deze commissie om, om de GSV naamsbekendheid te geven binnen de stad, maar vooral ook om nieuwe leden te werven voor de vereniging. Ook brengt de PRescie om het jaar nieuwe GSVkleding uit en is zij prominent aanwezig op de Open Soosen.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'Ramcie',
            'unique_name' => 'ramcie',
            'description' => 'De twee ramcoördinatoren der GSV organiseren ongeveer eens per jaar een ramactie bij een van de zusjes in den lande. Deze coördinatoren zijn aangesteld zodat GSV’ers met goede ideeën over een ramactie naar ze toe kunnen gaan, waarna deze coördinatoren deze acties gaan organiseren. Als er geen input is, bedenken ze zelf een leuke actie.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'Reebocie',
            'unique_name' => 'reebocie',
            'description' => 'De Reebocie verzorgt de opmaak van SIC, en verzendt SIC naar de drukker. Daarnaast heb je beeldvormers in de commissie die als taak hebben om alles wat er op/binnen de vereniging gebeurt op de gevoelige plaat vast leggen. Ook mag deze commissie jaarlijks de GSV-kalender maken en jaarlijks de herziene besluiten en reglementen van de GSV publiceren in het Reeboekie. De Reebocie presenteert vaak een filmpje op Huishoudelijke Vergaderingen met beeldmateriaal van de afgelopen activiteiten.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'Regiocommissie regio 1',
            'unique_name' => 'regio-1',
            'description' => 'Als regiocommissie organiseer je een jaar lang de activiteiten voor een van de vier regio’s van de GSV. Vaak is er één activiteit in de maand en als hoofdactiviteiten zijn er de twee regiokampen: winter- en zomerkamp. Sommige diners of activiteiten zijn traditie maar deze commissie heeft veel vrijheid om allerlei leuke dingen te bedenken.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'Regiocommissie regio 2',
            'unique_name' => 'regio-2',
            'description' => 'Als regiocommissie organiseer je een jaar lang de activiteiten voor een van de vier regio’s van de GSV. Vaak is er één activiteit in de maand en als hoofdactiviteiten zijn er de twee regiokampen: winter- en zomerkamp. Sommige diners of activiteiten zijn traditie maar deze commissie heeft veel vrijheid om allerlei leuke dingen te bedenken.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'Regiocommissie regio 3',
            'unique_name' => 'regio-3',
            'description' => 'Als regiocommissie organiseer je een jaar lang de activiteiten voor een van de vier regio’s van de GSV. Vaak is er één activiteit in de maand en als hoofdactiviteiten zijn er de twee regiokampen: winter- en zomerkamp. Sommige diners of activiteiten zijn traditie maar deze commissie heeft veel vrijheid om allerlei leuke dingen te bedenken.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'Regiocommissie regio 4',
            'unique_name' => 'regio-4',
            'description' => 'Als regiocommissie organiseer je een jaar lang de activiteiten voor een van de vier regio’s van de GSV. Vaak is er één activiteit in de maand en als hoofdactiviteiten zijn er de twee regiokampen: winter- en zomerkamp. Sommige diners of activiteiten zijn traditie maar deze commissie heeft veel vrijheid om allerlei leuke dingen te bedenken.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'SIC Verzender',
            'unique_name' => 'sic-verzender',
            'description' => 'De Verzender is eindverantwoordelijk voor de verspreiding van SIC. Hij of zij haalt de SIC’s op de van de drukker en verspreid ze onder de bezorgers. Daarnaast zorgt hij voor adreslijsten en dat de SIC’s op soos komen liggen.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'SICredactie',
            'unique_name' => 'sic-redactie',
            'description' => 'De SIC-redactie is de redactie van het verenigingsblad SIC. Deze redactie schrijft en reviseert allerlei artikelen en houdt interviews om zo ongeveer 6 keer per jaar een toffe SIC te publiceren. De SIC-redactie maakt GSV’ers enthousiast voor het schrijven van artikelen en probeert daarnaast een mooie, leuke, kwalitatieve en dikke SIC te produceren.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'Sooscie',
            'unique_name' => 'sooscie',
            'description' => 'De Sooscie’s zijn de mensen die elke soos achter de bar staan om iedereen van drankjes te voorzien. Deze taak neemt een Sooscie een paar keer per jaar op zich en daarmee staat hij een hele avond achter de bar. De Sooscie is verantwoordelijk voor het afsluiten van Soos en en voor het behouden van de orde, want Sooscie’s wil is wet.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'SPAC',
            'unique_name' => 'spac',
            'description' => 'De SpAC staat voor Sport- en activiteitencommissie. Deze commissie organiseert het hele jaar door verenigingsbrede activiteiten zoals het liftweekend en Gotcha. Ook organiseert deze commissie sportieve activiteiten en heeft het de afgelopen jaren ook meegeholpen met het organiseren van de Regiostrijd-activiteiten.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'TBS',
            'unique_name' => 'tbs',
            'description' => 'Staat voor Themagroep BijbelStudie. Deze groep schrijft elk jaar de themabijbelstudie waardoor alle BK’s tegelijk bezig zijn met een Bijbelstudie. Deze themabijbelstudies kunnen over van alles gaan en zijn vaak bedoeld om de GSV te verenigen in hun geloofsbeleving. De themagroep schrijft deze Bijbelstudie door boekjes te lezen of dominees te raadplegen.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'Vaandeldragers',
            'unique_name' => 'vaandeldragers',
            'description' => 'De Vaandeldragers zijn verantwoordelijk voor het vaandel. Dit staat bij de dragers in huis en zij moeten het beschermen tegen braspogingen. Daarnaast moeten zij het vaandel op de gepaste tijden neerzetten, zoals op HV’s en tijdens plechtige gelegenheden. De Vaandeldrager moet uit respect voor het vaandel deze met witte handschoenen hanteren en moet er ook voor zorgen dat iedereen die geen vaandeldrager is het vaandel der GSV niet bezoedelt. ',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'Vertrouwenspersonen',
            'unique_name' => 'vertrouwenspersonen',
            'description' => 'Op de GSV zijn er 2 vertrouwenspersonen. Bij deze personen kun je terecht als je problemen hebt of als je je zorgen maakt over mede-GSV’ers. Ze zijn er om GSV’ers te helpen en te ondersteunen waar mogelijk, of door te verwijzen naar andere hulp, als ze die nodig hebben.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'VGSE',
            'unique_name' => 'vgse',
            'description' => '',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'Vlagcommissie',
            'unique_name' => 'vlagcommissie',
            'description' => 'De Vlagcommissie heeft een belangrijke taak: de GSV-vlag (iets heel anders dan het vaandel) bewaren en niet kwijtraken. Deze vlag wordt meegenomen naar allerlei GSV activiteiten om ook zo de vereniging te profileren. Deze vlag is in beheer van de vlagcommissie en zij moet haar meenemen als ze denkt dat de activiteit gebaat is bij de GSV-vlag.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        $committees[] = [
            'name' => 'Webcie',
            'unique_name' => 'webcie',
            'description' => 'De Webcie is de commissie die de site onderhoudt, zo nu en dan een nieuwe site bouwt en in het algemeen de website beheert. De Webcie is er voor alle technische problemen en ‘glitches’ op de site. Ook controleert het op de inhoud van het forum en zijn daar ook de ‘moderators’.',
            'created_at' => $time,
            'updated_at' => $time,
        ];

        DB::table('committees')->insert($committees);
    }
}
