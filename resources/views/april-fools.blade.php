@extends('layouts.default')

@section('title', 'GSV-credits')
@section('description', 'Actief forum & meer geld')
@section('body-id', '')

@section('content')
    <style lang="css">
        .spinner {
            border: 8px solid #f3f3f3; /* Light grey */
            border-top: 8px solid #2A1443; /* Purple */
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .credits-overzicht {
            border-radius: 10px;
            margin-top:2em;
            padding:.5em 1em;
            background-color:#EEE;
        }

        .purchase_option {
            background-color: #2A1443;
            display: inline-block;
            color: #fff;
            padding: 1em 1.2em;
            margin-right: 0.5em;
            margin-bottom: 0.5em;
            width: 120px;
        }

        .purchase_option div {
            margin: 0 auto;
        }

        .purchase_option:hover {
            background-color: #4f267e;
        }

        a.small_button {
            padding: .2em .5em !important;
        }
    </style>
    <article class="artikel column-holder" role="main">
        <div>
            <h1>GSV-credits</h1>
            <p class="lead">Om forumactiviteit verder te stimuleren en tegelijkertijd wat geld binnen te halen voor de vereniging, bestaan er vanaf nu GSV-credits op het forum.</p>
        </div>

        <p style="margin: 0">De credits kun je hier op de website kopen, of verdienen door het forum te gebruiken. Met deze credits kun je GSVnet op verschillende manieren personaliseren. Het aantal mogelijkheden is nu nog beperkt, maar zal in de komende tijd snel uitgebreid worden. Scroll naar onderen om te zien wat je nu al kunt doen met GSV-credits.<br><br>
        <p style="margin: 0">Zoals gezegd verdien je credits door simpelweg gebruik te maken van het forum. Het lezen van topics, plaatsen van reacties en ontvangen van likes geven je allemaal gratis credits. De Webcie houdt zich het recht om credits te ontnemen indien topics of reacties geen inhoudelijke bijdrage leveren.<br>
        Mocht je de vereniging extra financieel willen steunen, dan geven de websitecredits daar ook mogelijkheid toe. Via onderstaand formulier kun je kiezen tussen bundels van verschillende grootte.</p>
        <div class="credits-overzicht">
            <h2>Overzicht</h2>
            <p>Jouw credits: {{ Auth::user()->getAprilFools()->creditBalance() }}</p>
            <a id="buy_credits_toggle" onclick="showBuyMenu(this);event.preventDefault();" class="button" rel="nofollow">Credits kopen</a>
            <div id="buy_credits" style="display:none;">
                <div id="loader">
                    <div class="spinner"></div>
                    <i>Bezig met laden</i>
                </div>
                <div id="purchase_select_amount" style="display:none;">
                    <div style="margin-bottom: 1em;">Beschikbare bundels:</div>
                    <div class="purchase_option" onclick="chooseBundle(5,0.99, 0)">
                        <div>5 credits</div>
                        <div>&euro;0,99</div>
                    </div>
                    <div class="purchase_option" onclick="chooseBundle(10,1.89, 1)">
                        <div>10 credits</div>
                        <div>&euro;1,89</div>
                    </div>
                    <div class="purchase_option" onclick="chooseBundle(15,2.69, 2)">
                        <div>15 credits</div>
                        <div>&euro;2,69</div>
                    </div>
                </div>
                <div id="purchase_select_bank" style="display:none;">
                    <strong>Controleer de details van je gekozen bundel.</strong>
                    <div>Credits: <span id="put_credits"></span></div>
                    <div>Prijs: <span id="put_price"></span></div>
                    <div style="margin-top: 1em;">
                        Bevestig je bank:
                        <select name="bank">
                            <option value="0">ABN AMRO</option>
                            <option value="0">ASN Bank</option>
                            <option value="0">Rabobank</option>
                            <option value="0">SNS Bank</option>
                            <option value="0">Regiobank</option>
                            <option value="0">ING</option>
                            <option value="0">KNAB</option>
                            <option value="0">Triodos Bank</option>
                        </select>
                    </div>
                    <div style="margin-top: 1.5em; width: 50%;"><input id="agree_to_disagree" type="checkbox"> Hierbij geef ik de fiscus allerminst toestemming om het gekozen bedrag van mijn bij de GSV bekende rekening af te schrijven.</div>
                    <div style="margin-top: 1.5em; color: red; font-size:0.8em; display: none;" id="disagree_error"><i>Je moet akkoord gaan met de voorwaarden!</i></div>
                    <div style="margin-top: 1.5em;"><a id="buy_finalize_toggle" onclick="finalizePurchase(this);event.preventDefault();" class="button" rel="nofollow">Aankoop bevestigen</a></div>
                </div>
                <form id="purchase_hidden_form" style="display:none;"></form>
            </div>
        </div>
        <div class="credits-overzicht">
            <h2>Credits besteden</h2>
            <div>
                <form id="purchase_bg-color_form" method="post" action="/spend-gsv-credits">
                    <strong>Achtergrond</strong><br>Verander de achtergrondkleur voor jezelf op GSVnet. Andere GSV'ers kunnen de gekozen kleur terugzien als achtergrond op jouw jaarbundelpagina!<br>
                    Kleurtje:
                    <select name="bg-color" id="select_bg-color">
                        <option value="" style="background-color:#000;">kies...</option>
                        <option value="#FFF" style="background-color:#FFF;">Wit</option>
                        <option value="#EEE" style="background-color:#CCC;">Grijs</option>
                        <option value="#000" style="background-color:#000;">Zwart</option>
                        <option value="#00FF00" style="background-color:#00FF00;">Groen</option>
                        <option value="#FF0000" style="background-color:#FF0000;">Rood</option>
                        <option value="#f1f43f" style="background-color:#f1f43f;">Geel</option>
                        <option value="#0000FF" style="background-color:#0000FF;">Blauw</option>
                        <option value="#4f267e" style="background-color:#4f267e;">Paars</option>
                    </select> 
                    <div><i>Prijs: 10 credits</i> <a onclick="buyBgColor();event.preventDefault();" class="button small_button" rel="nofollow" disabled>Koop</a></div>
                </form>
            </div>
            <div style="margin-top:1em;">
                <form id="purchase_txt-color_form" method="post" action="/spend-gsv-credits">
                    <strong>Tekstkleur</strong><br>Verander de standaard tekstkleur voor jezelf op GSVnet. Andere GSV'ers kunnen de gekozen kleur terugzien op jouw jaarbundelpagina!<br>
                    Kleurtje:
                    <select name="txt-color" id="select_txt-color">
                        <option value="" style="background-color:#000;">kies...</option>
                        <option value="#FFF" style="background-color:#FFF;">Wit</option>
                        <option value="#EEE" style="background-color:#CCC;">Grijs</option>
                        <option value="#000" style="background-color:#000;">Zwart</option>
                        <option value="#00FF00" style="background-color:#00FF00;">Groen</option>
                        <option value="#FF0000" style="background-color:#FF0000;">Rood</option>
                        <option value="#f1f43f" style="background-color:#f1f43f;">Geel</option>
                        <option value="#0000FF" style="background-color:#0000FF;">Blauw</option>
                        <option value="#4f267e" style="background-color:#4f267e;">Paars</option>
                    </select> 
                    <div><i>Prijs: 10 credits</i> <a onclick="buyTextColor();event.preventDefault();" class="button small_button" rel="nofollow">Koop</a></div>
                </form>
            </div>
            <div style="margin-top:1em;">
                <form id="purchase_special_menu_form" method="post" action="/spend-gsv-credits">
                    <div style="display:none;"><input name="special_menu" id="buy_special_menu" type="checkbox"></div>
                    <strong>Geheim menu</strong><br>Als je deze optie koopt krijg je toegang tot geheime functionaliteit in het menu van GSVnet.<br>
                    <div><i>Prijs: 50 credits</i> <a onclick="buySpecialMenu();event.preventDefault();" class="button small_button" rel="nofollow">Koop</a></div>
                </form>
            </div>
        </div>
    </article>
    
    <script>

        /* PURCHASE CREDITS */

        var chosenBundle = 0;

        function randomInterval(min, max) {
        return Math.random() * (max - min) + min;
        }

        // No babel transpiling set up :'(
        function showBuyMenu(origin) {
            $('#buy_credits').show();
            $(origin).hide();

            setTimeout(function(){
                $('#loader').hide();
                $('#purchase_select_amount').show();
            }, randomInterval(1000, 2000));
        }

        function chooseBundle(credits, price, id) {
            $('#purchase_select_amount').hide();
            $('#loader').show();
            chosenBundle = id;

            setTimeout(function(){
                $('#put_credits').html(credits);
                $('#put_price').html("&euro;" + price);
                $('#loader').hide();
                $('#purchase_select_bank').show();
            }, randomInterval(2000, 3000));
        }

        function finalizePurchase() {
            if(!$('#agree_to_disagree').is(":checked")) {
                $('#disagree_error').show();
                return;
            }
            $('#purchase_select_bank').hide();
            $('#loader').show();

            setTimeout(function(){
                $('#loader').find('i').html('Betalingsverzoek in genen dele versturen...');
                setTimeout(function(){
                    $('#loader').find('i').html('Je wordt teruggeleid');
                    setTimeout(function(){
                        var form = $('#purchase_hidden_form');
                        form.attr('action', '/gsv-credits/' + chosenBundle);
                        form.attr("method", "post");
                        form.submit();
                    }, randomInterval(2000, 3000));
                }, randomInterval(4000, 5000));
            }, 800);
        }

        /* SPEND CREDITS */

        function buyBgColor() {
            var color = $('#select_bg-color').val();
            $('#purchase_bg-color_form').submit();
        }

        function buyTextColor() {
            var color = $('#select_txt-color').val();
            $('#purchase_txt-color_form').submit();
        }

        function buySpecialMenu() {
            $('#buy_special_menu').prop('checked', true);
            $('#purchase_special_menu_form').submit();
        }
    </script>
@stop