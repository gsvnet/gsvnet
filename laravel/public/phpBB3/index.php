<?php
if(empty($_GET) || (isset($_GET['search_id']) && $_GET['search_id'] == 'active_topics')) {
	header("HTTP/1.1 301 Moved Permanently"); 
	header("Location: /forum"); 
	exit();
} else {
	header("HTTP/1.0 404 Not Found");
}