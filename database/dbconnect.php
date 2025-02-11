<?php 
    $host = "localhost";
    $dbname = "umerch";
    $username = "root";
    $password = "";

    $connection = new mysqli($host, $username, $password, $dbname);

    if ($connection->connect_error) {
        echo "Failed to connect" . $connection->connect_error;
    }
?>