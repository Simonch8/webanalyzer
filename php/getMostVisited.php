<?php
require_once("conn.php");

$conn = new Connector("db.config");

$result = $conn->getMostVisited();

echo json_encode( $result );
?>
