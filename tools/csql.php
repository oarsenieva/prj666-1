<?php
//DB details
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = 'Wecreu123';
$dbName = 'wecreu';

//Create connection and select DB
$dbc = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($dbc->connect_error) {
    die("Unable to connect database: " . $dbc->connect_error);
}