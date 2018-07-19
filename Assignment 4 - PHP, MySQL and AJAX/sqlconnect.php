<?php

$servername = 'localhost';
$sqlusername = 'id6400707_rhari1999';
$sqlpassword = 'Alwaysbecool1';

$database = 'id6400707_library';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $sqlusername, $sqlpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    die("Connection failed");
    }

?>