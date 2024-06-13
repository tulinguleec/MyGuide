<?php
include "baglanti.php";
 include "header.php"; 
$error_message = "";

// Form gönderildiğinde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["user_ad"];
    $usersurname = $_POST["user_soyad"];
    $email = $_POST["user_mail"];
    $usertel = $_POST["user_tel"];
    $userpassword = $_POST["user_password"];
    $confirm_password = $_POST["confirm_password"];
    $cinsiyet_id = $_POST["cinsiyet_id"]; 
    $dogum_yil = $_POST["dogum_yil"]; 

    // Şifrelerin eşleşip eşleşmediğini kontrol et
    if ($userpassword != $confirm_password) {
        $error_message = "Hata: Şifreler eşleşmiyor";
    } else {
        // Şifreler eşleşiyorsa, veritabanına veri ekleme işlemine devam et
        $sql = "INSERT INTO user (user_ad,user_soyad,user_mail,user_tel,user_password,cinsiyet_id,dogum_yil) VALUES ('$username', '$usersurname', '$email','$usertel','$userpassword','$cinsiyet_id','$dogum_yil')";

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
		<h2 class="heading text-capitalize text-center mb-lg-5 mb-4"> Kaydınızı oluşturun</h2>
		<div class="contact-grids">
			<div class="row">
				<div class="col-lg-7 contact-left-form">
                <form method="post" class="row" action=" <?php echo $_SERVER["PHP_SELF"]; ?>">
                            <div class="col-sm-6 form-group contact-forms">
                                <span><i  aria-hidden="true"></i></span>
                                <input type="text"class="form-control" name="user_ad" placeholder="Adınız" value="<?php if(isset($_POST['user_ad'])) echo $_POST['user_ad']; ?>" required="">
                            </div>
                            <div class="col-sm-6 form-group contact-forms">
                                <span><i  aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name="user_soyad" placeholder="Soyadınız" value="<?php if(isset($_POST['user_soyad'])) echo $_POST['user_soyad']; ?>" required="">
                            </div>
                            <div class="col-sm-6 form-group contact-forms">
                                <span><i aria-hidden="true"></i></span>
                                <input type="email" class="form-control" name="user_mail" placeholder="E-mail" value="<?php if(isset($_POST['user_mail'])) echo $_POST['user_mail']; ?>" required="">
                            </div>
                            <div class="col-sm-6 form-group contact-forms">
                                <span><i  aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name="user_tel" placeholder="Telefon Numarası" value="<?php if(isset($_POST['user_tel'])) echo $_POST['user_tel']; ?>" required="">
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
                                <input type="text" class="form-control" name="dogum_yil" placeholder="Dogum Yılı" value="<?php if(isset($_POST['dogum_yil'])) echo $_POST['dogum_yil']; ?>" required="">
                            </div>
                            <div class="col-sm-6 form-group contact-forms">
                                <span><i  aria-hidden="true"></i></span>
                                <input type="Password" class="form-control" name="user_password" placeholder="Şifre" required="">
                            </div>
                            <div class="col-sm-6 form-group contact-forms">
                                <span><i aria-hidden="true"></i></span>
                                <input type="Password" class="form-control" name="confirm_password" placeholder="Şifre Tekrarı" required="">
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
						<img src="images/kayit.jpg" alt="" class="img-fluid" />
					</div>
					
					<h4>Tatilinizi Planlamaya Başlayın</h4>
					<p class="mt-3">Tatilinizi Oluşturmak İçin Kaydınızı Oluşturun. Size En Uygun Tatil Planlarınızı Oluşturup Unutulmaz Anılarınızı Yaratın</p>
					
				</div>
			</div>
		</div>
	</div>
</section>
<!-- //Booking -->


<!--footer -->

<!-- //footer -->


<!-- move top -->
<div class="move-top text-right">
	<a href="#home" class="move-top"> 
		<span class="fa fa-angle-up  mb-3" aria-hidden="true"></span>
	</a>
</div>
<!-- move top -->

<?php 
include "footer.php"; ?>
</body>
</html>