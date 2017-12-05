<?php
/**
* @author Jannis Viol
* @version 1.0
* @date 5.12.2017
* @purpose add and delete sites from the blacklist
**/
	require_once "conn.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$db =  new Connector("php/db.config");
		$url = $db->selectAllURL();
		$i = 0;

		foreach($_POST as $value) {
			if ($value == "unselected"){
				$db->alterBlacklist($url[$i]["url"], 0);
			}
			else if ($value == "selected"){
				$db->alterBlacklist($url[$i]["url"], 1);
			}
			else if ($value != NULL && $value != ""){
				if ($db->urlExists($value)) {
					$db->alterBlacklist($value, 1);
				}
				else {
					$db->saveUrl($value, 1);
				}
			}
			$i++;
		}
	}
?>
