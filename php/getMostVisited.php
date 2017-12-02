<?php
require_once("conn.php");

$conn = new Connector;

$result = $conn->getMostVisited();

echo json_encode( $result );
?>
