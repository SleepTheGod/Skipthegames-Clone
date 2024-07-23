<?php
include 'db.php';

$adId = $_GET['id'] ?? '';

$sql = "SELECT * FROM posts WHERE id = $adId";
$result = $conn->query($sql);

$ad = $result->fetch_assoc();

echo json_encode($ad);

$conn->close();
?>
