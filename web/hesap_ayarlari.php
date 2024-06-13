<?php
include "baglanti.php";
include "header.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>MyGuide</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<meta name="keywords" content="MyGuide" />

<!-- css files -->
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

.delete-account-btn {
    background-color: #047ffc;
    color: #fff;
    font-size: 20px;
    padding: 12px 25px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.delete-account-btn:hover {
    background-color: #fff;
    color: #047ffc;
}
</style>
<!-- //css files -->
</head>
<body>
<section class="banner_inner" id="home">
    <div class="banner_inner_overlay">
    </div>
</section>
<!-- //banner -->
<div class="containera">
    <div class="sidebar">
        <h2>Profil Menüsü</h2>
        <nav>
            <ul>
                <li><a href="turlarim.php">Turlarım</a></li>
                <li><a href="favori.php">Favorilerim</a></li>
                <li><a href="gecmis.php">Geçmişim</a></li>
                <li><a href="hesap_ayarlari.php">Hesap Ayarları</a></li>
            </ul>
        </nav>
    </div>
    <div class="content">
        <h2>Profil Bilgileri</h2>
        <!-- Profil bilgileri buraya gelecek -->
        <button class="delete-account-btn" onclick="confirmDelete()">Hesabı Sil</button>
    </div>
</div>

<script>
function confirmDelete() {
    if (confirm("Hesabınızı silmek istediğinize emin misiniz?")) {
        // Kullanıcı onayladı, hesap silme işlemini gerçekleştir
        // AJAX kullanmadan direkt olarak hesap_sil.php sayfasına yönlendirme yapabiliriz.
        window.location.href = "hesap_sil.php";
    }
}
</script>
</body>
</html>
