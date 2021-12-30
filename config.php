<?php

$dbhost = "localhost:3306";
$dbuser = "root";
$dbpass = "";
$dbname = "idea_notes";
global $setting;
$setting['salt'] = 'J8GKMCF9REDFJGDF6URCHR67UFXGH5Y4J';

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
mysqli_query($conn, "SET NAMES utf8");

?>