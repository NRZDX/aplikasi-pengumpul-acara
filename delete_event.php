<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

include 'database.php';

$id = $_GET['id'];

// Hapus file gambar terkait
$sql_select = "SELECT image FROM events WHERE id = ?";
$stmt_select = $conn->prepare($sql_select);
$stmt_select->bind_param("i", $id);
$stmt_select->execute();
$result = $stmt_select->get_result();
$row = $result->fetch_assoc();
if ($row['image'] && file_exists('uploads/' . $row['image'])) {
    unlink('uploads/' . $row['image']);
}

// Hapus record dari database
$sql_delete = "DELETE FROM events WHERE id = ?";
$stmt_delete = $conn->prepare($sql_delete);
$stmt_delete->bind_param("i", $id);

if ($stmt_delete->execute()) {
    header("location: dashboard.php");
    exit;
} else {
    echo "Error deleting record: " . $conn->error;
}
?>