<?php
include 'database.php';
include 'templates/header.php';

$sql = "SELECT * FROM events ORDER BY date DESC";
$result = $conn->query($sql);
?>

<h2>Acara Terbaru</h2>

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
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "<p style='text-align:center;'>Belum ada acara yang ditambahkan.</p>";
    }
    ?>
</div>

<?php include 'templates/footer.php'; ?>