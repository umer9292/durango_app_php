<?php
// Start the session
session_start();

    $serverName = 'localhost';
    $userName = 'root';
    $password = '';
    $databaseName = 'durango';

$con = mysqli_connect($serverName, $userName, $password, $databaseName);

if(!$con) {
        die(mysqli_connect_error());
}
?>