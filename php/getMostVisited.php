<?php
/**
* @author Raphael Hänni
* @version 1.5
* @date 2.12.2017
* @purpose gets data from database and sends them back to JavaScript via Ajax
**/
require_once("conn.php");

$conn = new Connector("db.config");

$result = $conn->getMostVisited();

echo json_encode( $result );
?>
