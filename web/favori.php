<?php
include "baglanti.php";
include "header.php"; 

// Kullanıcının ID'sini oturumdan al
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    echo "Kullanıcı oturum açmamış.";
    exit;
}

// Kullanıcının favori rehberlerini getir
$sql = "SELECT user.user_id, user.user_ad, user.user_soyad, user.user_tel, user.user_mail, user.dogum_yil, rehber.rehber_id, rehber.aciklama, rehber.ucret, rehber.gorsel, il.il_ad, il.il_id, cinsiyet.cinsiyet_ad, diller.dil_ad
    FROM favori
    JOIN rehber ON favori.rehber_id = rehber.rehber_id
    JOIN il ON rehber.il_id = il.il_id
    JOIN user ON rehber.user_id = user.user_id
    JOIN diller ON rehber.dil_id = diller.dil_id
    JOIN cinsiyet ON user.cinsiyet_id = cinsiyet.cinsiyet_id
    WHERE favori.user_id = ?
    ORDER BY favori.favori_id DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$conn->close();
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
        margin-top: 1px;
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
        margin-left: 15px;
        margin-top: 0px; /* Profil bilgilerinin başlangıç noktasını ayarlayın */
    }

    .content h2 {
        font-size: 30px;
        margin-bottom: 20px;
        color: black;
    }
</style>
</head>
<section class="banner_inner" id="home">
    <div class="banner_inner_overlay">
    </div>
</section>
<!-- //banner -->
<body>
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
            <section class="packages pt-5">
                <div class="container py-lg-4 py-sm-3">
                    <h2 class="heading text-capitalize text-center">Favori Rehberlerim</h2>
                    <p class="text mt-2 mb-5 text-center"></p>
                    <div class="row">
                        <?php
                        if ($result->num_rows > 0) {
                            // Veritabanından gelen verileri kullanarak HTML çıktısını oluşturma
                            while($row = $result->fetch_assoc()) {
                                ?>
                                <div class="col-lg-3 col-sm-6 mb-5">
                                    <div class="image-tour position-relative">
                                        <a href="profil.php?rehber_id=<?php echo $row["rehber_id"]; ?>" class="image-tour position-relative">
                                            <img src="resim/<?php echo $row["gorsel"]; ?>" alt="" class="img-fluid" />
                                        </a>
                                    </div>
                                    <div class="package-info">
                                        <h6 class="mt-1"><span class="fa fa-map-marker mr-2"></span><?php echo $row["il_ad"];?></h6>
                                        <h5 class="my-2"><?php echo $row["user_ad"] . ' ' . $row["user_soyad"]; ?></h5>
                                        <p class=""><?php echo $row["aciklama"]; ?></p>
                                        <ul class="listing mt-3">
                                            <li><span class="fa fa-money mr-2"></span>Ücret : <span><?php echo $row["ucret"]; ?></span></li>
                                        </ul>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo "<p class='text-center'>Favori rehber bulunmamaktadır.</p>";
                        }
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
