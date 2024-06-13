<?php
// Veritabanı bağlantısını içe aktar
include "baglanti.php";
include "header.php";


// Hesap silme işlemini gerçekleştir
// Örneğin, kullanıcıya ilişkin bilgileri silelim
// Bu sadece bir örnek, gerçek uygulamada daha fazla işlem yapılabilir
$user_id = $_SESSION['user_id']; // Varsayılan olarak kullanıcı oturumunu kullanıyoruz, gerçek uygulamada kullanıcıyı doğrulamak için uygun bir yöntem kullanılmalıdır

// Kullanıcıya ilişkin bilgileri sil
// Örneğin:
$sql = "DELETE FROM user WHERE user_id = $user_id";
if ($conn->query($sql) === TRUE) {
    // Kullanıcı bilgileri başarıyla silindi, oturumu sonlandır ve ana sayfaya yönlendir
    
    session_destroy(); // Oturumu sonlandır
    header("Location: index.php"); // Ana sayfaya yönlendir
    exit;
} else {
    // Kullanıcı bilgileri silinemediğinde bir hata mesajı gösterebiliriz
    echo "Hata: " . $conn->error;
}

// Veritabanı bağlantısını kapat
$conn->close();
?>
