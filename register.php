<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        header("location: login.php");
        exit;
    } else {
        $error = "Gagal mendaftar. Coba lagi.";
    }
}

include 'templates/header.php';
?>

<div class="form-container">
    <h2>Register</h2>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form action="register.php" method="post">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit" class="btn">Register</button>
    </form>
</div>

<?php include 'templates/footer.php'; ?>