<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

include 'database.php';
include 'templates/header.php';

$sql = "SELECT * FROM events ORDER BY date DESC";
$result = $conn->query($sql);
?>

<h2>Dashboard Acara</h2>
<a href="add_event.php" class="btn" style="display:inline-block; margin-bottom: 1.5rem; width:auto;">Tambah Acara Baru</a>
<a href="logout.php" class="btn" style="display:inline-block; margin-bottom: 1.5rem; width:auto; background-color:#dc2626;">Logout</a>

<div class="event-grid">
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<div class="event-card">';
            echo '<img src="uploads/' . ($row["image"] ? $row["image"] : 'placeholder.jpg') . '" alt="' . $row["title"] . '">';
            echo '<div class="card-content">';
            echo '<h3>' . $row["title"] . '</h3>';
            echo '<p>' . date("d M Y", strtotime($row["date"])) . ' - ' . $row["location"] . '</p>';
            echo '<p>' . substr($row["description"], 0, 100) . '...</p>';
            echo '<div style="margin-top:1rem;">';
            echo '<a href="edit_event.php?id=' . $row["id"] . '" style="text-decoration:none; color:#2563eb; margin-right:1rem;">Edit</a>';
            echo '<a href="delete_event.php?id=' . $row["id"] . '" onclick="return confirm(\'Yakin ingin menghapus acara ini?\')" style="text-decoration:none; color:#dc2626;">Hapus</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "<p>Belum ada acara. Silakan tambahkan acara baru.</p>";
    }
    ?>
</div>

<?php include 'templates/footer.php'; ?>