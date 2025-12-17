<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "coach_pro";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed");
}