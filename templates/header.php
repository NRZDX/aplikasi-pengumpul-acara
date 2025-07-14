<?php if (session_status() == PHP_SESSION_NONE) { session_start(); } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pengumpul Acara</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <a href="index.php" class="logo">AcaraKumpul</a>
            <nav>
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                    <a href="dashboard.php">Dashboard</a>
                    <a href="logout.php" class="btn-primary">Logout</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                    <a href="register.php" class="btn-primary">Daftar</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
    <main class="container">