<?php
// Bağlantı dosyasını ekleyin
include "baglanti.php";

session_start();
$user_id = $_SESSION['user_id'];

// POST verilerini alın
$tur_id = $_POST['tur_id']; 

// Kullanıcının belirli bir tura zaten kayıtlı olup olmadığını kontrol etme
$sql_check = "SELECT * FROM rezervasyon WHERE tur_id = '$tur_id' AND user_id = '$user_id'";
$result_check = $conn->query($sql_check);

// Eğer kullanıcı zaten bu tura kayıtlıysa, uyarı ver
if ($result_check->num_rows > 0) {
    echo "Bu tura zaten kayıtlısınız!";
} else {
    // Tura kayıtlı kişi sayısını kontrol etme
    $sql_count = "SELECT COUNT(*) AS kayitli_sayisi FROM rezervasyon WHERE tur_id = '$tur_id'";
    $result_count = $conn->query($sql_count);
    $row_count = $result_count->fetch_assoc();
    $kayitli_sayisi = $row_count['kayitli_sayisi'];

    // Kontenjan kontrolü
    $kontenjan_limit = 15;
    if ($kayitli_sayisi >= $kontenjan_limit) {
        echo "Üzgünüz, bu turun kontenjanı dolu!";
    } else {
        // Rezervasyon tablosuna ekleme sorgusu
        $sql = "INSERT INTO rezervasyon (tur_id, user_id) VALUES ('$tur_id', '$user_id')";

        if ($conn->query($sql) === TRUE) {
            // Başarılı ekleme durumunda mesajı döndür
            echo "Rezervasyon başarıyla oluşturuldu.";
        } else {
            // Hata durumunda hata mesajını döndür
            echo "Rezervasyon oluşturulurken hata oluştu: " . $conn->error;
        }
    }
}

// Bağlantıyı kapat
$conn->close();
?>
