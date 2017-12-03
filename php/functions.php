<?php
	require_once("conn.php");

	function createUrlList() {
		$db =  new Connector("php/db.config");
		$calls = $db->selectAllURL();
		foreach($calls as $item) {
			if ($item['isBlacklist'] == 1) {
		  		echo '<p><input type="hidden" value="unselected" name="'.$item['url'].'"><input class="form-control" type="checkbox" id="'.$item['url'].'" name="'.$item['url'].'" value="selected" checked /><label for="'.$item['url'].'"><span></span>'.$item['url'].'</label></p>';
			}
			else {
		  		echo '<p><input type="hidden" value="unselected" name="'.$item['url'].'"><input class="form-control" type="checkbox" id="'.$item['url'].'" name="'.$item['url'].'" value="selected" /><label for="'.$item['url'].'"><span></span>'.$item['url'].'</label></p>';
			}
		}
	}
?>
