<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

include 'database.php';

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    $image = $old_image;
    if($new_image){
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($new_image);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $image = $new_image;
    }

    $sql = "UPDATE events SET title=?, description=?, date=?, location=?, image=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $title, $description, $date, $location, $image, $id);

    if ($stmt->execute()) {
        header("location: dashboard.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $sql = "SELECT * FROM events WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $event = $result->fetch_assoc();
}

include 'templates/header.php';
?>

<div class="form-container">
    <h2>Edit Acara</h2>
    <form action="edit_event.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="old_image" value="<?php echo $event['image']; ?>">
        <div class="form-group">
            <label>Judul Acara</label>
            <input type="text" name="title" value="<?php echo $event['title']; ?>" required>
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="description" rows="5" style="width:100%; padding:0.75rem; border:1px solid #d1d5db; border-radius:5px;"><?php echo $event['description']; ?></textarea>
        </div>
        <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="date" value="<?php echo $event['date']; ?>" required>
        </div>
        <div class="form-group">
            <label>Lokasi</label>
            <input type="text" name="location" value="<?php echo $event['location']; ?>" required>
        </div>
        <div class="form-group">
            <label>Gambar Acara</label>
            <input type="file" name="image">
            <img src="uploads/<?php echo $event['image']; ?>" width="100" style="margin-top:10px;">
        </div>
        <button type="submit" class="btn">Update</button>
    </form>
</div>

<?php include 'templates/footer.php'; ?>