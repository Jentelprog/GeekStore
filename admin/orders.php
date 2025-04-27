<?php
// Connect to the database
include "../db_connect.php";


$sql = "select o.order_id,o.address,o.payment_method,o.total_price,u.first_name,u.last_name,u.email from orders o,users u where u.id=o.user_id ;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>GeekStore Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h1>Admin Panel - GeekStore</h1>
    <a href="../users/login/login.php" class="exit">Leave</a>
    <section>
        <!-- Customer List Section -->
        <section>
            <h2 class="nav_link"><a href="index.php">Products</a></h2>
            <h2 class="nav_link"><a href="users.php">users</a></h2>
            <h2 class="nav_link"><a href="orders.php">orders</a></h2>
            <h2 class="nav_link"><a href="messages.php">messages</a></h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>order id</th>
                            <th>address</th>
                            <th>payment method</th>
                            <th>first name</th>
                            <th>last_name</th>
                            <th>email</th>
                            <th>total price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?php echo $order['order_id']; ?></td>
                                <td><?php echo $order['address']; ?></td>
                                <td><?php echo $order['payment_method']; ?></td>
                                <td><?php echo $order['first_name']; ?></td>
                                <td><?php echo $order['last_name']; ?></td>
                                <td><?php echo $order['email']; ?></td>
                                <td><?php echo $order['total_price']; ?> dt</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

</body>

</html>