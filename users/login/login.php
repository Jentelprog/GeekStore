<?php
$error = "";
session_start();
include "../../db_connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    if ($email == "admin@gmail.com" && $password == "admin") {
        header("Location: ../../admin/index.php");
        exit();
    }
    //sql 
    $sql = "select * from users where email= ?";
    $stml = $conn->prepare($sql);
    $stml->bind_param("s", $email);
    $stml->execute();
    $result = $stml->get_result();
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["email"] = $user['email'];
            header("Location: ../HomePage/index.php");
            exit();
        } else {
            $error = "Incorrect password or email. Please try again.";
            // echo "<script>alert('This is an alert from PHP!');</script>";
        }
    } else {
        $error = "Incorrect password or email. Please try again.";
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <title>GeekStore Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="login-container">
        <form class="login-form" action="login.php" method="post">
            <fieldset>
                <legend>Login</legend>
                <input type="email" placeholder="Email" name="email" required autofocus>
                <input type="password" placeholder="Password" name="password" required>
                <?php if (!empty($error)) : ?>
                    <p style="color:red;"><?php echo $error; ?></p>
                <?php endif; ?>


                <input type="submit" value="Login">
                <a href="../signup/sign_up.html" class="sign up">Sign up</a>
            </fieldset>
        </form>
    </div>
</body>

</html>