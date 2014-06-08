<?php
if(empty($_GET) || (isset($_GET['search_id']) && $_GET['search_id'] == 'active_topics')) {
	header("HTTP/1.1 301 Moved Permanently"); 
	header("Location: /forum"); 
	exit();
} else {
	header("HTTP/1.0 410 Gone");
	echo '<h1>Pagina bestaat niet meer / is niet gevonden</h1>';
	echo '<p>De GSV-site is vernieuwd, waarschijnlijk komt het daardoor. <a href="/">Ga terug naar de homepage</a></p>';
}