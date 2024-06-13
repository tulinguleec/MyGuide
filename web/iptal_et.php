<?php
include "baglanti.php";

// AJAX isteği ile gelen tur_id ve user_id parametrelerini alalım
$tur_id = $_POST['tur_id'];
$user_id = $_POST['user_id'];

// İptal edilecek rezervasyonu sorgulayalım ve silme işlemini gerçekleştirelim
$sql = "DELETE FROM rezervasyon WHERE tur_id = $tur_id AND user_id = $user_id";

if ($conn->query($sql) === TRUE) {
    // Başarılı bir şekilde iptal edildiyse 200 (OK) durum kodu gönderelim
    http_response_code(200);
} else {
    // Hata durumunda 500 (Internal Server Error) durum kodu gönderelim
    http_response_code(500);
}

// Veritabanı bağlantısını kapat
$conn->close();
?>
