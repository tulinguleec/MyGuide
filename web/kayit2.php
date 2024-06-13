<?php
include "baglanti.php";
include "header.php";
$error_message = "";

// Form gönderildiğinde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aciklama = $_POST["aciklama"]; // Değişiklik burada
    $ucret = $_POST["ucret"]; // Değişiklik burada
    $il_id = $_POST["il_id"]; // Değişiklik burada
    $dil_id = $_POST["dil_id"];
    $user_id=$_SESSION["user_id"];
    $deneyim_sure=$_POST["deneyim_sure"];

    // Fotoğraf dosyasını alıyoruz
    $rehber_resim = $_FILES["rehber_resim"]["name"]; // Dosya adı
    $rehber_resim_tmp = $_FILES["rehber_resim"]["tmp_name"]; // Geçici dosya yolu

        // Fotoğrafı resim klasörüne kaydet
        move_uploaded_file($rehber_resim_tmp, "resim/" . $rehber_resim);

        // Şifreler eşleşiyorsa, veritabanına veri ekleme işlemine devam et
        $sql = "INSERT INTO rehber (user_id,aciklama,il_id,dil_id,ucret,deneyim_sure,gorsel) VALUES ('$user_id','$aciklama','$il_id','$dil_id','$ucret','$deneyim_sure','$rehber_resim')";

        if ($conn->query($sql) === TRUE) {
            $success_message = "Yeni kayıt başarıyla eklendi";
        } else {
            echo "Hata: " . $sql . "<br>" . $conn->error;
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
		<h2 class="heading text-capitalize text-center mb-lg-5 mb-4">Tur Rehberi Olarak Kaydınızı oluşturun</h2>
		<div class="contact-grids">
			<div class="row">
				<div class="col-lg-7 contact-left-form">
                <form method="post" class="row" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
                            <div class="col-sm-6 form-group contact-forms">
                                <span><i  aria-hidden="true"></i></span>
                                <input type="text"class="form-control" name="aciklama" placeholder="Açıklama Yazınız" value="<?php if(isset($_POST['aciklama'])) echo $_POST['aciklama']; ?>" required="">
                            </div>
                            <div class="col-sm-6 form-group contact-forms">
                                <span><i aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name="ucret" placeholder="Saatlik ücret belirleyiniz." value="<?php if(isset($_POST['ucret'])) echo $_POST['ucret']; ?>" required="">
                            </div>
                            <div class="col-sm-6 form-group contact-forms">
                                <span><i aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name="deneyim_sure" placeholder="Rehber Deneyim Yılı?" value="<?php if(isset($_POST['deneyim_sure'])) echo $_POST['deneyim_sure']; ?>" required="">
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
    <option value="" selected disabled>Dilinizi Seçin</option>
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
                                <input type="file"class="form-control" name="rehber_resim" accept="image/*" required="">
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
