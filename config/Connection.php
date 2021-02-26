<?php

$dbhost = "localhost";
$dbuser = "wardiman";
$dbpass = "wardiman";
$dbname = "db_crud_php";

try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}