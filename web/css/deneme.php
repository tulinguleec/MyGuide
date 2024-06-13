<?php
session_start();

// Eğer kayıtlı üyeler oturum değişkeninde saklanacaksa, oturumu temizleyelim
if (!isset($_SESSION['registered_users'])) {
    $_SESSION['registered_users'] = array();
}

// 15 kişilik grupları temsil eden bir dizi oluşturalım
$groups = array();

// Her grup için 15 boş üye oluşturalım
for ($i = 0; $i < 15; $i++) {
    $groups[$i] = array();
}

// Kayıt olma işlemi
function register($name) {
    global $groups;

    // Daha önce kayıt olmuşsa kaydı reddet
    if (in_array($name, $_SESSION['registered_users'])) {
        return "Üzgünüz, zaten kayıtlısınız.";
    }

    // Her gruptaki üye sayısını kontrol et
    foreach ($groups as $key => $group) {
        // Eğer grup dolu değilse, üyeyi ekleyip kaydı tamamla
        if (count($group) < 15) {
            array_push($groups[$key], $name);
            // Kaydı yapılan üyeyi oturum değişkenine ekle
            $_SESSION['registered_users'][] = $name;
            return "Kayıt başarılı!";
        }
    }

    // Eğer hiçbir grupta boş yer yoksa, kaydı reddet
    return "Üzgünüz, tüm gruplar dolu.";
}

// Örnek kullanım
echo register("Ahmet"); // Kayıt başarılı!
echo register("Mehmet"); // Kayıt başarılı!
echo register("Ayşe");   // Kayıt başarılı!
echo register("Fatma");  // Kayıt başarılı!
echo register("Ahmet");  // Üzgünüz, zaten kayıtlısınız.
echo register("Ayşe");   // Üzgünüz, zaten kayıtlısınız.
?>
