<?php

$servername = "localhost";
$username = "season";
$password = "malla123";
$dbname = "ost";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    echo "Connection failed!";
}
