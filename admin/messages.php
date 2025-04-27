<?php
// Connect to the database
include "../db_connect.php";


$sql = "select m.id ,u.first_name, u.last_name, u.email,m.message from messages m,users u where u.id=m.user_id ;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$messages = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

if (isset($_GET["delete"])) {
    $stmt = $conn->prepare("DELETE FROM messages WHERE id = ?");
    $stmt->bind_param("i", $_GET["delete"]);
    $stmt->execute();
    $stmt->close();
    header("Location: messages.php");
    exit;
}
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
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Action</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($messages as $message): ?>
                            <tr>
                                <td><?php echo $message['first_name']; ?></td>
                                <td><?php echo $message['last_name']; ?></td>
                                <td><?php echo $message['email']; ?></td>
                                <td>
                                    <a href="?delete=<?= $message['id'] ?>" class="action-button" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a> |
                                </td>
                                <td><?php echo $message['message']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

</body>

</html>