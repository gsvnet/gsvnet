<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link id="style_main" rel="stylesheet" href="stylesheets/homepage.css?v=1.5.5">
    <title>GSVnet.nl - Website van de Gereformeerde Studentenvereniging te Groningen</title>
</head>

<body>
    <div id="overlay">
        <a id="overlay-close">Sluiten</a>
        <form>
            <label for="first-name">Je naam</label>
            <input type="text" name="first-name">
            <input type="text" name="last-name">
        </form>
    </div>
    <div class="wrapper">
        
        <!-- NAV MENU -->

        <nav id="nav-menu" class="shrunk">
            <a href="#intro" class="logo"><div></div></a>
            <div id="mobile-nav-toggle">
                <i class="fa fa-bars"></i>
            </div>
            <div class="mobile-nav-links">
                <a href="#intro">Intro</a>
                <a href="#gsv">GSV</a>
                <a href="#activiteiten">KEI-week</a>
                <a href="#fotos">Foto's</a>
                <a href="{{ action('MemberController@study') }}">Studeren</a>
                <a href="{{ action('ForumThreadsController@getIndex') }}">Forum</a>
                <a href="{{ action('MemberController@becomeMember') }}" id="register" class="focus">Word lid!</a> 
            </div>
            <div class="links">
                <a href="#gsv">GSV</a>
                <a href="#activiteiten">KEI-week</a>
                <a href="#fotos">Foto's</a>
                <a href="{{ action('MemberController@study') }}">Studeren</a>
                <a href="{{ action('ForumThreadsController@getIndex') }}">Forum</a>
            </div>
            <a href="{{ action('MemberController@becomeMember') }}" id="register" class="right">Word lid!</a> 
        </nav>

        <!-- END NAV MENU -->

        <!-- INTRO -->

        <header id="intro" class="black">
            <div id="intro-video"></div>
            <div id="intro-cover" class="flex center z-up">
                <div>
                    <p>De GSV organiseert tal van activiteiten tijdens de KEI-week.</p>
                    <a class="button" href="#activiteiten">Kom eens langs!</a>
                </div>
            </div>
            <a href="#gsv" class="one-page-arrow">
                <i class="fa fa-chevron-down animated infinite fadeInDown"></i>
            </a>
            <div id="video-controls">
                <span class="fa-stack">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-stack-1x fa-volume-up"  style="display: none"></i>
                    <i class="fa fa-stack-1x fa-volume-off"></i>
                </span>
            </div>
        </header>

        <!-- END INTRO -->

        <!-- GSV -->

        <section id="gsv" class="partial">
            <div class="article col-small">
                <div class="col"><div class="image-frame" id="gsv-group-photo"><img src="/images/gsv_groepsfoto_resized.jpg"></div></div>
                <div class="col">
                    <div class="trim">
                        <h1>Sta jij hier volgend jaar tussen?</h1>
                        <p>
                            Of je net begint met je studie of al langer studeert; een christelijke studentenvereniging kan veel toevoegen aan je persoonlijke, sociale en geloofsontwikkeling. De GSV -Gereformeerde Studentenvereniging- biedt op dit moment ongeveer 200 leden een onvergetelijke studententijd! Op deze site en via social media kun je ontdekken wie wij zijn. 
                        </p>
                        <div class="social">
                            <span>
                                <a href="https://facebook.com/GSVgroningen/" class="fa-stack">
                                    <i class="fa fa-circle fa-fb-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x"></i>
                                </a>
                            </span>
                            <span>
                                <a href="https://www.instagram.com/_u/gsvgroningen/" class="fa-stack">
                                    <i class="fa fa-circle fa-ig-circle fa-stack-2x"></i>
                                    <i class="fa fa-instagram fa-stack-1x"></i>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PILLARS -->

            <div id="pijlers" class="subsection">
                <div id="pillar-tab-controls-container" class="subsection partial complement">
                    <div id="pillar-tab-controls" class="article narrow no-flex-wrap">
                        <a href="#pijlers" class="icon-text-container">
                            <div class="badge">
                                <div class="cover-image" style="background-image:url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNS4wLjIsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMTAwcHgiIGhlaWdodD0iMTAwcHgiIHZpZXdCb3g9IjAgMCAxMDAgMTAwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAxMDAgMTAwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KCTxwYXRoIGZpbGwtcnVsZT0iZXZlbm9kZCIgY2xpcC1ydWxlPSJldmVub2RkIiBmaWxsPSIjMkExNDQyIiBkPSJNOTEuNjc4LDM0LjA5OWMtNC41NzItMC42MjUtNS42NjEsNi40NzktNC40OSwxMi4yMzkNCgkJQzc2LjEzMSw1OC45NTUsNjYuMTk3LDcyLjY5OSw1NC41MjMsODQuNzFjLTguMDUxLTMuMDU2LTIxLjA3Ny02LjMzNy0zMS40MTctOS4zOTJjLTMuMzQyLTAuOTcxLTguMDUtMi4wNTYtOS43OTYtMy42NjUNCgkJYy0zLjUwMi0zLjIzNC0zLjg3Mi0xMi4xMDktMC40MTItMTMuODgxYzIuNDI4LTEuMjUxLDcuNDk1LDAuNzU2LDEwLjYxMywxLjYzNWM2LjU3OCwxLjg0MSwxMi45OTUsNC4xMDEsMjAuMDAzLDYuMTI2DQoJCWMzLjgyMiwxLjA4OSw4LjM3MywyLjc1NSwxMC42MDYsMi40MzRjMy45NzYtMC41NTcsNy42MTUtNy4wNTUsMTEuMDIxLTExLjAxMmM3LjIzNS04LjM4NywxMi42NjEtMTQuNjYyLDIwLjQxNi0yMy42NjcNCgkJYzIuMzI4LTIuNzE0LDkuOTk3LTguNTU0LDkuMzg0LTEyLjY2MWMtMC40NTktMy4xNzEtNy43MzUtNC4yNzQtMTAuNjExLTQuODk0Yy05LjczNS0yLjExOC0xNS40MTYtMy4xOTYtMjQuODk4LTUuMzE0DQoJCWMtNC4zODktMC45ODQtOS40NzktMy4wMjItMTIuNjQ3LTIuNDUzQzQzLjQ4NCw4LjU3NCwzOSwxNS4zNSwzNi4xNjMsMTguNTg0Yy02LjM5NSw3LjMzMy0xMy40MjgsMTUuMjEyLTE5Ljk5NywyMi40NTINCgkJQzEwLjM2NSw0Ny40MjgsNC44NjIsNTEuMiwzLjUxMiw2MS40MzljMCwxLjQ5OCwwLDIuOTksMCw0LjQ5N2MxLjcxMiwxNS4wMzIsMTcuMDU1LDE1LjM5MiwzMS4wMjUsMTkuNTk4DQoJCWMyLjc2MiwwLjgzNiw2LjkxOCwyLjQ3NywxMS4wMjIsMy42NjdjMy42NzMsMS4wNjksOS4xMDksMy4yMjYsMTEuNDI0LDIuODU0YzMuNDc5LTAuNTU3LDcuMDgzLTcuMzQ1LDkuNzk2LTEwLjYxDQoJCWM5LjU3NS0xMS40ODksMTguODI4LTIxLjgyLDI3Ljc2LTMzLjQ2NEM5MS45MDcsNDMuMjg0LDk3LjI1MiwzNC44Niw5MS42NzgsMzQuMDk5eiBNMzIuMzA0LDUyLjI2OA0KCQljMi4xNjctMi40NjMsNi4yMjItNS43NjMsOS4wMDYtOC45OTdjNC4xNjctNC44Myw3LjYwOC04LjgxNCwxMS40OS0xMy4zMTVjLTQuOTY3LTEuMzQyLTguOTQ1LTIuNjQyLTkuNjcyLTMuOTczDQoJCWMwLDAsMy40MjYtNi42ODYsNi4xMDktNS42NzNjMS40MzUsMC41NDEsNS4wMzEsMS41ODcsOS4zNzUsMi44ODNjMS41NDUtMS44NjMsMi42NTQtMy4zODksNC45MzQtNS4zNDVsNy41MywxLjg4DQoJCWMtMi42OCwzLjczNS0zLjUyMSw0LjczNS00LjUzOSw1Ljg5YzIuNzA1LDAuODU3LDUuMzk2LDEuNzUsNy44MiwyLjYzNmMyLjc0NywwLjk5OS0xLjAwMiw3LjY3NC0zLjc0OCw2LjY3Ng0KCQljLTIuNzM0LTAuOTk5LTYuMTU4LTEuOTQ0LTkuNjU2LTIuODU2Yy00LjI0NCw0LjkyNC03Ljg3NSw5LjEyNC0xMi4zNDYsMTQuMzA5Yy0yLjc4NCwzLjIzMy01Ljc1Nyw4LjU0Mi05LjAwNSw4Ljk5OQ0KCQlDMzkuNjAyLDU1LjM4MSwzMC40MSw1NC40MjEsMzIuMzA0LDUyLjI2OHoiLz4NCjwvZz4NCjwvc3ZnPg0K)"></div>
                            </div>
                            <h3>Christelijk</h3>
                        </a>
                        <a href="#pijlers" class="icon-text-container">
                            <div class="badge">
                                <div class="cover-image" style="background-image:url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNS4wLjIsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMTAwcHgiIGhlaWdodD0iMTAwcHgiIHZpZXdCb3g9IjAgMCAxMDAgMTAwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAxMDAgMTAwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KCTxwYXRoIGZpbGwtcnVsZT0iZXZlbm9kZCIgY2xpcC1ydWxlPSJldmVub2RkIiBmaWxsPSIjMkExNDQyIiBkPSJNODAuMzg3LDM5LjUzNmMtMC41NjktNC4yMjktNi4yNTUtNS43NzYtNy45NTQtMS43NDQNCgkJYy0yLjE0OS0zLjA0My04Ljk4LTIuOTYxLTguODg2LDEuOTU1Yy0yLjc0OC0yLjc4Mi0xMi40NjctMC45MjctOS45NDIsNS4wOTljLTcuNjkxLTIuNTk1LDEuNjk0LTExLjkwOSw3LjI5OC05LjE3NQ0KCQljMi45My0yLjgyMyw4LjM5OS0zLjk5NiwxMS43ODYtMi4wMTFDNzcuMTAyLDMwLjE4OCw4NC4wNzcsMzQuODksODAuMzg3LDM5LjUzNnoiLz4NCgk8cGF0aCBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGNsaXAtcnVsZT0iZXZlbm9kZCIgZmlsbD0iIzJBMTQ0MiIgZD0iTTUyLjA4Niw0Ni40MjNjOS40NjYtMi4wODMsMTguOTMzLTQuMTY1LDI4LjM5OS02LjI0Nw0KCQljMS45MDgtMC40NDEsMi4wNiwxLjg2OCwyLjcyNiwzLjM3YzMuMzU4LTAuNzMsNy4wMzgtMS45NjMsOS4xMTItMC42ODJjMi45MTgsMy45ODgsNS41NTgsMTQuODg2LDMuNTM0LDE5LjA3Mw0KCQljLTEuODM0LDEuMzU3LTUuMTYzLDEuNzYtOC4wNjQsMi40MzVjMC44NzgsMy45OTcsMS43NTgsNy45OTQsMi42MzgsMTEuOTkxYy04LjQzMywyLjk1MS0yMS40MDIsNS44MDUtMzAuMjkzLDYuNjYzDQoJCUM1NS45MTIsNzEuOTgyLDU1Ljc4MSw1OC45MjYsNTIuMDg2LDQ2LjQyM3ogTTU2LjcwNSw0OS4zNzZjMi41MDksOS45MTksMy44NiwxOS4wOTksNS42MTcsMjguNTM4DQoJCWM2Ljg3My0wLjAwMywxNS44MDEtMy4yMjcsMjMuNDg5LTQuNTA1Yy0yLjEzMS05LjY3OC00LjI1OS0xOS4zNTQtNi4zODktMjkuMDNDNzEuODUyLDQ2LjA0NCw2NC4yNzgsNDcuNzEsNTYuNzA1LDQ5LjM3NnoNCgkJIE04Ni44MTksNTkuOTU0YzEuNjgzLTAuMzY5LDMuMzY4LTAuNzQsNS4wNS0xLjEwOWMtMC44MzMtMy43ODgtMS42NjUtNy41NzMtMi40OTktMTEuMzYxYy0xLjY4MiwwLjM3LTMuMzY1LDAuNzQxLTUuMDQ5LDEuMTENCgkJQzg1LjE1NCw1Mi4zODIsODUuOTg2LDU2LjE2OSw4Ni44MTksNTkuOTU0eiIvPg0KCTxwYXRoIGZpbGwtcnVsZT0iZXZlbm9kZCIgY2xpcC1ydWxlPSJldmVub2RkIiBmaWxsPSIjMkExNDQyIiBkPSJNNTkuNzA5LDU0LjAwOGMwLjQyLTAuMDkxLDMuMjg0LTEuMjg5LDMuNzA0LTEuMzgxDQoJCWMxLjQ3LDQuMzE3LDAuMTczLDkuNjYxLDIuOTI4LDExLjU3NWMzLjY3MS0xLjYzMywwLjgyOS04LjQ1MiwwLjg1OS0xMi40MDhjNS4wNDktMS4xMTEsNi4zOTQtMC44MzksMTEuNDQxLTEuOTUNCgkJYzEuNDg3LDcuNTY5LDMuMjg4LDE0LjY1LDUuMzUxLDIxLjMxOWMtNS42MTUsMi43MzQtMTMuMTY4LDMuMTQ4LTIwLjA1Niw1LjA3M0M2Mi43NDgsNjguOTY4LDYwLjQ3NCw2MC44NjYsNTkuNzA5LDU0LjAwOHoiLz4NCgk8cGF0aCBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGNsaXAtcnVsZT0iZXZlbm9kZCIgZmlsbD0iIzJBMTQ0MiIgZD0iTTIxLjU4OCwzMi40MzVjMC45ODktNC4wMzIsNi42NTEtNC45MzgsNy44NzctMC44NTkNCgkJYzIuMzk2LTIuNzIxLDguOTk3LTEuOTMsOC4zOTQsMi44MTZjMi45NDctMi40MDYsMTIuMTU5LDAuNDAxLDkuMDg3LDUuOTY3YzYuODM5LTIuODczLTEuNjAxLTEyLjA2MS03LjMwOS05Ljk5OQ0KCQljLTIuNTQtMy4wMzYtNi41MDYtNC4zNzctOS45OTEtMi44MDlDMjUuNzQsMjMuNzMzLDE4LjUwMiwyNy41NTcsMjEuNTg4LDMyLjQzNXoiLz4NCgk8cGF0aCBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGNsaXAtcnVsZT0iZXZlbm9kZCIgZmlsbD0iIzJBMTQ0MiIgZD0iTTM3LjU0Miw3Ny44NTdjLTguNzQ4LTEuODA2LTIxLjMzOC02LjAzMS0yOS40MDUtOS44NjUNCgkJYzEuMzAxLTMuODgxLDIuNjA0LTcuNzYyLDMuOTA1LTExLjY0MWMtMi44MTQtMC45OC02LjA4MS0xLjczOS03Ljc1OS0zLjI4M2MtMS41NjMtNC4zOCwyLjIyNy0xNC45MzQsNS41NTQtMTguNTg2DQoJCWMyLjE5OC0xLjA1Miw1LjcyNywwLjU2OCw4Ljk4OCwxLjY1M2MwLjgyNC0xLjQyMiwxLjIyLTMuNzAzLDMuMDcxLTMuMDU5YzkuMTg5LDMuMDgzLDE4LjM3OSw2LjE2NiwyNy41NjcsOS4yNDkNCgkJQzQ0LjQ1Myw1NC4zNjEsNDIuOTI0LDY3LjMzLDM3LjU0Miw3Ny44NTd6IE0yMi41LDM3LjM2OGMtMy4xNTIsOS4zOTUtNi4zMDMsMTguNzg2LTkuNDU2LDI4LjE4MQ0KCQljNy41MDYsMi4wOTMsMTYuMDQsNi4yNTIsMjIuODczLDYuOTkzYzIuNzU3LTkuMTk4LDUuMDgzLTE4LjE4MSw4LjYzNy0yNy43NzVDMzcuMjAzLDQyLjMwMSwyOS44NTIsMzkuODM0LDIyLjUsMzcuMzY4eg0KCQkgTTE3LjE4LDQxLjAzNmMtMS42MzMtMC41NDctMy4yNjctMS4wOTYtNC45MDEtMS42NDRjLTEuMDY5LDAuOTY4LTIuNDY2LDcuMzUyLTMuNywxMS4wMjdjMS42MzQsMC41NDgsMy4yNjgsMS4wOTYsNC45MDEsMS42NDUNCgkJQzE0LjcxMyw0OC4zODgsMTUuOTQ3LDQ0LjcxMSwxNy4xOCw0MS4wMzZ6Ii8+DQoJPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGZpbGw9IiMyQTE0NDIiIGQ9Ik00MS4wNzMsNDkuMDUxYy0wLjQwOS0wLjEzNy0xMC41MDMtMy42MjctMTAuOTEtMy43NjMNCgkJYy0zLjYwNCwwLjI3OC0xLjA3Niw5LjQ3Ny01Ljc0MywxMS4wMjJjLTMuNDc1LTIuMDE0LDEuNjczLTguMzE3LDIuMDY3LTEyLjI1NmMtNC45LTEuNjQ0LDEuMTA4LDAuNDc2LTMuNzkyLTEuMTY4DQoJCWMtMi4yODksNy4zNjgtNC4xODksMTQuMjE1LTYuOTU1LDIwLjYyNWM1LjI5MiwzLjMyLDEyLjExMSw0LjUzOCwxOC43NTIsNy4xODlDMzYuNDUsNjMuNjAxLDM5LjU3OSw1NS43ODcsNDEuMDczLDQ5LjA1MXoiLz4NCgk8Zz4NCgkJPHBhdGggZmlsbD0iIzJBMTQ0MiIgZD0iTTUzLjU0MywxNy4zNTFjMC4yOTIsMy4wOTMsMS4zOTgsMTMuNzE1LTIuODQ0LDE0LjAyNmMtMC4zMTgtNC43NzQtMS4yOTUtOS4wMDUtMS43LTEzLjcwOA0KCQkJQzUxLjIyNiwxOC40MjYsNTEuNzg4LDE3LjE2Nyw1My41NDMsMTcuMzUxeiIvPg0KCQk8cGF0aCBmaWxsPSIjMkExNDQyIiBkPSJNNjMuNDEzLDI0LjMxM2MtMi4wNzYsMy4xOTUtNS43NDcsOC4zNDQtOC45ODQsNy40MmMwLjY1OS0zLjkxOCwzLjE4Mi01LjU3Myw0LjU4Mi04LjU5Mw0KCQkJQzYxLjM0MywyMi44MTcsNjEuMDgyLDI0LjYzNiw2My40MTMsMjQuMzEzeiIvPg0KCQk8cGF0aCBmaWxsPSIjMkExNDQyIiBkPSJNNDAuNzU4LDI1LjE2MWMwLjUzNC0yLjEyNSwxLjg5Ni0zLjI0OSw0LjA4My0zLjM3M2MxLjM5NSwxLjE0OSwyLjQ4Nyw1LjQ2LDIuODA0LDUuODMzDQoJCQljMC4yMTYsMC4yNTYsMC40MjcsMC41MDgsMC42NDEsMC43MzZjMC41MSwwLjU0NCwwLjQ4LDEuNC0wLjA2NCwxLjkwOWMtMC4yOTUsMC4yNzUtMC42OCwwLjM5NC0xLjA1MSwwLjM1OA0KCQkJYy0wLjMxOC0wLjAzMS0wLjYyNS0wLjE3MS0wLjg1OS0wLjQyM2MtMC4yNDMtMC4yNi0wLjQ4My0wLjU0NS0wLjczMi0wLjgzOGMtMC4yNzUtMC4zMjUtMC41NTctMC42NTUtMC44NDctMC45NTENCgkJCUM0My4zMjgsMjcuMzk0LDQyLjYxMiwyNS44MDcsNDAuNzU4LDI1LjE2MXoiLz4NCgk8L2c+DQo8L2c+DQo8L3N2Zz4NCg==)"></div>
                            </div>
                            <h3>Sociaal</h3>
                        </a>
                        <a href="#pijlers" class="icon-text-container">
                            <div class="badge">
                                <div class="cover-image" style="background-image:url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNS4wLjIsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMTAwcHgiIGhlaWdodD0iMTAwcHgiIHZpZXdCb3g9IjAgMCAxMDAgMTAwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAxMDAgMTAwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KCTxwYXRoIGZpbGwtcnVsZT0iZXZlbm9kZCIgY2xpcC1ydWxlPSJldmVub2RkIiBmaWxsPSIjMkExNDQyIiBkPSJNNDkuNDc0LDguNDIzYzExLjYzNCw0LjY2NiwyNC42ODcsMTAuODQ5LDM2LjE0MSwxNi41MzENCgkJYzEuMjk2LDAuNjQ0LDQuMjc3LDEuMTIzLDMuODQzLDMuNDU5Yy0wLjI3OSwyLjExMy0zLjE1NywxLjExNS00LjIzLDEuMTU2Yy0xMS4wMDMsMC40MDctMjMuMjc0LDAtMzQuOTg2LDANCgkJYy0xMy40MjIsMC0yNy4yOCwwLjYzNS0zOS4yMTEtMC43NzFjLTAuNzc4LTIuMzA2LDIuMTQ3LTMuMTcsMy40NTctMy44NDRDMjUuNDM2LDE5LjMzNCwzOC41NzcsMTQuMzAxLDQ5LjQ3NCw4LjQyM3oiLz4NCgk8cGF0aCBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGNsaXAtcnVsZT0iZXZlbm9kZCIgZmlsbD0iIzJBMTQ0MiIgZD0iTTE5LjQ4OCwzMS4xMDdjMTkuMjU3LDAuMjY1LDQyLjc3NS0wLjUyLDYyLjY2NSwwLjM4NA0KCQljMCwxLjQxLDAsMi44MTksMCw0LjIyOWMtMjEuMzIzLDAuNjQ1LTQzLjIyNiwwLjU0NS02My44MTksMGMwLTEuMjgxLDAtMi41NjQsMC0zLjg0NkMxOC42MTUsMzEuNTE2LDE5LjAzMiwzMS4yOTEsMTkuNDg4LDMxLjEwN3oNCgkJIi8+DQoJPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGZpbGw9IiMyQTE0NDIiIGQ9Ik0yOC4zMywzNy42NDNjMC40NjMsMTIuNzM2LDAuNjExLDI1Ljc4NywxLjE1NCwzOC40NDYNCgkJYy0yLjk0OCwwLTUuODk3LDAtOC44NDQsMGMwLjA3Ny0xMi45OTYsMC40OTEtMjUuNjUzLDAuNzcyLTM4LjQ0NkMyMy43MTcsMzcuNjQzLDI2LjAyMywzNy42NDMsMjguMzMsMzcuNjQzeiIvPg0KCTxwYXRoIGZpbGwtcnVsZT0iZXZlbm9kZCIgY2xpcC1ydWxlPSJldmVub2RkIiBmaWxsPSIjMkExNDQyIiBkPSJNNDUuMjQ4LDM3LjY0M2MwLjI0MywxMi45NTQsMC41OSwyNS44MDcsMS4xNSwzOC40NDYNCgkJYy0yLjk0NywwLTUuODk0LDAtOC44NDIsMGMtMC4yMTItMTMuMjg2LDAuNTUtMjUuNTk1LDAuNzY3LTM4LjQ0NkM0MC42MzQsMzcuNjQzLDQyLjkzOSwzNy42NDMsNDUuMjQ4LDM3LjY0M3oiLz4NCgk8cGF0aCBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGNsaXAtcnVsZT0iZXZlbm9kZCIgZmlsbD0iIzJBMTQ0MiIgZD0iTTYyLjE1NywzNy42NDNjLTAuMDYzLDEzLjEzNiwxLjA1OSwyNS4wODcsMC43NzIsMzguNDQ2DQoJCWMtMi45NDYsMC01Ljg5NSwwLTguODQyLDBjMC42NDYtMTIuNTU2LDAuNTU2LTI1Ljg0NCwxLjE1MS0zOC40NDZDNTcuNTQ2LDM3LjY0Myw1OS44NTQsMzcuNjQzLDYyLjE1NywzNy42NDN6Ii8+DQoJPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGZpbGw9IiMyQTE0NDIiIGQ9Ik03OS4wNzYsMzcuNjQzYzAuMDI1LDEzLjA0NiwwLjg0MSwyNS4zMDMsMC43NzIsMzguNDQ2DQoJCWMtMi45NTEsMC01Ljg5NywwLTguODQ3LDBjMC45OC0xMi4zNTUtMC4yMTctMjYuODczLDEuNTQtMzguNDQ2Qzc0LjcxOCwzNy42NDMsNzYuODk3LDM3LjY0Myw3OS4wNzYsMzcuNjQzeiIvPg0KCTxwYXRoIGZpbGwtcnVsZT0iZXZlbm9kZCIgY2xpcC1ydWxlPSJldmVub2RkIiBmaWxsPSIjMkExNDQyIiBkPSJNOTQuNDU3LDg3LjYyMmMwLDEuNjY2LDAsMy4zMzEsMCw0Ljk5OA0KCQljLTI5LjQ3OSwwLTU4Ljk1MiwwLTg4LjQyNSwwYzAtMS42NjcsMC0zLjMzMiwwLTQuOTk4YzEuNDEzLDAuMTI1LDMuNDA0LTAuMzMsNC4yMjksMC4zODdjMC0xLjc5NCwwLTMuNTksMC01LjM4NQ0KCQljMi4wNDctMC4wMiwzLjI5MSwwLjE3NCw0LjIyNywwLjM4NGMwLjAxNS0xLjkwNi0wLjEwMS00LjY4LDAuMzg3LTQuOTk3YzIxLjI0Ni0wLjE0OCw0Ni4zMjgsMC4wNDYsNzEuMTIxLDANCgkJYzAsMS41MzcsMCwzLjA3MywwLDQuNjEzYzEuMjk2LDAuMjQyLDMuNTc2LTAuNDk2LDQuMjMzLDAuMzg0YzAuMjQ1LDEuNTUtMC41LDQuMDg2LDAuMzgxLDUuMDAxDQoJCUM5MS4xNDMsODcuMTI5LDkzLjI4OCw4Ny44NjIsOTQuNDU3LDg3LjYyMnoiLz4NCjwvZz4NCjwvc3ZnPg0K)"></div>
                            </div>
                            <h3>Intellectueel</h3>
                        </a>
                        <a href="#pijlers" class="icon-text-container">
                            <div class="badge">
                                <div class="cover-image" style="background-image:url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNS4wLjIsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMTAwcHgiIGhlaWdodD0iMTAwcHgiIHZpZXdCb3g9IjAgMCAxMDAgMTAwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAxMDAgMTAwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxwYXRoIGZpbGwtcnVsZT0iZXZlbm9kZCIgY2xpcC1ydWxlPSJldmVub2RkIiBmaWxsPSIjMkExNDQyIiBkPSJNNzAuODQ1LDYuODUzQzcwLjIwOSw0LjI2OCw1OC43LDEuODc5LDUwLjI0NCwxLjk4NA0KCWMtOC40NTctMC4xMDQtMTkuOTY1LDIuMjg0LTIwLjYsNC44NjljLTAuNzk3LDMuMjQ5LDEyLjIzLDUuOTM3LDE2LjE4Niw3LjM1N2MtMi4wNTEsMy41OTEtMy40MjUsNy44NTYtNS44ODYsMTEuMDM1DQoJYy0yLjY0My0wLjcxOS02LjAyLTIuOTQ0LTkuMzgtNC41MzdjMS45MDEsMi42MzYsNS41MjYsNy4xMDMsOS45OTQsOC43NjdjMC43MDItMC41MTksMi4xNDktNC4wMywzLjgtNS43MDINCgljMC4xNjgsMC44MTcsMi45ODEsNC42ODUsMy42NzksNS4xNWMtMi4yOTYsMTkuMDM5LTUuMTU1LDM3LjUxNC02LjYyMiw1Ny4zODJjMS41NTQsMS44NzcsNy4xMDQsOS4yMzMsOC44MjksMTEuMzAxDQoJYzEuNzI2LTIuMDY3LDcuMjc0LTkuNDI0LDguODI5LTExLjMwMWMtMS40NjctMTkuODY4LTQuMzI2LTM4LjM0NC02LjYyMi01Ny4zODJjMC42OTgtMC40NjYsMy41MTEtNC4zMzMsMy42NzktNS4xNQ0KCWMxLjY1MiwxLjY3MiwzLjA5OSw1LjE4MywzLjgwMSw1LjcwMmM0LjQ2OC0xLjY2NCw4LjA5My02LjEzMSw5Ljk5My04Ljc2N2MtMy4zNTksMS41OTItNi43MzcsMy44MTctOS4zOCw0LjUzNw0KCWMtMi40NjItMy4xNzktMy44MzctNy40NDQtNS44ODUtMTEuMDM1QzU4LjYxMiwxMi43OSw3MS42NDEsMTAuMTAyLDcwLjg0NSw2Ljg1M3oiLz4NCjwvc3ZnPg0K)"></div>
                            </div>
                            <h3>Studentikoos</h3>
                        </a>
                    </div>
                </div>

                <div id="pillar-tab-content">
                    <div class="slide-slot-wrapper loading">Bezig met laden...</div>
                    <template class="slide-templates">
                        <div class="subsection cover-image fixed-bg full-height" style="background: url($BACKGROUND)">
                            <div class="article bottom">
                                <div class="col">
                                    <div class="text-frame primary">
                                        <h1>$HEADER</h1>
                                        <p class="no-margin">
                                            $TEXT
                                        </p>
                                    </div>
                                </div>
                                <div class="col hide-small-desktop"></div>
                            </div>
                        </div>

                        <div class="subsection cover-image fixed-bg full-height" style="background: url($BACKGROUND);">
                            <div class="article bottom">
                                <div class="col hide-small-desktop"></div>
                                <div class="col">
                                    <div class="text-frame primary">
                                        <h1>$HEADER</h1>
                                        <p class="no-margin">
                                            $TEXT
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                </div>
            </div>

            <!-- END PILLARS -->
            
        </section>

        <!-- END GSV -->

        <section class="partial spacer"></section>

        <!-- ACTIVITIES -->

        <section id="activiteiten" class="cover-image partial">
                <img src="/images/activiteiten_keiweek.jpg">
            <div id="locatie">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2009.2893912255488!2d6.5705663454679275!3d53.20957784830908!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c832aab5482cd7%3A0x9077fc1decf6b97a!2sHereweg+40%2C+9725+AE+Groningen!5e0!3m2!1snl!2snl!4v1491310031837" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen=""></iframe>
            </div>
        </section><!--53.209344, 6.572365-->

        <!-- END ACTIVITIES -->

        <!-- PHOTOS -->
        
        <section id="fotos" class="partial">
            <div class="article">
                <div class="header">
                    <h1>Foto's</h1>
                    <p class="no-margin">
                        Blijf op de hoogte van wat we doen, volg <a href="https://www.instagram.com/_u/gsvgroningen/" target="_blank">gsvgroningen</a> op instagram!
                    </p>
                </div>
            </div>
            <div id="instafeed"></div>
        </section>

        <!-- END PHOTOS -->

        <!-- FOOTER -->

        <section class="footer partial primary flex col">
            <!--p>Caput sapientiae est reverentia Domini</p-->
            <p>
                <a href="#intro">Gereformeerde Studenten Vereniging</a>. Hereweg 40, Groningen. <a href="{{ action('AboutController@showContact') }}">Contactgegevens</a>
            </p>
        </section>

        <!-- END FOOTER -->
    
    </div>

    <script src="/build-javascripts/homepage.js?v=1.5.6"></script>
    <script>
        navMenu = NavMenu('#nav-menu', '.links > a', '.mobile-nav-links');
        initHashNavigation(navMenu.getHeight);
        let coverVideo = new CoverVideo('#intro-video', 'x5tctzn', '#intro-cover', .15, '#video-controls'); //x3egf0x
        //let overlay = initOverlay('#register,#overlay-close');
        let groupPicture = new ImageZoom({imageFrame: '#gsv-group-photo', animArea: {top: 28, bottom: 66, left: 8, right: 92}, zoom: 3});
        addScrollResponse('#pijlers', {offset: navMenu.getHeight, responseEl: '#pillar-tab-controls-container'});
        fullHeightMobile('#intro,#intro-video');
        fullHeightMobile('#pijlers', navMenu.getHeight, true);
        let instaFeed = new InstagramFeed();
        initGoogleMap('#locatie');
        let tabs;
        $(document).ready(function() {
            tabs = new Tabs([
                {
                    template: 1,
                    content: {
                        $HEADER: 'Christelijk',
                        $TEXT: 'Binnen de GSV speelt het christelijke geloof een centrale rol. Elke dinsdag is er Bijbelkring, waar je in een kleine groep verdieping zoekt in het geloof. Daarnaast hebben we het jaarlijks bezinningsweekend en verschillende sing-ins.',
                        $BACKGROUND: '/images/pijlers_christelijk_resized.jpg'
                    }
                },
                {
                    template: 2,
                    content: {
                        $HEADER: 'Sociaal',
                        $TEXT: 'Een studentenvereniging is er natuurlijk voor de gezelligheid. Alleen al op onze Sociëteit kan je elkaar elke donderdagavond ontmoeten om een biertje te drinken. Daarnaast zijn er verschillende toffe weekendjes weg.',
                        $BACKGROUND: '/images/pijlers_sociaal_resized.jpg'
                    }
                },
                {
                    template: 2,
                    content: {
                        $HEADER: 'Intellectueel',
                        $TEXT: 'Het is leuk om elkaar uit te dagen kritisch na te denken over wetenschap en geloof. Goede discussies, diepgaande gesprekken en interessante lezingen zijn verrijkend.',
                        $BACKGROUND: '/images/pijlers_intellectueel_resized.jpg'
                    }
                },
                {
                    template: 1,
                    content: {
                        $HEADER: 'Studentikoos',
                        $TEXT: 'Wat is een studentenvereniging nou zonder een goede dosis studentikoziteit? Daarom heeft de GSV haar eigen mores en lange tradities die zij met verve in ere houdt.',
                        $BACKGROUND: '/images/pijlers_studentikoos_resized.jpg'
                    }
                }
            ], {controlsContainer: '#pillar-tab-controls', contentContainer: '#pillar-tab-content'});
        });
    </script>
</body>

</html>