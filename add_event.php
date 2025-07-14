<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $image = $_FILES['image']['name'];

    if($image){
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    } else {
        $image = 'placeholder.jpg'; // default image
    }

    $sql = "INSERT INTO events (title, description, date, location, image) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $title, $description, $date, $location, $image);

    if ($stmt->execute()) {
        header("location: dashboard.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

include 'templates/header.php';
?>

<div class="form-container">
    <h2>Tambah Acara Baru</h2>
    <form action="add_event.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Judul Acara</label>
            <input type="text" name="title" required>
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="description" rows="5" style="width:100%; padding:0.75rem; border:1px solid #d1d5db; border-radius:5px;"></textarea>
        </div>
        <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="date" required>
        </div>
        <div class="form-group">
            <label>Lokasi</label>
            <input type="text" name="location" required>
        </div>
        <div class="form-group">
            <label>Gambar Acara</label>
            <input type="file" name="image">
        </div>
        <button type="submit" class="btn">Simpan</button>
    </form>
</div>

<?php include 'templates/footer.php'; ?>