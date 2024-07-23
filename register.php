<?php
include 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$gender = $_POST['gender'];

// Hash the password
$password_hash = password_hash($password, PASSWORD_BCRYPT);

// Insert user into database
$sql = "INSERT INTO users (username, password_hash, email, gender) 
        VALUES ('$username', '$password_hash', '$email', '$gender')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
