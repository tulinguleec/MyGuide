<?php
include "baglanti.php";
include "header.php";
$error_message = "";

// Form gönderildiğinde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["rehber_ad"];
    $usersurname = $_POST["rehber_soyad"];
    $email = $_POST["rehber_mail"];
    $usertel = $_POST["rehber_no"];
    $userpassword = $_POST["rehber_password"];
    $confirm_password = $_POST["confirm_password"];
    $cinsiyet_id = $_POST["cinsiyet_id"]; // Değişiklik burada
    $il_id = $_POST["il_id"]; // Değişiklik burada
    $dil_id = $_POST["dil_id"];

    // Fotoğraf dosyasını alıyoruz
    $rehber_resim = $_FILES["rehber_resim"]["name"]; // Dosya adı
    $rehber_resim_tmp = $_FILES["rehber_resim"]["tmp_name"]; // Geçici dosya yolu

    // Şifrelerin eşleşip eşleşmediğini kontrol et
    if ($userpassword != $confirm_password) {
        $error_message = "Hata: Şifreler eşleşmiyor";
    } else {
        // Fotoğrafı resim klasörüne kaydet
        move_uploaded_file($rehber_resim_tmp, "resim/" . $rehber_resim);

        // Şifreler eşleşiyorsa, veritabanına veri ekleme işlemine devam et
        $sql = "INSERT INTO rehber (rehber_ad,rehber_soyad,rehber_mail,rehber_no,rehber_password,cinsiyet_id,il_id,dil_id,gorsel) VALUES ('$username', '$usersurname', '$email','$usertel','$userpassword','$cinsiyet_id','$il_id','$dil_id','$rehber_resim')";

        if ($conn->query($sql) === TRUE) {
            $success_message = "Yeni kayıt başarıyla eklendi";
        } else {
            echo "Hata: " . $sql . "<br>" . $conn->error;
        }
    }
}
$sql1 = "SELECT * FROM cinsiyet";
$result1 = $conn->query($sql1);
// Veritabanı bağlantısını kapatma
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
		<h2 class="heading text-capitalize text-center mb-lg-5 mb-4">Tur Rehberi Olarak Kaydınızı oluşturun</h2>
		<div class="contact-grids">
			<div class="row">
				<div class="col-lg-7 contact-left-form">
                <form method="post" class="row" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
                            <div class="col-sm-6 form-group contact-forms">
                                <span><i  aria-hidden="true"></i></span>
                                <input type="text" name="rehber_ad" placeholder="Adınız" value="<?php if(isset($_POST['rehber_ad'])) echo $_POST['rehber_ad']; ?>" required="">
                            </div>
                            <div class="col-sm-6 form-group contact-forms">
                                <span><i aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name="rehber_soyad" placeholder="Soyadınız" value="<?php if(isset($_POST['rehber_soyad'])) echo $_POST['rehber_soyad']; ?>" required="">
                            </div>
                            <div class="col-sm-6 form-group contact-forms">
                                <span><i  aria-hidden="true"></i></span>
                                <input type="email" class="form-control" name="rehber_mail" placeholder="E-mail" value="<?php if(isset($_POST['rehber_mail'])) echo $_POST['rehber_mail']; ?>" required="">
                            </div>
                            <div class="col-sm-6 form-group contact-forms">
                                <span><i  aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name="rehber_no" placeholder="Telefon Numarası" value="<?php if(isset($_POST['rehber_no'])) echo $_POST['rehber_no']; ?>" required="">
                            </div>
							<div class="col-sm-6 form-group contact-forms">
                                <span><i  aria-hidden="true"></i></span>
								<select name="cinsiyet_id" id="cinsiyet_id" required="true" class="form-control"> <!-- Değişiklik burada -->
    <option value="" selected disabled>Cinsiyet Seçin</option>
    <?php
    if ($result1->num_rows > 0) {
        while($row = $result1->fetch_assoc()) {
            echo '<option value="'.$row["cinsiyet_id"].'">'.$row["cinsiyet_ad"].'</option>'; // Değişiklik burada
        }
    }
    ?>
</select>

                            </div>
							<div class="col-sm-6 form-group contact-forms">
                                <span><i  aria-hidden="true"></i></span>
								<select name="il_id" id="il_id" required="true" class="form-control"> <!-- Değişiklik burada -->
    <option value="" selected disabled>İl Seçin</option>
    <?php
    if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
            echo '<option value="'.$row["il_id"].'">'.$row["il_ad"].'</option>'; // Değişiklik burada
        }
    }
    ?>
</select>
</div>
							<div class="col-sm-6 form-group contact-forms">
                                <span><i  aria-hidden="true"></i></span>
								<select name="dil_id" id="dil_id" required="true" class="form-control"> <!-- Değişiklik burada -->
    <option value="" selected disabled>Bildiğiniz Dilleri Seçin</option>
    <?php
    if ($result3->num_rows > 0) {
        while($row = $result3->fetch_assoc()) {
            echo '<option value="'.$row["dil_id"].'">'.$row["dil_ad"].'</option>'; // Değişiklik burada
        }
    }
    ?>
</select>

                            </div>
                            <div class="col-sm-6 form-group contact-forms">
                                <span><i  aria-hidden="true"></i></span>
                                <input type="Password" class="form-control" name="rehber_password" placeholder="Şifre" required="">
                            </div>
                            <div class="col-sm-6 form-group contact-forms">
                                <span><i  aria-hidden="true"></i></span>
                                <input type="Password" class="form-control" name="confirm_password" placeholder="Şifre Tekrarı" required="">
                            </div>
                            <div class="col-sm-9 form-group contact-forms">
                                <input type="file" name="rehber_resim" accept="image/*" required="">
                            </div>
                            <button class="btn btn-block sent-butnn" type="submit">Kayıt Ol</button>
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
		<span class="fa fa-angle-up  mb-3" aria-hidden="true"></span>
	</a>
</div>
<!-- move top -->

<?php include "footer.php"; ?>
</body>
</html>
