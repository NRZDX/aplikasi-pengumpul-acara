<?php
$servername = "db";
$username = "user";
$password = "password";
$dbname = "acara_db";

// Buat koneksi
$conn = new mysqli($servername, $username, $password);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Buat database jika belum ada
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    // echo "Database berhasil dibuat atau sudah ada";
} else {
    echo "Error creating database: " . $conn->error;
}

// Pilih database
$conn->select_db($dbname);

// SQL untuk membuat tabel users
$sql_users = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

if ($conn->query($sql_users) === TRUE) {
    // echo "Tabel users berhasil dibuat atau sudah ada.";
} else {
    echo "Error creating table: " . $conn->error;
}

// SQL untuk membuat tabel events
$sql_events = "CREATE TABLE IF NOT EXISTS events (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    date DATE NOT NULL,
    location VARCHAR(255) NOT NULL,
    image VARCHAR(255) DEFAULT 'placeholder.jpg'
    )";

if ($conn->query($sql_events) === TRUE) {
    // echo "Tabel events berhasil dibuat atau sudah ada.";
} else {
    echo "Error creating table: " . $conn->error;
}

?>