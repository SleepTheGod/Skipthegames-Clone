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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $city = $_POST['city'];
    $county = $_POST['county'];
    $state = $_POST['state'];
    $description = $_POST['description'];

    // Handle file uploads
    $picture_urls = '';
    if (isset($_FILES['pictures'])) {
        foreach ($_FILES['pictures']['tmp_name'] as $key => $tmp_name) {
            $file_name = $_FILES['pictures']['name'][$key];
            $file_tmp = $_FILES['pictures']['tmp_name'][$key];
            $file_path = 'uploads/pictures/' . basename($file_name);
            if (move_uploaded_file($file_tmp, $file_path)) {
                $picture_urls .= $file_path . ',';
            }
        }
    }

    $video_urls = '';
    if (isset($_FILES['videos'])) {
        foreach ($_FILES['videos']['tmp_name'] as $key => $tmp_name) {
            $file_name = $_FILES['videos']['name'][$key];
            $file_tmp = $_FILES['videos']['tmp_name'][$key];
            $file_path = 'uploads/videos/' . basename($file_name);
            if (move_uploaded_file($file_tmp, $file_path)) {
                $video_urls .= $file_path . ',';
            }
        }
    }

    // Insert ad into the database
    $sql = "INSERT INTO ads (name, gender, city, county, state, description, picture_urls, video_urls) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $name, $gender, $city, $county, $state, $description, rtrim($picture_urls, ','), rtrim($video_urls, ','));
    
    if ($stmt->execute()) {
        echo "Ad posted successfully!";
    } else {
        echo "Error posting ad: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
