<?php

$database = 'krisp';
$host = 'localhost';
$user = 'root';
$password = 'theReal@dmin85!';
$charset = 'utf8mb4';
// create a new db object

//set up dsn for mysql
$dsn = "mysql:host=$host;dbname=$database;charset=$charset";
//set up options for the connection
try {
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}