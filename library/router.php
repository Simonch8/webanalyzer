<?php
/** Check if environment is development and display errors **/
function SetReporting() {
	if (DEVELOPMENT_ENVIRONMENT == true) {
		error_reporting(E_ALL);
		ini_set('display_errors','On');
	}
	else {
		error_reporting(E_ALL);
		ini_set('display_errors','Off');
		ini_set('log_errors', 'On');
		ini_set( 'error_log', ROOT . DS . 'tmp' . DS . 'logs' . DS . 'error.log' );
	}
}

/** Check for Magic Quotes and remove them **/
function stripSlashesDeep($value) {
	$value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
	return $value;
}

function RemoveMagicQuotes() {
	if ( get_magic_quotes_gpc() ) {
		$_GET = stripSlashesDeep($_GET );
		$_POST = stripSlashesDeep($_POST );
		$_COOKIE = stripSlashesDeep($_COOKIE);
	}
}

/** Check register globals and remove them **/
function UnregisterGlobals() {
	if (ini_get('register_globals')) {
		$array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
		foreach ($array as $value) {
			foreach ($GLOBALS[$value] as $key -> $var) {
				if ($var === $GLOBALS[$key]) {
					unset($GLOBALS[$key]);
				}
			}
		}
	}
}

//Automatically includes files containing classes that are called
function __autoload($className) {
	//fetch file
	if(file_exists( ROOT . DS . 'controllers' . DS . strtolower($className) . '.php') ) {
		require_once( ROOT . DS . 'controllers' . DS . strtolower($className) . '.php');
	}
	else if (file_exists( ROOT . DS . 'models' . DS . strtolower($className) . '.php') ) {
		require_once( ROOT . DS . 'models' . DS . strtolower($className) . '.php'); 
	}
	else if (file_exists( ROOT . DS . 'library' . DS . strtolower($className) . '.php') ) {
		require_once( ROOT . DS . 'library' . DS . strtolower($className) . '.php');
	}
	else {
		// Error: Controller Class not found
		die("Error: Class not found.");
	}
}

/** Main Call Function **/
function CallHook() {
	global $url;
	if (!isset($url)) {
		$controllerName = DEFAULT_CONTROLLER; $action = DEFAULT_ACTION;
	}
	else {
		$urlArray = array();
		$urlArray = explode("/",$url);
		$controllerName = $urlArray[0];
		$action = (isset($urlArray[1]) && $urlArray[1] != "") ? $urlArray[1] : DEFAULT_ACTION;
	}

	$query1 = (isset($urlArray[2]) && $urlArray[2] != "") ? $urlArray[2] : null;
	$query2 =(isset($urlArray[3]) && $urlArray[3] != "") ? $urlArray[3] : null;

	//modify controller name to fit naming
	$class = ucfirst($controllerName).'_Controller';

	//instantiate the appropriate class
	if(class_exists($class) && (int)method_exists($class, $action)) {
		$controller = new $class;
		$controller->$action($query1, $query2);
		//call_user_func_array(array($controller,$action),$query1);
	}
	else {
		//Error: Controller Class not found
		die("1. File <strong>'$controllerName.php'</strong> containing class <strong>'$class'</strong> might be missing. 2. Method <strong>'$action'</strong> is missing in <strong>'$controllerName.php'</strong>");
	}
}

SetReporting();
RemoveMagicQuotes();
UnregisterGlobals();
CallHook();