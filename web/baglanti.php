<?php
// Veritabanı bağlantısı için gerekli bilgiler
$servername = "localhost";
$username = "root";
$password = "";
$database = "myguide";

// Veritabanı bağlantısını oluşturma
$conn = new mysqli($servername, $username, $password, $database);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
mysqli_set_charset($conn, "utf8");
?>