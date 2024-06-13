<?php
include "baglanti.php";
$error_message = "";

// Form gönderildiğinde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["user_mail"];
    $password = $_POST["user_password"];

    // SQL sorgusunu hazırla
    $sql = "SELECT * FROM user WHERE user_mail = '$email' AND user_password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Kullanıcı girişi başarılıysa, kullanıcıyı profil sayfasına yönlendir
        session_start(); // Oturumu başlat
        $user_id = $result->fetch_assoc()['user_id']; // Kullanıcı ID'sini al
        $_SESSION['user_id'] = $user_id; // Kullanıcı ID'sini oturuma kaydet
        // Kullanıcının son giriş zamanını güncel tarih ve saat bilgisi ile al
        $current_time = date("Y-m-d H:i:s");
        
        // Kullanıcının son giriş zamanını veritabanına güncellemek için SQL sorgusunu hazırla
        $update_sql = "UPDATE user SET user_open = '$current_time' WHERE user_id = '$user_id'";
        $conn->query($update_sql); // SQL sorgusunu çalıştır
        header("Location: index.php?user_id=$user_id"); // Ana sayfaya yönlendir
        exit;
    } else {
        // Kullanıcı bulunamazsa, hatalı giriş bildirimi yap
        $error_message = "Hatalı e-posta veya şifre.";
    }
}
// Veritabanı bağlantısını kapat
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

<!-- header -->
<header>
    <div class="container">
        <!-- nav -->
        <nav class="py-md-4 py-3 d-lg-flex">
            <div id="logo">
                <h1 class="mt-md-0 mt-2"> <a href="index.php"><span class="fa fa-map-signs"></span> MyGuide </a></h1>
            </div>
            <label for="drop" class="toggle"><span class="fa fa-bars"></span></label>
            <input type="checkbox" id="drop" />
            <ul class="menu ml-auto mt-1">
                <li class=""><a href="index.php">Ana Sayfa</a></li>
                <li class=""><a href="about.php">Hakkımızda</a></li>
                <li class=""><a href="services.php">Rehberlerimiz</a></li>
                <li class=""><a href="packages.php">Turlar</a></li>
                <li class="kayit"><a href="kayit.php">Kayıt Olun</a></li>
                <li class="giris"><a href="giris.php">Giriş Yap</a></li>
                <li class="kayit2"><a href="kayit2.php">Hizmet Ver</a></li>
            </ul>
        </nav>
        <!-- //nav -->
    </div>
</header>
<!-- //header -->

<!-- banner -->
<section class="banner_inner" id="home">
    <div class="banner_inner_overlay">
    </div>
</section>
<!-- //banner -->


<!-- Booking -->
<section class="contact py-5">
    <div class="container py-lg-5 py-sm-4">
        <h2 class="heading text-capitalize text-center mb-lg-5 mb-4"> Giriş Yapın</h2>
        <div class="contact-grids">
            <div class="row">
                <div class="col-lg-7 contact-left-form">
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                            <div class="col-sm-10 form-group contact-forms">
                                <span><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                <input type="email" class="form-control" name="user_mail" placeholder="E-mail" value="<?php if(isset($_POST['user_mail'])) echo $_POST['user_mail']; ?>" required="">
                            </div>
                            <div class="col-sm-10 form-group contact-forms">
                                <span><i class="fa fa-lock" aria-hidden="true"></i></span>
                                <input type="Password" class="form-control" name="user_password" placeholder="Şifre" required="">
                            </div>
                            <button class="btn btn-block sent-butnn" type="submit">Giriş Yap</button>
                            <?php if(!empty($error_message)): ?>
                                <div class="error"><?php echo $error_message; ?></div>
                            <?php endif; ?>
                            <?php if(!empty($success_message)): ?>
                                <div class="success"><?php echo $success_message; ?></div>
                            <?php endif; ?>
                        </form>
                        <p class="account"><a href="unut.php">Şifremi Unuttum.</a></p>
                </div>
                <div class="col-lg-5 contact-right pl-lg-5">
                
                    <div class="image-tour position-relative">
                        <img src="images/turkiyedeki-tarihi-mekanlar.jpg" alt="" class="img-fluid" />
                    </div>
                    

                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- //Booking -->


<!--footer -->
<footer>
<section class="footer footer_w3layouts_section_1its py-5">
    <div class="container py-lg-4 py-3">
        <div class="row footer-top">
            <div class="col-lg-3 col-sm-6 footer-grid_section_1its_w3">
                <div class="footer-title">
                    <h3>Address</h3>
                </div>
                <div class="footer-text">
                    <p>Location : Alsancak, Atatürk Cd. 270 A, 35220 Konak/İzmir</p>
                    <p>Phone : (0232) 463 25 25</p>
                    <p>Email : <a href="mailto:info@example.com">info@myguide.com</a></p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 footer-grid_section mt-sm-0 mt-4">
                <div class="footer-title">
                    <h3>About Us</h3>
                </div>
                <div class="footer-text">
                    <p>Lisanslı profesyonel rehberlerimiz ile hayalinizdeki tatile ulaşın. Rehberlerimiz ile birebir iletişim sağlayarak en uygun fiyatlı,kişisel isteklerinize uyarlayabileceğiniz gezilerinizi oluşturun Unutulmaz deneyim ve hatıralarınız oluşsun.</p>
                </div>
                <ul class="social_section_1info">
                    <li class="mb-2 facebook"><a href="#"><span class="fa fa-facebook"></span></a></li>
                    <li class="mb-2 twitter"><a href="#"><span class="fa fa-twitter"></span></a></li>
                    <li class="google"><a href="#"><span class="fa fa-google-plus"></span></a></li>
                    <li class="linkedin"><a href="#"><span class="fa fa-linkedin"></span></a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-sm-6 mt-lg-0 mt-4 footer-grid_section_1its_w3">
                <div class="footer-title">
                    <h3>Newsletter</h3>
                </div>
                <div class="footer-text">
                    <p>Posta listemize abone olarak bizden her zaman en son haberlere ve güncellemelere ulaşabilirsiniz.</p>
                    <form action="#" method="post">
                        <input type="email" name="Email" placeholder="Enter your email..." required="">
                        <button class="btn1"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                        <div class="clearfix"> </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</footer>
<!-- //footer -->


<!-- move top -->
<div class="move-top text-right">
    <a href="#home" class="move-top"> 
        <span class="fa fa-angle-up  mb-3" aria-hidden="true"></span>
    </a>
</div>
<!-- move top -->

    
</body>
</html>
