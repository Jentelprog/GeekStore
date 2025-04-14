<?php
include "../../db_connect.php";
$query = "select * from products where category='hoodie';";
$result = mysqli_query($conn, $query);
$products = array();
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}
echo json_encode($products);
