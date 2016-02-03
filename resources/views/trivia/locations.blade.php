<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>GSV: wie woont waar</title>
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>

    function initMap() {
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13,
        center: {
          "lat": 53.21468199999999,
          "lng": 6.559742699999999
        }
      });

      var leden = [
        {
          "username": "Anne-Marie",
          "address": "Louise Henriëttestraat 42a",
          "location": {
            "lat": 53.22468199999999,
            "lng": 6.549742699999999
          },
          "town": "Groningen"
        },
        {
          "username": "Mary Jane",
          "address": "Louise Henriëttestraat 42a",
          "location": {
            "lat": 53.22468199999999,
            "lng": 6.549742699999999
          },
          "town": "Groningen"
        },
        {
          "username": "jolienschuurman",
          "address": "Aquamarijnstraat 847",
          "location": {
            "lat": 53.2318921,
            "lng": 6.5212416
          },
          "town": "Groningen"
        },
        {
          "username": "wilko",
          "address": "Saffierstraat 150",
          "town": "Groningen",
          "location": {
            "lat": 53.2301764,
            "lng": 6.5211666
          }
        },
        {
          "username": "Jurriaan",
          "address": "Parelstraat 222",
          "town": "Groningen",
          "location": {
            "lat": 53.2268535,
            "lng": 6.521903
          }
        },
        {
          "username": "jaspermann",
          "address": "aquamarijnstraat 763",
          "town": "Groningen",
          "location": {
            "lat": 53.23185669999999,
            "lng": 6.521180699999999
          }
        },
        {
          "username": "smeerkees",
          "address": "Winschoterdiep 163",
          "town": "Groningen",
          "location": {
            "lat": 53.2099793,
            "lng": 6.582758399999999
          }
        },
        {
          "username": "loisvdiermen",
          "address": "Dorus Rijkersstraat 3",
          "town": "Groningen",
          "location": {
            "lat": 53.2111217,
            "lng": 6.552506699999999
          }
        },
        {
          "username": "josvrenselaar",
          "address": "aquamarijnstraat 709",
          "town": "Groningen",
          "location": {
            "lat": 53.23210419999999,
            "lng": 6.522341099999999
          }
        },
        {
          "username": "elizabeth",
          "address": "Hoekstraat 22-1",
          "town": "Groningen",
          "location": {
            "lat": 53.2199247,
            "lng": 6.5602602
          }
        },
        {
          "username": "klaartje",
          "address": "Dorus Rijkersstraat 3",
          "town": "Groningen",
          "location": {
            "lat": 53.2111217,
            "lng": 6.552506699999999
          }
        },
        {
          "username": "michielalbracht",
          "address": "Aquamarijnstraat 701",
          "town": "Groningen",
          "location": {
            "lat": 53.23210419999999,
            "lng": 6.522341099999999
          }
        },
        {
          "username": "Stabbles",
          "address": "Aquamarijnstraat 767",
          "town": "Groningen",
          "location": {
            "lat": 53.231893,
            "lng": 6.5211517
          }
        },
        {
          "username": "robert8701",
          "address": "Radijsstraat 68a",
          "town": "Groningen",
          "location": {
            "lat": 53.2286894,
            "lng": 6.5497907
          }
        },
        {
          "username": "jackjansma",
          "address": "Turkooisstraat 33",
          "town": "Groningen",
          "location": {
            "lat": 53.23058839999999,
            "lng": 6.5251161
          }
        },
        {
          "username": "JøhnDylån",
          "address": "Joachim Altinghstraat 24",
          "town": "Groningen",
          "location": {
            "lat": 53.2114524,
            "lng": 6.5801196
          }
        },
        {
          "username": "Otter",
          "address": "Aquamarijnstraat 703",
          "town": "Groningen",
          "location": {
            "lat": 53.23210419999999,
            "lng": 6.522341099999999
          }
        },
        {
          "username": "mirjam",
          "address": "De Waard 239",
          "town": "Groningen",
          "location": {
            "lat": 53.2291327,
            "lng": 6.6135993
          }
        },
        {
          "username": "Lotte",
          "address": "Aquamarijnstraat 857",
          "town": "Groningen",
          "location": {
            "lat": 53.2318921,
            "lng": 6.5212416
          }
        },
        {
          "username": "tessabos1",
          "address": "Van Speykstraat 49a",
          "town": "Groningen",
          "location": {
            "lat": 53.212364,
            "lng": 6.5522857
          }
        },
        {
          "username": "Arminius",
          "address": "Saffierstraat 22",
          "town": "Groningen",
          "location": {
            "lat": 53.2301764,
            "lng": 6.5211666
          }
        },
        {
          "username": "MartenH",
          "address": "Radijsstraat 76A",
          "town": "Groningen",
          "location": {
            "lat": 53.22862989999999,
            "lng": 6.549444599999999
          }
        },
        {
          "username": "albertinenanninga",
          "address": "Van Speykstraat 49a",
          "town": "Groningen",
          "location": {
            "lat": 53.212364,
            "lng": 6.5522857
          }
        },
        {
          "username": "ElsbethM",
          "address": "JC Kapteynlaan  43b",
          "town": "Groningen",
          "location": {
            "lat": 53.2291071,
            "lng": 6.5686713
          }
        },
        {
          "username": "AlindaGerrits",
          "address": "Aquamarijnstraat 461",
          "town": "Groningen",
          "location": {
            "lat": 53.2323278,
            "lng": 6.523634299999999
          }
        },
        {
          "username": "Annelot Hulzebosch",
          "address": "JC Kapteylaan  43b",
          "town": "Groningen",
          "location": {
            "lat": 53.2291071,
            "lng": 6.5686713
          }
        },
        {
          "username": "Trudy_",
          "address": "Saffierstraat  104",
          "town": "Groningen",
          "location": {
            "lat": 53.2301948,
            "lng": 6.521122099999999
          }
        },
        {
          "username": "Tamar",
          "address": "Saffierstraat  104",
          "town": "Groningen",
          "location": {
            "lat": 53.2301948,
            "lng": 6.521122099999999
          }
        },
        {
          "username": "KarineL",
          "address": "Snelliusstraat 35",
          "town": "Groningen",
          "location": {
            "lat": 53.2054941,
            "lng": 6.5591803
          }
        },
        {
          "username": "eduard_bergsma",
          "address": "Metaallaan 89",
          "town": "Groningen",
          "location": {
            "lat": 53.22265489999999,
            "lng": 6.536287
          }
        },
        {
          "username": "Cornelieke",
          "address": "Verlengde Nieuwstraat 26a",
          "town": "Groningen",
          "location": {
            "lat": 53.2101205,
            "lng": 6.582118599999999
          }
        },
        {
          "username": "MrMaurits",
          "address": "Aquamarijnstraat 449",
          "town": "Groningen",
          "location": {
            "lat": 53.2323278,
            "lng": 6.523634299999999
          }
        },
        {
          "username": "martijngaasbeek",
          "address": "Metaallaan 89",
          "town": "Groningen",
          "location": {
            "lat": 53.22265489999999,
            "lng": 6.536287
          }
        },
        {
          "username": "HarmenD",
          "address": "Saffierstraat 58",
          "town": "Groningen",
          "location": {
            "lat": 53.2301764,
            "lng": 6.5211666
          }
        },
        {
          "username": "Stayphanie",
          "address": "Hereweg 40a",
          "town": "Groningen",
          "location": {
            "lat": 53.20934579999999,
            "lng": 6.5723375
          }
        },
        {
          "username": "adamroorda",
          "address": "Pelsterstraat 10-3",
          "town": "Groningen",
          "location": {
            "lat": 53.2168641,
            "lng": 6.5665681
          }
        },
        {
          "username": "Jaapie Vecht",
          "address": "Oosterhamrikkade  1035",
          "town": "Groningen",
          "location": {
            "lat": 53.2260178,
            "lng": 6.568467
          }
        },
        {
          "username": "Jael",
          "address": "van Starkenborghstraat 110",
          "town": "Groningen",
          "location": {
            "lat": 53.19591459999999,
            "lng": 6.5774314
          }
        },
        {
          "username": "Juliet de Haas",
          "address": "Aquamarijnstraat 731",
          "town": "Groningen",
          "location": {
            "lat": 53.2318746,
            "lng": 6.5211962
          }
        },
        {
          "username": "Remco",
          "address": "Radijsstraat 76a",
          "town": "Groningen",
          "location": {
            "lat": 53.22862989999999,
            "lng": 6.549444599999999
          }
        },
        {
          "username": "GDwarshuis",
          "address": "Aquamarijnstraat 703",
          "town": "Groningen",
          "location": {
            "lat": 53.23210419999999,
            "lng": 6.522341099999999
          }
        },
        {
          "username": "Poorta",
          "address": "Metaallaan 89",
          "town": "Groningen",
          "location": {
            "lat": 53.22265489999999,
            "lng": 6.536287
          }
        },
        {
          "username": "de Valor",
          "address": "Parelstraat  122",
          "town": "Groningen",
          "location": {
            "lat": 53.2267711,
            "lng": 6.522065599999999
          }
        },
        {
          "username": "Peterheid",
          "address": "Nieuwe Kerkhof   36a",
          "town": "Groningen",
          "location": {
            "lat": 53.2235936,
            "lng": 6.5609288
          }
        },
        {
          "username": "Bash",
          "address": "Oosterhamrikkade 1035",
          "town": "Groningen",
          "location": {
            "lat": 53.2260178,
            "lng": 6.568467
          }
        },
        {
          "username": "jasperkoning",
          "address": "Parelstraat 122",
          "town": "Groningen",
          "location": {
            "lat": 53.2267711,
            "lng": 6.522065599999999
          }
        },
        {
          "username": "Lok",
          "address": "Oosterhamrikkade  1035",
          "town": "Groningen",
          "location": {
            "lat": 53.2260178,
            "lng": 6.568467
          }
        },
        {
          "username": "TimOosterhuis",
          "address": "Illegaliteitslaan 24",
          "town": "Groningen",
          "location": {
            "lat": 53.20818629999999,
            "lng": 6.5549573
          }
        },
        {
          "username": "-Hans-",
          "address": "Fivelstraat 11a",
          "town": "Groningen",
          "location": {
            "lat": 53.22775129999999,
            "lng": 6.5621499
          }
        },
        {
          "username": "Elise",
          "address": "Aquamarijnstraat 731",
          "town": "Groningen",
          "location": {
            "lat": 53.2318746,
            "lng": 6.5211962
          }
        },
        {
          "username": "JORRoth",
          "address": "Parelstraat 188",
          "town": "Groningen",
          "location": {
            "lat": 53.2267275,
            "lng": 6.521929699999999
          }
        },
        {
          "username": "Valéry",
          "address": "Riouwstraat 41a",
          "town": "Groningen",
          "location": {
            "lat": 53.2291768,
            "lng": 6.5615747
          }
        },
        {
          "username": "Loes",
          "address": "Parelstraat 150",
          "town": "Groningen",
          "location": {
            "lat": 53.2268172,
            "lng": 6.521947
          }
        },
        {
          "username": "WiebeGroen",
          "address": "Fivelstraat 11A",
          "town": "Groningen",
          "location": {
            "lat": 53.22775129999999,
            "lng": 6.5621499
          }
        },
        {
          "username": "Boedi",
          "address": "Illegaliteitslaan 72",
          "town": "Groningen",
          "location": {
            "lat": 53.2080414,
            "lng": 6.5541451
          }
        },
        {
          "username": "wimgrootens",
          "address": "Eendrachtskade ZZ 14a",
          "town": "Groningen",
          "location": {
            "lat": 53.2139215,
            "lng": 6.5529115
          }
        },
        {
          "username": "Annemiek",
          "address": "Aquamarijnstraat 821",
          "town": "Groningen",
          "location": {
            "lat": 53.2318921,
            "lng": 6.5212416
          }
        },
        {
          "username": "Amanda",
          "address": "Parelstraat 150",
          "town": "Groningen",
          "location": {
            "lat": 53.2268172,
            "lng": 6.521947
          }
        },
        {
          "username": "Wiljo",
          "address": "Hereweg 40a",
          "town": "Groningen",
          "location": {
            "lat": 53.20934579999999,
            "lng": 6.5723375
          }
        },
        {
          "username": "Wouter",
          "address": "Aquamarijnstraat 837",
          "town": "Groningen",
          "location": {
            "lat": 53.2318921,
            "lng": 6.5212416
          }
        },
        {
          "username": "Emily",
          "address": "Aquamarijnstraat 821",
          "town": "Groningen",
          "location": {
            "lat": 53.2318921,
            "lng": 6.5212416
          }
        },
        {
          "username": 113940,
          "address": "Aquamarijnstraat 837",
          "town": "Groningen",
          "location": {
            "lat": 53.2318921,
            "lng": 6.5212416
          }
        },
        {
          "username": "MarnixTM",
          "address": "Verlengde Nieuwstraat 34",
          "town": "Groningen",
          "location": {
            "lat": 53.2099652,
            "lng": 6.582368799999999
          }
        },
        {
          "username": "Jan Willem",
          "address": "Eendrachtskade zz 14a",
          "town": "Groningen",
          "location": {
            "lat": 53.2139215,
            "lng": 6.5529115
          }
        },
        {
          "username": "david2610",
          "address": "Illegaliteitslaan 72",
          "town": "Groningen",
          "location": {
            "lat": 53.2080414,
            "lng": 6.5541451
          }
        },
        {
          "username": "Siempje",
          "address": "Verlengde Nieuwstraat 26a",
          "town": "Groningen",
          "location": {
            "lat": 53.2101205,
            "lng": 6.582118599999999
          }
        },
        {
          "username": "ellisschipper",
          "address": "Aquamarijnstraat 785",
          "town": "Groningen",
          "location": {
            "lat": 53.2318751,
            "lng": 6.521136299999999
          }
        },
        {
          "username": "MartijnTimmermans",
          "address": "Illegaliteitslaan 72",
          "town": "Groningen",
          "location": {
            "lat": 53.2080414,
            "lng": 6.5541451
          }
        },
        {
          "username": "jverbree",
          "address": "parelstraat 122",
          "town": "Groningen",
          "location": {
            "lat": 53.2267711,
            "lng": 6.522065599999999
          }
        },
        {
          "username": "Saskia",
          "address": "Aquamarijnstraat 785",
          "town": "Groningen",
          "location": {
            "lat": 53.2318751,
            "lng": 6.521136299999999
          }
        },
        {
          "username": "Peterh14",
          "address": "Parelstraat 74",
          "town": "Groningen",
          "location": {
            "lat": 53.2267532,
            "lng": 6.5220651
          }
        },
        {
          "username": "EliseReinders",
          "address": "Diephuisstraat 13A",
          "town": "Groningen",
          "location": {
            "lat": 53.23009649999999,
            "lng": 6.5749583
          }
        },
        {
          "username": "henriet",
          "address": "Saffierstraat  104",
          "town": "Groningen",
          "location": {
            "lat": 53.2301948,
            "lng": 6.521122099999999
          }
        },
        {
          "username": "Joëlle Soepenberg",
          "address": "Aquamarijnstraat 775",
          "town": "Groningen",
          "location": {
            "lat": 53.2319292,
            "lng": 6.5212692
          }
        },
        {
          "username": "Nynke Klok",
          "address": "Aquamarijnstraat 821",
          "town": "Groningen",
          "location": {
            "lat": 53.2318921,
            "lng": 6.5212416
          }
        },
        {
          "username": "Charlotte",
          "address": "Aquamarijnstraat 475",
          "town": "Groningen",
          "location": {
            "lat": 53.2323278,
            "lng": 6.523634299999999
          }
        },
        {
          "username": "RickRozemuller",
          "address": "Turkooisstraat 33",
          "town": "Groningen",
          "location": {
            "lat": 53.23058839999999,
            "lng": 6.5251161
          }
        },
        {
          "username": "Edje",
          "address": "Radijsstraat 68A",
          "town": "Groningen",
          "location": {
            "lat": 53.2286894,
            "lng": 6.5497907
          }
        },
        {
          "username": "Boerema",
          "address": "Saffierstraat 220",
          "town": "Groningen",
          "location": {
            "lat": 53.2301764,
            "lng": 6.5211666
          }
        },
        {
          "username": "Yntse",
          "address": "Saffierstraat 60",
          "town": "Groningen",
          "location": {
            "lat": 53.2301764,
            "lng": 6.5211666
          }
        },
        {
          "username": "Michel",
          "address": "Barmaheerd 41",
          "town": "Groningen",
          "location": {
            "lat": 53.2468606,
            "lng": 6.5952104
          }
        },
        {
          "username": "Holsappel",
          "address": "Saffierstraat 60",
          "town": "Groningen",
          "location": {
            "lat": 53.2301764,
            "lng": 6.5211666
          }
        },
        {
          "username": "HedGe",
          "address": "Haddingestraat 21c",
          "town": "Groningen",
          "location": {
            "lat": 53.216008,
            "lng": 6.5656184
          }
        },
        {
          "username": "MissT",
          "address": "Aquamarijnstraat 643",
          "town": "Groningen",
          "location": {
            "lat": 53.2321651,
            "lng": 6.522300299999999
          }
        },
        {
          "username": "Simeon",
          "address": "Professor Rankestraat 16",
          "town": "Groningen",
          "location": {
            "lat": 53.22058269999999,
            "lng": 6.5810154
          }
        },
        {
          "username": "de Mole",
          "address": "Barmaheerd 41",
          "town": "Groningen",
          "location": {
            "lat": 53.2468606,
            "lng": 6.5952104
          }
        },
        {
          "username": "Vandekamp",
          "address": "Eendrachtskade ZZ 14a",
          "town": "Groningen",
          "location": {
            "lat": 53.2139215,
            "lng": 6.5529115
          }
        },
        {
          "username": "Ron-Kruidhof",
          "address": "Eendrachtskade ZZ 14a",
          "town": "Groningen",
          "location": {
            "lat": 53.2139215,
            "lng": 6.5529115
          }
        },
        {
          "username": "Mulder",
          "address": "Spaanse Aakstraat 85",
          "town": "Groningen",
          "location": {
            "lat": 53.2316578,
            "lng": 6.555966
          }
        },
        {
          "username": "AnnLou",
          "address": "Aquamarijnstraat 475",
          "town": "Groningen",
          "location": {
            "lat": 53.2323278,
            "lng": 6.523634299999999
          }
        },
        {
          "username": "Roorda",
          "address": "Aquamarijnstraat 709",
          "town": "Groningen",
          "location": {
            "lat": 53.23210419999999,
            "lng": 6.522341099999999
          }
        },
        {
          "username": "AlwinS",
          "address": "Aquamarijnstraat 509",
          "town": "Groningen",
          "location": {
            "lat": 53.2323278,
            "lng": 6.523634299999999
          }
        },
        {
          "username": "Daan",
          "address": "Aquamarijnstraat 589",
          "town": "Groningen",
          "location": {
            "lat": 53.2321175,
            "lng": 6.5223502
          }
        },
        {
          "username": "Evenhuis",
          "address": "Verlengde Visserstraat 9a",
          "town": "Groningen",
          "location": {
            "lat": 53.218655,
            "lng": 6.5568421
          }
        },
        {
          "username": "Joashakvoort",
          "address": "Aquamarijnstraat 563",
          "town": "Groningen",
          "location": {
            "lat": 53.2323278,
            "lng": 6.523634299999999
          }
        },
        {
          "username": "Alaberto",
          "address": "Fivelstraat 11a",
          "town": "Groningen",
          "location": {
            "lat": 53.22775129999999,
            "lng": 6.5621499
          }
        },
        {
          "username": "MarielledL",
          "address": "Louisse Henriettestraat 42A",
          "town": "Groningen",
          "location": {
            "lat": 53.22468199999999,
            "lng": 6.549742699999999
          }
        },
        {
          "username": "Joriekee",
          "address": "Celebesstraat 54b",
          "town": "Groningen",
          "location": {
            "lat": 53.2338382,
            "lng": 6.571886
          }
        },
        {
          "username": "Shirokii",
          "address": "Oosterhamrikkade  1035",
          "town": "Groningen",
          "location": {
            "lat": 53.2260178,
            "lng": 6.568467
          }
        },
        {
          "username": "Kristel",
          "address": "Parelstraat 112",
          "town": "Groningen",
          "location": {
            "lat": 53.2267804,
            "lng": 6.5220359
          }
        },
        {
          "username": "FritzZ",
          "address": "Saffierstraat 124",
          "town": "Groningen",
          "location": {
            "lat": 53.2301764,
            "lng": 6.5211666
          }
        },
        {
          "username": "Brenda",
          "address": "Aquamarijnstraat 489",
          "town": "Groningen",
          "location": {
            "lat": 53.2323278,
            "lng": 6.523634299999999
          }
        },
        {
          "username": "Maurice",
          "address": "Hamburgerstraat 12a",
          "town": "Groningen",
          "location": {
            "lat": 53.2312807,
            "lng": 6.5778813
          }
        },
        {
          "username": "Wybren Wierenga",
          "address": "Oosterhamrikkade  1035",
          "town": "Groningen",
          "location": {
            "lat": 53.2260178,
            "lng": 6.568467
          }
        },
        {
          "username": "Lammert",
          "address": "Aquamarijnstraat 563",
          "town": "Groningen",
          "location": {
            "lat": 53.2323278,
            "lng": 6.523634299999999
          }
        },
        {
          "username": "Monica",
          "address": "Aquamarijnstraat 857",
          "town": "Groningen",
          "location": {
            "lat": 53.2318921,
            "lng": 6.5212416
          }
        },
        {
          "username": "Evite",
          "address": "Parelstraat 112",
          "town": "Groningen",
          "location": {
            "lat": 53.2267804,
            "lng": 6.5220359
          }
        },
        {
          "username": "Erikv",
          "address": "Pelsterstraat 10-3",
          "town": "Groningen",
          "location": {
            "lat": 53.2168641,
            "lng": 6.5665681
          }
        },
        {
          "username": "Kenny",
          "address": "Saffierstraat 150",
          "town": "Groningen",
          "location": {
            "lat": 53.2301764,
            "lng": 6.5211666
          }
        },
        {
          "username": "Kapitein Luv",
          "address": "Hereweg  40a",
          "town": "Groningen",
          "location": {
            "lat": 53.20934579999999,
            "lng": 6.5723375
          }
        },
        {
          "username": "Thereza",
          "address": "Aquamarijnstraat 509",
          "town": "Groningen",
          "location": {
            "lat": 53.2323278,
            "lng": 6.523634299999999
          }
        },
        {
          "username": "Manon ten Have",
          "address": "Saffierstraat 22",
          "town": "Groningen",
          "location": {
            "lat": 53.2301764,
            "lng": 6.5211666
          }
        },
        {
          "username": "Aedo",
          "address": "Aquamarijnstraat 563",
          "town": "Groningen",
          "location": {
            "lat": 53.2323278,
            "lng": 6.523634299999999
          }
        },
        {
          "username": "Paula Lunenborg",
          "address": "Louise Henriettestraat 42a",
          "town": "Groningen",
          "location": {
            "lat": 53.22468199999999,
            "lng": 6.549742699999999
          }
        },
        {
          "username": "Rosalie",
          "address": "Professor Rankestraat 16",
          "town": "Groningen",
          "location": {
            "lat": 53.22058269999999,
            "lng": 6.5810154
          }
        },
        {
          "username": "HenkW",
          "address": "Aquamarijnstraat 129",
          "town": "Groningen",
          "location": {
            "lat": 53.2329942,
            "lng": 6.5272763
          }
        },
        {
          "username": "Alienke",
          "address": "Heymanslaan 12a",
          "town": "Groningen",
          "location": {
            "lat": 53.2292593,
            "lng": 6.573288000000001
          }
        },
        {
          "username": "HildeDJ",
          "address": "Van Speykstraat  49a",
          "town": "Groningen",
          "location": {
            "lat": 53.212364,
            "lng": 6.5522857
          }
        },
        {
          "username": "David123",
          "address": "Brugstraat 22a",
          "town": "Groningen",
          "location": {
            "lat": 53.2164412,
            "lng": 6.560375
          }
        },
        {
          "username": "willeke96",
          "address": "Aquamarijnstraat 461",
          "town": "Groningen",
          "location": {
            "lat": 53.2323278,
            "lng": 6.523634299999999
          }
        },
        {
          "username": "Tijmen Pel",
          "address": "Saffierstraat 6",
          "town": "Groningen",
          "location": {
            "lat": 53.2301764,
            "lng": 6.5211666
          }
        },
        {
          "username": "Siepel",
          "address": "Metaallaan 127",
          "town": "Groningen",
          "location": {
            "lat": 53.2226745,
            "lng": 6.536107899999999
          }
        },
        {
          "username": "Eveline",
          "address": "van Speykstraat 42a",
          "town": "Groningen",
          "location": {
            "lat": 53.2121272,
            "lng": 6.5526087
          }
        },
        {
          "username": "marliesvanrhee",
          "address": "Van Speykstraat 42a",
          "town": "Groningen",
          "location": {
            "lat": 53.2121272,
            "lng": 6.5526087
          }
        },
        {
          "username": "Hanneke7-n",
          "address": "Saffierstraat 156",
          "town": "Groningen",
          "location": {
            "lat": 53.2301764,
            "lng": 6.5211666
          }
        },
        {
          "username": "Luuk Berger",
          "address": "van Speykstraat 40B",
          "town": "Groningen",
          "location": {
            "lat": 53.21214430000001,
            "lng": 6.552699
          }
        },
        {
          "username": "CharlotteH",
          "address": "Aquamarijnstraat 771",
          "town": "Groningen",
          "location": {
            "lat": 53.2319286,
            "lng": 6.521182599999999
          }
        },
        {
          "username": "Wietske Visser",
          "address": "Oppenheimstraat 45a",
          "town": "Groningen",
          "location": {
            "lat": 53.2301495,
            "lng": 6.570496899999999
          }
        },
        {
          "username": "Rob Klok",
          "address": "Aqaumarijnstraat 519",
          "town": "Groningen",
          "location": {
            "lat": 53.2323278,
            "lng": 6.523634299999999
          }
        },
        {
          "username": "Marjan Dwarshuis",
          "address": "Saffierstraat 156",
          "town": "Groningen",
          "location": {
            "lat": 53.2301764,
            "lng": 6.5211666
          }
        },
        {
          "username": "Rickert",
          "address": "van Speykstraat 40b",
          "town": "Groningen",
          "location": {
            "lat": 53.21214430000001,
            "lng": 6.552699
          }
        },
        {
          "username": "MariekeFaber",
          "address": "Aquamarijnstraat 847",
          "town": "Groningen",
          "location": {
            "lat": 53.2318921,
            "lng": 6.5212416
          }
        },
        {
          "username": "MennoVelthuis",
          "address": "Aquamarijnstraat 519",
          "town": "Groningen",
          "location": {
            "lat": 53.2323278,
            "lng": 6.523634299999999
          }
        },
        {
          "username": "miriamotter",
          "address": "Metaallaan 91",
          "town": "Groningen",
          "location": {
            "lat": 53.2227912,
            "lng": 6.5361259
          }
        },
        {
          "username": "Grietje_Eva",
          "address": "Hereweg 40a",
          "town": "Groningen",
          "location": {
            "lat": 53.20934579999999,
            "lng": 6.5723375
          }
        },
        {
          "username": "lauramoorlag",
          "address": "Van Speykstraat 49a",
          "town": "Groningen",
          "location": {
            "lat": 53.212364,
            "lng": 6.5522857
          }
        },
        {
          "username": "PieterK",
          "address": "Marsstraat 117",
          "town": "Groningen",
          "location": {
            "lat": 53.233003,
            "lng": 6.533896299999999
          }
        },
        {
          "username": "louelle",
          "address": "Van Speykstraat 42a",
          "town": "Groningen",
          "location": {
            "lat": 53.2121272,
            "lng": 6.5526087
          }
        },
        {
          "username": "Hendertje",
          "address": "Gorechtkade 127a",
          "town": "Groningen",
          "location": {
            "lat": 53.22738349999999,
            "lng": 6.5766808
          }
        },
        {
          "username": "Gerwin Wolting",
          "address": "Radijsstraat 19",
          "town": "Groningen",
          "location": {
            "lat": 53.2292967,
            "lng": 6.5520384
          }
        },
        {
          "username": "Alfred",
          "address": "Parelstraat 74",
          "town": "Groningen",
          "location": {
            "lat": 53.2267532,
            "lng": 6.5220651
          }
        },
        {
          "username": "Arjan Dwarshuis",
          "address": "Parelstraat 74",
          "town": "Groningen",
          "location": {
            "lat": 53.2267532,
            "lng": 6.5220651
          }
        },
        {
          "username": "HugoterHorst",
          "address": "Eendrachtskade ZZ 14A",
          "town": "Groningen",
          "location": {
            "lat": 53.2139215,
            "lng": 6.5529115
          }
        },
        {
          "username": "Reinders",
          "address": "IJselstraat 57a",
          "town": "Groningen",
          "location": {
            "lat": 53.2073785,
            "lng": 6.564051099999999
          }
        },
        {
          "username": "Jeanet",
          "address": "Jozef Israelsstraat 49",
          "town": "Groningen",
          "location": {
            "lat": 53.2161264,
            "lng": 6.5525818
          }
        },
        {
          "username": "Bernadet",
          "address": "Celebesstraat 54b",
          "town": "Groningen",
          "location": {
            "lat": 53.2338382,
            "lng": 6.571886
          }
        },
        {
          "username": "Lennard",
          "address": "Jan Goeverneurstraat 21",
          "town": "Groningen",
          "location": {
            "lat": 53.2118782,
            "lng": 6.5797721
          }
        },
        {
          "username": "Janko",
          "address": "Aquamarijnstraat 509",
          "town": "Groningen",
          "location": {
            "lat": 53.2323278,
            "lng": 6.523634299999999
          }
        },
        {
          "username": "Mayke",
          "address": "Aquamarijnstraat 549",
          "town": "Groningen",
          "location": {
            "lat": 53.2323278,
            "lng": 6.523634299999999
          }
        },
        {
          "username": "Lech Walesa",
          "address": "Bataviastraat 71",
          "town": "Groningen",
          "location": {
            "lat": 53.2344383,
            "lng": 6.5693562
          }
        },
        {
          "username": "Irislok",
          "address": "Aquamarijnstraat 731",
          "town": "Groningen",
          "location": {
            "lat": 53.2318746,
            "lng": 6.5211962
          }
        },
        {
          "username": "AnjaKr",
          "address": "Saffierstraat 166",
          "town": "Groningen",
          "location": {
            "lat": 53.2301764,
            "lng": 6.5211666
          }
        },
        {
          "username": "FarmaFeut",
          "address": "Illegaliteitslaan 72",
          "town": "Groningen",
          "location": {
            "lat": 53.2080414,
            "lng": 6.5541451
          }
        },
        {
          "username": "JPV",
          "address": "Aquamarijnstraat 463",
          "town": "Groningen",
          "location": {
            "lat": 53.2323278,
            "lng": 6.523634299999999
          }
        },
        {
          "username": "DavidGoliath",
          "address": "Saffierstraat 176",
          "town": "Groningen",
          "location": {
            "lat": 53.2301764,
            "lng": 6.5211666
          }
        },
        {
          "username": "Carlolavolpe",
          "address": "Hamburgerstraat 12a",
          "town": "Groningen",
          "location": {
            "lat": 53.2312807,
            "lng": 6.5778813
          }
        },
        {
          "username": "Erwin",
          "address": "Saffierstraat 6",
          "town": "Groningen",
          "location": {
            "lat": 53.2301764,
            "lng": 6.5211666
          }
        },
        {
          "username": "Marten1995",
          "address": "Aquamarijnstraat 475",
          "town": "Groningen",
          "location": {
            "lat": 53.2323278,
            "lng": 6.523634299999999
          }
        },
        {
          "username": "LauraFrancke",
          "address": "turkooisstraat 33",
          "town": "Groningen",
          "location": {
            "lat": 53.23058839999999,
            "lng": 6.5251161
          }
        },
        {
          "username": "Aliët",
          "address": "Parelstraat 112",
          "town": "Groningen",
          "location": {
            "lat": 53.2267804,
            "lng": 6.5220359
          }
        },
        {
          "username": "Sybren",
          "address": "Spaanse Aakstraat 7",
          "town": "Groningen",
          "location": {
            "lat": 53.2308219,
            "lng": 6.5559883
          }
        },
        {
          "username": "ChristelHaaksema",
          "address": "Plutolaan 68",
          "town": "Groningen",
          "location": {
            "lat": 53.23298029999999,
            "lng": 6.538149199999999
          }
        },
        {
          "username": "SigridDijk",
          "address": "Jan Hissink Jansenstraat",
          "town": "Groningen",
          "location": {
            "lat": 53.225827,
            "lng": 6.575356800000001
          }
        },
        {
          "username": "Anneloes",
          "address": "Multatulistraat 109",
          "town": "Groningen",
          "location": {
            "lat": 53.1962903,
            "lng": 6.5648053
          }
        },
        {
          "username": "Lisanne",
          "address": "Floresplein 20a",
          "town": "Groningen",
          "location": {
            "lat": 53.2313036,
            "lng": 6.568282
          }
        },
        {
          "username": "leontromp",
          "address": "Briljantstraat 7",
          "town": "Groningen",
          "location": {
            "lat": 53.2316918,
            "lng": 6.5281555
          }
        },
        {
          "username": "Marit Venhuizen",
          "address": "Van Heemskerckstraat 38b",
          "town": "Groningen",
          "location": {
            "lat": 53.2127338,
            "lng": 6.5484334
          }
        },
        {
          "username": "ldoornbos",
          "address": "Wagnersingel 13B",
          "town": "Groningen",
          "location": {
            "lat": 53.2017581,
            "lng": 6.5835189
          }
        },
        {
          "username": "Fiep",
          "address": "Parelstraat 222",
          "town": "Groningen",
          "location": {
            "lat": 53.2268535,
            "lng": 6.521903
          }
        },
        {
          "username": "Imkea",
          "address": "Aquamarijnstraat 529",
          "town": "Groningen",
          "location": {
            "lat": 53.2323278,
            "lng": 6.523634299999999
          }
        },
        {
          "username": "James",
          "address": "jadestraat 151",
          "town": "Groningen",
          "location": {
            "lat": 53.2271827,
            "lng": 6.5279466
          }
        },
        {
          "username": "steven",
          "address": "Parelstraat 222",
          "town": "Groningen",
          "location": {
            "lat": 53.2268535,
            "lng": 6.521903
          }
        },
        {
          "username": "Sjorrik",
          "address": "Van Speykstraat 40B",
          "town": "Groningen",
          "location": {
            "lat": 53.21214430000001,
            "lng": 6.552699
          }
        },
        {
          "username": "Marliess",
          "address": "Uranusstraat 42",
          "town": "Groningen",
          "location": {
            "lat": 53.2323034,
            "lng": 6.5347015
          }
        },
        {
          "username": "Fridom",
          "address": "Aquamarijnstraat 763",
          "town": "Groningen",
          "location": {
            "lat": 53.23185669999999,
            "lng": 6.521180699999999
          }
        }
      ];

      function infoWindowCreator(tekst, marker)
      {
        return function() {
          var infowindow = new google.maps.InfoWindow({
            content: '<div id="content">'+
              '<div id="siteNotice">'+
              '</div>'+
              '<h1 id="firstHeading" class="firstHeading">' + tekst + '</h1>'+
              '<div id="bodyContent">'+
              '<p>' + tekst + '</p>'+
              '</div>'+
              '</div>'
          });

          infowindow.open(map, marker);
        };
      }

      function pinSymbol(color) {
          return {
              path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z M -2,-30 a 2,2 0 1,1 4,0 2,2 0 1,1 -4,0',
              fillColor: color,
              fillOpacity: 1,
              strokeColor: '#000',
              strokeWeight: 2,
              scale: 1,
         };
      }

      var avg = {
        lat: 0,
        lng: 0
      };

      for(lid in leden)
      {

        avg.lat += leden[lid].location.lat;
        avg.lng += leden[lid].location.lng;

        var marker = new google.maps.Marker({
          position: {
            lat: leden[lid].location.lat + (Math.random() * (0.0001) - 0.00005),
            lng: leden[lid].location.lng + (Math.random() * (0.0001) - 0.00005),
          },
          map: map,
          title: lid.username
        });

        marker.addListener('click', infoWindowCreator(leden[lid].username, marker));
      }

      avg.lat /= leden.length;
      avg.lng /= leden.length;

      var marker = new google.maps.Marker({
        position: avg,
        map: map,
        label: 'A',
        icon: pinSymbol("#FF0"),
        title: "Zwaartepunt"
      });

      marker.addListener('click', infoWindowCreator("Gemiddelde woonplaats van de GSV'er", marker));
    }

    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6jDVVVXM9-izO7nlo2OensyEJQOuZUro&amp;signed_in=false&amp;callback=initMap"></script>
  </body>
</html>
