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

$name = $_POST['name'];
$gender = $_POST['gender'];
$city = $_POST['city'];
$county = $_POST['county'];
$state = $_POST['state'];
$description = $_POST['description'];

// Handle file uploads
$picture_urls = '';
if (!empty($_FILES['pictures']['name'][0])) {
    foreach ($_FILES['pictures']['tmp_name'] as $key => $tmp_name) {
        $file_name = basename($_FILES['pictures']['name'][$key]);
        $file_path = 'uploads/' . $file_name;
        move_uploaded_file($tmp_name, $file_path);
        $picture_urls .= $file_path . ',';
    }
    $picture_urls = rtrim($picture_urls, ',');
}

$video_urls = '';
if (!empty($_FILES['videos']['name'][0])) {
    foreach ($_FILES['videos']['tmp_name'] as $key => $tmp_name) {
        $file_name = basename($_FILES['videos']['name'][$key]);
        $file_path = 'uploads/' . $file_name;
        move_uploaded_file($tmp_name, $file_path);
        $video_urls .= $file_path . ',';
    }
    $video_urls = rtrim($video_urls, ',');
}

// Insert ad into database
$sql = "INSERT INTO posts (user_id, name, gender, city, county, state, description, picture_urls, video_urls) 
        VALUES ('$user_id', '$name', '$gender', '$city', '$county', '$state', '$description', '$picture_urls', '$video_urls')";

if ($conn->query($sql) === TRUE) {
    echo "Ad posted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
