<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "baglanti.php";
include "header.php";

// Kullanıcının rehber olup olmadığını kontrol et
if (!isset($_SESSION['rehber_id'])) {
    echo "<script>
        alert('Rehber kaydınız bulunmuyorsa tur ilanı açamazsınız');
        window.location.href = 'kayit2.php'; // Anasayfaya veya uygun bir sayfaya yönlendirin
    </script>";
    exit();
}

// Oturumda kullanıcı kimliği mevcut
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Kullanıcı tablosundan rehber_id'yi almak için bir sorgu yapın
    $sql2 = "SELECT rehber_id FROM rehber WHERE user_id = $user_id";

    // Sorguyu yürütün
    $result2 = $conn->query($sql2);

    // Sorgu sonucunda elde edilen rehber_id'yi alın
    if ($result2->num_rows > 0) {
        $row = $result2->fetch_assoc();
        $rehber_id = $row['rehber_id'];

        // Form gönderildiğinde
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tur_ad = $_POST["tur_ad"];
            $tur_fiyat = $_POST["tur_fiyat"];
            $il_id = $_POST["il_id"];
            $dil_id = $_POST["dil_id"];
            $tur_tarih = $_POST["tur_tarih"];
            $tur_saat = $_POST["tur_saat"];
            $tur_aciklama = $_POST["tur_aciklama"];

            // Fotoğraf dosyasını alıyoruz
            $tur_gorsel = $_FILES["tur_gorsel"]["name"]; // Dosya adı
            $tur_gorsel_tmp = $_FILES["tur_gorsel"]["tmp_name"]; // Geçici dosya yolu

            // Fotoğrafı görsel klasörüne kaydet
            move_uploaded_file($tur_gorsel_tmp, "gorsel/" . $tur_gorsel);

            // Veritabanına veri ekleme işlemi
            $sql = "INSERT INTO tur (rehber_id, tur_ad, tur_fiyat, il_id, dil_id, tur_tarih, tur_saat, tur_aciklama, tur_gorsel) VALUES ('$rehber_id', '$tur_ad', '$tur_fiyat', '$il_id', '$dil_id', '$tur_tarih', '$tur_saat', '$tur_aciklama', '$tur_gorsel')";

            if ($conn->query($sql) === TRUE) {
                header("Location: services.php");
                exit();
            } else {
                $error_message = "Hata: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        $error_message = "Kullanıcı bulunamadı!";
    }
}

$sql2 = "SELECT * FROM il";
$result2 = $conn->query($sql2);
$sql3 = "SELECT * FROM diller";
$result3 = $conn->query($sql3);
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyGuide</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="MyGuide" />

    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    
    <!-- css files -->
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' /><!-- bootstrap css -->
    <link href="css/style.css" rel='stylesheet' type='text/css' /><!-- custom css -->
    <link href="css/font-awesome.min.css" rel="stylesheet"><!-- fontawesome css -->
    <!-- //css files -->
    
    <!-- google fonts -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- //google fonts -->
    
</head>
<body>

<!-- banner -->
<section class="banner_inner" id="home">
    <div class="banner_inner_overlay">
    </div>
</section>
<!-- //banner -->

<!-- Booking -->
<section class="contact py-5">
    <div class="container py-lg-5 py-sm-4">
        <h2 class="heading text-capitalize text-center mb-lg-5 mb-4">Kendi Turlarınızı Oluşturun</h2>
        <div class="contact-grids">
            <div class="row">
                <div class="col-lg-7 contact-left-form">
                    <form method="post" class="row" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
                        <div class="col-sm-6 form-group contact-forms">
                            <span><i aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="tur_ad" placeholder="Turun Adı" value="<?php if(isset($_POST['tur_ad'])) echo $_POST['tur_ad']; ?>" required="">
                        </div>
                        <div class="col-sm-6 form-group contact-forms">
                            <span><i aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="tur_fiyat" placeholder="Tur Fiyatını Belirleyin" value="<?php if(isset($_POST['tur_fiyat'])) echo $_POST['tur_fiyat']; ?>" required="">
                        </div>
                        <div class="col-sm-6 form-group contact-forms">
                            <span><i aria-hidden="true"></i></span>
                            <input type="date" class="form-control" name="tur_tarih" placeholder="Turun Tarihi" value="<?php if(isset($_POST['tur_tarih'])) echo $_POST['tur_tarih']; ?>" required="">
                        </div>
                        <div class="col-sm-6 form-group contact-forms">
                            <span><i aria-hidden="true"></i></span>
                            <input type="time" class="form-control" name="tur_saat" placeholder="Turun Saati" value="<?php if(isset($_POST['tur_saat'])) echo $_POST['tur_saat']; ?>" required="">
                        </div>
                        <div class="col-sm-6 form-group contact-forms">
                            <span><i aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="tur_aciklama" placeholder="Tur Hakkında Açıklama" value="<?php if(isset($_POST['tur_aciklama'])) echo $_POST['tur_aciklama']; ?>" required="">
                        </div>
                        <div class="col-sm-6 form-group contact-forms">
                            <span><i aria-hidden="true"></i></span>
                            <select name="il_id" id="il_id" required="true" class="form-control">
                                <option value="" selected disabled>Turun Yapılacağı İl</option>
                                <?php
                                if ($result2->num_rows > 0) {
                                    while($row = $result2->fetch_assoc()) {
                                        echo '<option value="'.$row["il_id"].'">'.$row["il_ad"].'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-6 form-group contact-forms">
                            <span><i aria-hidden="true"></i></span>
                            <select name="dil_id" id="dil_id" required="true" class="form-control">
                                <option value="" selected disabled>Turun Dili?</option>
                                <?php
                                if ($result3->num_rows > 0) {
                                    while($row = $result3->fetch_assoc()) {
                                        echo '<option value="'.$row["dil_id"].'">'.$row["dil_ad"].'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-6 form-group contact-forms">
                            <input type="file" class="form-control" name="tur_gorsel" accept="image/*" required="">
                        </div>
                        <button class="btn btn-block sent-butnn" type="submit">Turunuzu Oluşturun</button>
                        <?php if(!empty($error_message)): ?>
                            <div class="error"><?php echo $error_message; ?></div>
                        <?php endif; ?>
                        <?php if(!empty($success_message)): ?>
                            <div class="success"><?php echo $success_message; ?></div>
                        <?php endif; ?>
                    </form>
                </div>
                <div class="col-lg-5 contact-right pl-lg-5">
                    <div class="image-tour position-relative">
                        <img src="images/kayit2.jpg" alt="" class="img-fluid" />
                    </div>
                    <h4>Aramıza Katılın!</h4>
                    <p class="mt-3">Tur Rehberi olarak artık acentelere ihtiyacınız kalmadan müşterilerinizi bulabileceğiniz bu yeni dünyaya adım atın</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- //Booking -->

<!-- move top -->
<div class="move-top text-right">
    <a href="#home" class="move-top"> 
        <span class="fa fa-angle-up mb-3" aria-hidden="true"></span>
    </a>
</div>
<!-- move top -->

<?php include "footer.php"; ?>
</body>
</html>
