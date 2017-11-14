<?php
	require_once "conn.php";

	function createUrlList() {
		$db =  new Connector;
		$calls = $db->selectAllCalls();
		foreach($calls as $item) {
			if ($item['isBlacklist'] == 1) {
		  		echo '<p><input class="form-control" type="checkbox" id="'.$item['url'].'" name="'.$item['url'].'" value="'.$item['url'].'" checked /><label for="'.$item['url'].'"><span></span>'.$item['url'].'</label></p>';
			}
			else {
		  		echo '<p><input class="form-control" type="checkbox" id="'.$item['url'].'" name="'.$item['url'].'" value="'.$item['url'].'" /><label for="'.$item['url'].'"><span></span>'.$item['url'].'</label></p>';
			}
		}
	}
?>	