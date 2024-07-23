<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "personal_ads";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle registration
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];

    $sql = "INSERT INTO users (username, password, email, gender) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $password, $email, $gender);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error registering user: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
