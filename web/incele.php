
<?php
include "baglanti.php";
include "header.php"; 

// URL'den tur id'sini al
$user_id = $_SESSION['user_id'];
$tur_id=isset($_GET['tur_id']) ? $_GET['tur_id'] : null;
// Tur bilgilerini almak için sorgu yap
$sql = "SELECT tur.tur_ad,user.user_ad,user.user_soyad,user.user_mail
FROM user INNER JOIN rezervasyon ON user.user_id=rezervasyon.user_id
INNER JOIN tur ON tur.tur_id=rezervasyon.tur_id
INNER JOIN rehber ON rehber.rehber_id=tur.rehber_id
Where rezervasyon.tur_id= $tur_id" ;

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>MyGuide</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<meta name="keywords" content="MyGuide" />
<!-- css files -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
    }
    .containera {
        display: flex;
        justify-content: flex-start;
        align-items: flex-start;
        margin-top: 10px;
        margin-left: 10px;
    }
    .sidebar {
        background-color: #047ffc;
        color: #fff;
        width: 250px;
        padding: 20px;
        border-radius: 10px;
    }
    .sidebar h2 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #fff;
    }
    .sidebar nav ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }
    .sidebar nav li {
        margin-bottom: 10px;
    }
    .sidebar nav a {
        color: #fff;
        text-decoration: none;
        font-size: 18px;
        display: block;
        padding: 12px 20px;
        transition: background-color 0.3s ease;
        border-radius: 5px;
    }
    .sidebar nav a:hover {
        background-color: #294a73;
    }
    .content {
        padding: 5px;
        border-radius: 5px;
        margin-left: 20px;
    }
    .content h2 {
        font-size: 30px;
        margin-bottom: 20px;
        color: black;
    }
    .user-list {
        margin-top: 20px;
    }
    .user-list-item {
        border: 1px solid #ddd;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        background-color: #fff;
    }
    .user-table {
        width: 100%;
        border-collapse: collapse;
    }
    .user-table th, .user-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    .user-table th {
        background-color: #f2f2f2;
    }
</style>
</head>
<section class="banner_inner" id="home">
    <div class="banner_inner_overlay"></div>
</section>
<!-- //banner -->
<body>
    <div class="containera">
        <div class="sidebar">
            <h2>Profil Menüsü</h2>
            <nav>
                <ul>
                    <li><a href="rehber_turlarim.php">Aktif Turlarım</a></li>
                    <li><a href="tur_bilgileri.php">Tur Bilgileri</a></li>
                    <li><a href="rehber_gecmis.php">Geçmişim</a></li>
                </ul>
            </nav>
        </div>
        <div class="content">
            <h2>Katılımcılar</h2>
            <div class="user-list">
                <?php
                if ($result && $result->num_rows > 0) {
                    echo "<table class='user-table'>";
                    echo "<tr><th>Tur Adı</th><th>Ad</th><th>Soyad</th><th>E-posta</th></tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['tur_ad'] . "</td>";
                        echo "<td>" . $row['user_ad'] . "</td>";
                        echo "<td>" . $row['user_soyad'] . "</td>";
                        echo "<td>" . $row['user_mail'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "Henüz kimse kayıtlı değil.";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>