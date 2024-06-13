<?php 
include 'header.php';
include "baglanti.php";


// Kullanıcı oturumunda giriş yapmış olup olmadığını kontrol et
if (!isset($_SESSION['user_id'])) {
    // Kullanıcı giriş yapmamışsa, giriş yapma sayfasına yönlendir
    header("Location: giris.php");
    exit;
}

// Kullanıcı kimliğini al
$user_id = $_SESSION['user_id'];

// Rehber kimliğini al
$rehber_id = isset($_POST['rehber_id']) ? mysqli_real_escape_string($conn, $_POST['rehber_id']) : null;

// Favori ekleme işlemini gerçekleştir
$sql = "INSERT INTO favori (user_id, rehber_id) VALUES ('$user_id', '$rehber_id')";

if ($conn->query($sql) === TRUE) {
    echo "Favori başarıyla eklendi";
} else {
    echo "Favori eklenirken hata oluştu: " . $conn->error;
}

// Veritabanı bağlantısını kapat
$conn->close();
?>
