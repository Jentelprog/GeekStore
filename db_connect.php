<?php
$host = "localhost"; // Change if necessary
$user = "root"; // Default MySQL user
$pass = "Ilyes/148639527"; // Default password (leave empty if not set)
$dbname = "geekstore";

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
