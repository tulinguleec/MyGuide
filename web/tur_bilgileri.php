<?php
session_start();
include "baglanti.php";
include "header.php"; 

$user_id = $_SESSION['user_id'];

// Kullanıcının kayıtlı olduğu rehberin turlarını getiren sorgu
$sql = "SELECT 
            tur.tur_id,
            tur.tur_ad,
            tur.tur_fiyat,
            tur.tur_saat,
            tur.tur_tarih,
            il.il_ad,
            diller.dil_ad,
            tur.tur_gorsel,
            tur.tur_aciklama
        FROM 
            rehber
        INNER JOIN 
            il ON rehber.il_id = il.il_id
        INNER JOIN 
            diller ON rehber.dil_id = diller.dil_id
        INNER JOIN 
            tur ON rehber.rehber_id = tur.rehber_id
        WHERE 
            rehber.user_id = $user_id
        ORDER BY 
            tur.tur_id DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>MyGuide</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<meta name="keywords" content="MyGuide" />

<!-- css files -->
<!-- //css files -->
<!-- google fonts -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<!-- //google fonts -->
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
.view-btn {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin-top: 10px;
    cursor: pointer;
    border-radius: 5px;
}
.view-btn:hover {
    background-color: #0056b3;
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
                <li><a href="rehber_turlarim.php">Aktif Turlarım</a></li>
                    <li><a href="tur_bilgileri.php">Tur Bilgileri</a></li>
                    <li><a href="rehber_gecmis.php">Geçmişim</a></li>
                </ul>
            </nav>
        </div>
        <div class="container py-lg-4 py-sm-3">
        <h2 class="heading text-capitalize text-center"></h2>
        <p class="text mt-2 mb-5 text-center"></p>
        <div class="row">
        <?php
            if ($result && $result->num_rows > 0) {
                // Veritabanından gelen verileri kullanarak HTML çıktısını oluşturma
                while($row = $result->fetch_assoc()) {
        ?>
                    <div class="col-lg-3 col-sm-6 mb-5">
                        <div class="image-tour position-relative">
                            <a href="" class="image-tour position-relative">
                                <img src="gorsel/<?php echo $row["tur_gorsel"]; ?>" alt="" class="img-fluid" />
                            </a>
                        </div>
                        <div class="package-info">
                            <h6 class="mt-1"><span class="fa fa-map-marker mr-2"></span><?php echo $row["il_ad"];?></h6>
                            <h5 class="my-2"></span>Turun Adı : <span><?php echo $row["tur_ad"]; ?></h5>
                            <h6 class="mt-1"><span class="fa fa-calendar"></span><?php echo $row["tur_tarih"];?></h6>
                            <h6 class="mt-1"></span><?php echo $row["tur_saat"];?></h6>
                            <p class=""></span>Daha Fazla Bilgi <span><?php echo $row["tur_aciklama"]; ?></p>
                            <ul class="listing mt-3">
                                <li><span class="fa fa-money mr-2"></span>Ücret : <span><?php echo $row["tur_fiyat"]; ?></span></li>
                            </ul>
                            <div class="text-center mt-4">
                                <button class="btn btn-primary btn-lg view-btn" onclick="window.location.href='incele.php?tur_id=<?php echo $row["tur_id"]; ?>'">Katılımcıları Gör</button>
                            </div>
                        </div>
                        
                    </div>
        <?php
                }
            } else {
                    echo "Henüz bir rezervasyonunuz bulunmamaktadır.";
                }
            ?>
                   </div>
    </div>
</div>

</body>
</html>
