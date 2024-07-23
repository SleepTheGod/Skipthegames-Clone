<?php
include 'db.php';

$city = $_GET['city'] ?? '';
$county = $_GET['county'] ?? '';
$state = $_GET['state'] ?? '';
$gender = $_GET['gender'] ?? '';

// Prepare SQL query
$sql = "SELECT * FROM posts WHERE city LIKE '%$city%' AND county LIKE '%$county%' AND state LIKE '%$state%' AND gender LIKE '%$gender%'";
$result = $conn->query($sql);

$ads = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $ads[] = $row;
    }
}

echo json_encode($ads);

$conn->close();
?>
