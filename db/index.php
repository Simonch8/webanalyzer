<?php
    require_once "conn.php";

    $conn =  new Connector;

    $conn->saveUrl()


    $data = $conn->urlExists( "google.ch" );

    echo "<pre>";
    print_r($data);
    echo "</pre>";
 ?>
