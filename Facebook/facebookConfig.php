<?php
if(!session_id())
session_start();

$callbackUrl = "http://localhost/Projects/TP-Final-MoviePass/Facebook/loginFacebook";
$fbObject = new Facebook\Facebook([
	'app_id' => FAPP_ID, 
	'app_secret' => FAPP_SECRET,
	'default_graph_version' => 'v3.2',
	]);
$handler = $fbObject->getRedirectLoginHelper();
?>