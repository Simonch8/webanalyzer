<?php
// Set Session ID with ip of user and start the session
session_id(str_replace(array('.', ':'), array('-', '-'), $_SERVER["REMOTE_ADDR"]));
session_start();

// Includes functions
require_once "conn.php";

// Store POST Variable in simple local variable and initialize new variable "oldUrl"
$url = $_POST['url'];
$oldUrl = "";

// If session already contains old url set oldUrl to the old url in the session
if (isset($_SESSION['oldUrl']))
{
	$oldUrl = $_SESSION['oldUrl'];
}

// If new url is not the same as old url, the call is valid (Prevent spam trough page reload on the client side)
if ($url != $oldUrl)
{
	$connector = new Connector;
	$connector->saveCall($url)
	// Set new url as old url for the next call
	$_SESSION['oldUrl'] = $url;
}
?>