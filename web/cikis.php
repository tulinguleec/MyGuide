<?php
// Oturumu başlat
session_start();

// Oturumu sonlandır (tüm oturum değişkenlerini temizler)
session_unset();

// Oturumu sonlandır (oturum dosyasını yok eder)
session_destroy();

// Kullanıcıyı index.php sayfasına yönlendir
header("Location: index.php");
exit; // Yönlendirme işleminden sonra kodun devam etmemesi için
?>