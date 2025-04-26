<?php
include "../../db_connect.php";
session_start();
$product_id = isset($_GET['id']) ? trim($_GET['id']) : "";
// Make sure the user is logged in and the product ID is provided
if (isset($_SESSION["user_id"], $product_id) && is_numeric($product_id)) {
    $userId = $_SESSION["user_id"];
    $productId = (int)$product_id;
    $quantity = $_GET['quantity'];
    $sql = "INSERT INTO cart (user_id, product_id,quantity,paied) VALUES (?, ?,?,false)";/* ON DUPLICATE KEY UPDATE quantity = quantity + 1";*/
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("iii", $userId, $productId, $quantity);
        $stmt->execute();
        $stmt->close();
    }
    header("Location: ../Products/index.php");
    exit();
} else {
    echo $product_id;
}
