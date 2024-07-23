# Skipthegames Clone
# Personal Ads Site

# Overview
This project is a personal ads website allowing users to post ads with pictures and videos, view posted ads, and manage user accounts. The website includes a homepage, an ad posting form, a view ads page with filtering capabilities, and user login and registration functionality. The backend is powered by PHP and connects to a MySQL database.

# Features
Post an Ad: Users can submit ads with name, gender, location, description, and upload pictures and videos.
View Ads: Users can filter ads based on gender, city, county, and state.
User Authentication: Users can register and log in to manage their ads.

# Technologies Used
Frontend: HTML, CSS, JavaScript
Backend: PHP
Database: MySQL

# Project Structure
/personal-ads-site
|-- /css
|   |-- styles.css
|-- /js
|   |-- scripts.js
|-- /uploads
|   |-- /pictures
|   |-- /videos
|-- fetch_post.html
|-- index.html
|-- login.html
|-- post_ad.html
|-- register.html
|-- submit_ad.php
|-- fetch_ads.php
|-- login.php
|-- register.php
|-- .gitignore
|-- README.md

# Setup Instructions
Clone the Repository
git clone https://github.com/SleepTheGod/Skipthegames-Clone/
cd Skipthegames-Clone

# Set Up the Database
Create a MySQL database named personal_ads.
Import the following SQL schema to create the necessary tables

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    gender ENUM('male', 'female', 'other') NOT NULL
);

CREATE TABLE ads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    gender ENUM('male', 'female', 'other') NOT NULL,
    city VARCHAR(100) NOT NULL,
    county VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    picture_urls TEXT,
    video_urls TEXT
);

# Configure PHP Files
Update the database connection settings in the PHP files (submit_ad.php, fetch_ads.php, login.php, register.php) with your database credentials.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "personal_ads";

# Set Up File Uploads
Ensure that the uploads/pictures and uploads/videos directories are writable by the web server. You may need to set appropriate permissions

mkdir -p uploads/pictures uploads/videos
chmod 755 uploads/pictures uploads/videos

# Run the Application
Upload the project files to your web server or local development environment.
Ensure that the PHP files are accessible via a web server (e.g., Apache or Nginx).
Navigate to index.html in your web browser to start using the site.

# File Descriptions

# HTML Files
index.html: Homepage of the site.
post_ad.html: Form for posting a new ad.
fetch_post.html: Page for viewing and filtering ads.
login.html: Login form for user authentication.
register.html: Registration form for new users.
CSS (css/styles.css): Styles for the website including layout and design.

# JavaScript (js/scripts.js) 
Placeholder for any additional JavaScript functionality.

# PHP Files
submit_ad.php: Handles ad submission and file uploads.
fetch_ads.php: Fetches ads from the database based on filters.
login.php: Handles user login.
register.php: Handles user registration.
