<?php
include "../../db_connect.php";

// Get the ID from URL parameter
$id = $_GET['id'];

// Prepare the SQL statement
$sql = "DELETE FROM cards WHERE product_id=?";
$stmt = $conn->prepare($sql);


// Bind the parameter and execute
$stmt->bind_param('s', $id);
$stmt->execute();

$stmt->close();
header("Location: main.php");
exit();
