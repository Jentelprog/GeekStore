<?php
session_start();
include "../../db_connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "insert into users (first_name, last_name, gender, email, password) values(?,?,?,?,?);";
    $stml = $conn->prepare($sql);
    $stml->bind_param("ssiss", $first_name, $last_name, $gender, $email, $hashed_password);

    if ($stml->execute()) {
        echo "signup successful! you can now <a href='../login/index.html'>login</a>";
    } else {
        echo "error {$stml->error}";
    }

    $stml->close();
    $conn->close();
} else {
    echo "invalid request.";
}
