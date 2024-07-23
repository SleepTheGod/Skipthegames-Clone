<?php
session_start();
include 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Fetch user from database
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password_hash'])) {
    $session_token = bin2hex(random_bytes(32));
    $sql = "INSERT INTO sessions (user_id, session_token) VALUES (" . $user['id'] . ", '$session_token')";
    $conn->query($sql);

    setcookie("session_token", $session_token, time() + (86400 * 30), "/"); // 1 month
    header('Location: index.html');
} else {
    echo "Invalid username or password";
}

$conn->close();
?>
