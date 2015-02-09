<?php
if(empty($_GET)) {
	header("HTTP/1.1 301 Moved Permanently"); 
	header("Location: /");
	exit();
}

if(isset($_GET['id']) && isset($_GET['Itemid']) && isset($_GET['option']) && $_GET['option'] == 'com_content') {
	$id = $_GET['id'];
	$Itemid = $_GET['Itemid'];

	if($id == 79 && $Itemid == 336) {
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: /");
		exit();
	}
	if($id == 2 && $Itemid==148 || $id == 79 && $Itemid == 147){
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: /de-gsv");
		exit();
	}

	if($id == 5 && $Itemid==170){
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: /de-gsv/geschiedenis");
		exit();
	}

	if($id == 88 && $Itemid==171){
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: /de-gsv/senaten");
		exit();
	}

	if($id == 19 && $Itemid==187){
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: /de-gsv/contact");
		exit();
	}

	if($id == 17 && $Itemid==184){
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: /de-gsv/contact");
		exit();
	}

	if($id == 3 && $Itemid==168){
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: /de-gsv/contact");
		exit();
	}

	if($id == 83 && $Itemid==190){
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: /de-gsv/commissies");
		exit();
	}

	if($id == 79 && $Itemid == 147) {
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: /de-gsv");
		exit();
	}

	if($id == 74 && $Itemid==328) {
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: /de-gsv/senaten/3");
		exit();
	}
}

if(isset($_GET['option'])){
	if($_GET['option'] == 'com_foxcontact' && isset($_GET['Itemid']) && $_GET['Itemid'] == 335) {
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: /word-lid/inschrijven");
		exit();
	}

	if($_GET['option'] == 'com_phocagallery') {
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: /albums");
		exit();
	}

	if($_GET['option'] == 'com_users' && isset($_GET['view'])) {
		if($_GET['view'] == 'registration') {
			header("HTTP/1.1 301 Moved Permanently"); 
			header("Location: /registreer");
			exit();
		}
		if($_GET['view'] == 'login') {
			header("HTTP/1.1 301 Moved Permanently"); 
			header("Location: /inloggen");
			exit();
		}
	}

	if($_GET['option'] == 'com_jevents') {
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: /activiteiten");
		exit();
	}
}

header("HTTP/1.0 410 Gone");

echo '<h1>Pagina bestaat niet meer / is niet gevonden</h1>';
echo '<p>De GSV-site is vernieuwd, waarschijnlijk komt het daardoor. <a href="/">Ga terug naar de homepage</a></p>';