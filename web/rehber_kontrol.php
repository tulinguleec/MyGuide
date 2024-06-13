<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "baglanti.php";

// Kullanıcının oturum bilgilerini kontrol et
$user_id = $_SESSION['user_id'] ?? null;

$rehber_id = null;
if ($user_id) {
    $sql = "SELECT rehber_id FROM rehber WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $rehber = $result->fetch_assoc();
        $rehber_id = $rehber['rehber_id'];
    }
    $stmt->close();
}

// Kullanıcı rehber mi değil mi kontrol eden değişken
$_SESSION['rehber_id'] = $rehber_id;
?>
