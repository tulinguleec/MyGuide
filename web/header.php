<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "baglanti.php";
include "rehber_kontrol.php";

// Oturumdaki kullanıcı rehber mi kontrolü
$isGuide = false;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    // Rehber tablosunda user_id'yi kontrol et
    $query = $conn->prepare("SELECT * FROM rehber WHERE user_id = ?");
    $query->bind_param("i", $user_id); // user_id'nin integer olduğundan emin olun
    $query->execute();
    $result = $query->get_result();
    $guide = $result->fetch_assoc();

    if ($guide) {
        $isGuide = true;
    }
}
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
    
    <link href="css/css_slider.css" type="text/css" rel="stylesheet" media="all">

    <!-- google fonts -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- //google fonts -->
    
</head>
<body>

<!-- header -->
<header class="header-bg">
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
                <li class=""><a href="services.php">Turlar</a></li>
                <li class=""><a href="packages.php">Rehberlerimiz</a></li>
                
                <?php if(isset($_SESSION['user_id'])): ?>
                    <?php
                    // Kullanıcı bilgilerini çekmek için SQL sorgusu hazırla
                    $user_id = $_SESSION['user_id'];
                    $stmt = $conn->prepare("SELECT user_ad, user_soyad FROM user WHERE user_id = ?");
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result && $result->num_rows > 0) {
                        // Kullanıcı bilgilerini al
                        $row = $result->fetch_assoc();
                        $user_ad = $row['user_ad'];
                        $user_soyad = $row['user_soyad'];
                    } else {
                        // Kullanıcı bulunamazsa varsayılan değerler kullan
                        $user_ad = "Profilim";
                        $user_soyad = "";
                    }
                    ?>
                    <li class="kayit">
                        <a href="<?php echo $isGuide ? 'rehber_profil.php' : 'user_profil.php'; ?>">
                            <?php echo htmlspecialchars($user_ad . " " . $user_soyad); ?>
                        </a>
                    </li>
                    <li class="giris"><a href="cikis.php">Çıkış Yap</a></li>
                    <li class="kayit2"><a href="kayit2.php">Hizmet Ver</a></li>
                <?php else: ?>
                    <li class="kayit"><a href="kayit.php">Kayıt olun</a></li>
                    <li class="giris"><a href="giris.php">Giriş Yap</a></li>
                    <li class="kayit2"><a href="kayit2.php">Hizmet Ver</a></li>
                <?php endif; ?>
            </ul>

        </nav>
        <!-- //nav -->
    </div>
</header>
</body>
</html>
