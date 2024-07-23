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

// Build SQL query with filters
$sql = "SELECT * FROM ads WHERE 1=1";
$params = [];
$types = '';

if (!empty($_GET['gender'])) {
    $sql .= " AND gender = ?";
    $params[] = $_GET['gender'];
    $types .= 's';
}

if (!empty($_GET['city'])) {
    $sql .= " AND city = ?";
    $params[] = $_GET['city'];
    $types .= 's';
}

if (!empty($_GET['county'])) {
    $sql .= " AND county = ?";
    $params[] = $_GET['county'];
    $types .= 's';
}

if (!empty($_GET['state'])) {
    $sql .= " AND state = ?";
    $params[] = $_GET['state'];
    $types .= 's';
}

$stmt = $conn->prepare($sql);
if ($types) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

$ads = [];
while ($row = $result->fetch_assoc()) {
    $ads[] = $row;
}

echo json_encode($ads);

$stmt->close();
$conn->close();
?>
