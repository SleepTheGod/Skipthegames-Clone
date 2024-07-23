<?php
session_start();
include 'db.php';

if (!isset($_COOKIE['session_token'])) {
    die("Unauthorized");
}

$session_token = $_COOKIE['session_token'];
$sql = "SELECT user_id FROM sessions WHERE session_token = '$session_token'";
$result = $conn->query($sql);
$session = $result->fetch_assoc();

if (!$session) {
    die("Unauthorized");
}

$user_id = $session['user_id'];
$email = $_POST['email'];
$gender = $_POST['gender'];

// Update user information
$sql = "UPDATE users SET email = '$email', gender = '$gender' WHERE id = $user_id";

if ($conn->query($sql) === TRUE) {
    echo "Profile updated successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
