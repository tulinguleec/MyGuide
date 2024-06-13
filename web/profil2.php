<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'your_database');
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM user WHERE id = $user_id";
$result = $conn->query($query);
if ($result->num_rows != 1) {
    echo "Kullanıcı bulunamadı.";
    exit();
}

$user_info = $result->fetch_assoc();
$user_type = $user_info['user_type'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profil Sayfası</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php if ($user_type == 'rehber') { ?>
        <div class="profile rehber">
            <h1>Rehber Profil Sayfası</h1>
            <h2>Kullanıcı Adı: <?php echo $user_info['rehber_id']; ?></h2>
            <p>Email: <?php echo $user_info['user_mail']; ?></p>
            <!-- Rehberlere özel diğer bilgiler -->
        </div>
    <?php } else if ($user_type == 'user') { ?>
        <div class="profile user">
            <h1>User Profil Sayfası</h1>
            <h2>Kullanıcı Adı: <?php echo $user_info['user_id']; ?></h2>
            <p>Email: <?php echo $user_info['user_mail']; ?></p>
            <!-- Kullanıcılara özel diğer bilgiler -->
        </div>
    <?php } ?>
</body>
</html>
