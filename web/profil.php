<?php 
include 'header.php';
include "baglanti.php";

$rehber_id = isset($_GET['rehber_id']) ? mysqli_real_escape_string($conn, $_GET['rehber_id']) : null;

$sql = "SELECT user.user_id,user.user_ad,user.user_soyad,user.user_tel,user.user_mail,user.dogum_yil,rehber.rehber_id,rehber.aciklama,rehber.ucret,rehber.gorsel,il.il_ad,il.il_id,cinsiyet.cinsiyet_ad,diller.dil_ad
    FROM rehber,il,user,diller,cinsiyet
    WHERE rehber.il_id=il.il_id
    AND user.user_id=rehber.user_id
    AND user.cinsiyet_id=cinsiyet.cinsiyet_id
    AND rehber.dil_id=diller.dil_id
    AND rehber.rehber_id=$rehber_id";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MyGuide - Profil</title>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' /><!-- bootstrap css -->
    <link href="css/style.css" rel='stylesheet' type='text/css' /><!-- custom css -->
    <link href="css/font-awesome.min.css" rel="stylesheet"><!-- fontawesome css -->
</head>
<body>
<section class="banner_inner" id="home">
    <div class="banner_inner_overlay">
    </div>
</section>

<?php 
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $imageNames = explode(",", $row["gorsel"]);
        foreach ($imageNames as $imageName) {
            $imagePath = "http://localhost/web/resim/" . trim($imageName);
?>
    <div class="container py-lg-4 py-md-3 py-2">
        <div class="inner mb-4">
            <ul class="blog-single-author-date align-items-center">
                <li>
                    <div class="listing-category"><span>Profil Detayları</span></div>
                </li>
            </ul>
        </div>
        <div class="post-content">
            <h2 class="title-single"><?php echo $row["user_ad"]."|".$row["user_soyad"] ?></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 w3l-news">
            <div class="blog-single-post">
                <div class="single-post-image mb-5">
                    <div class="owl-blog owl-carousel owl-theme">
                        <div class="item">
                            <div class="card">
                                <img class="img-fluid" src="<?php echo $imagePath; ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-post-content">
                    <div class="single-bg-white">
                        <h3 class="post-content-title mb-4">Rehber Detayları</h3>
                        <ul class="details-list">
                            <li><strong>Rehber Adı:</strong> <?php echo $row["user_ad"];?></li>
                            <li><strong>Rehber Soyadı:</strong> <?php echo $row["user_soyad"];?></li>
                            <li><strong>İletişim Numarası:</strong> <?php echo $row["user_tel"];?></li>
                            <li><strong>E-mail:</strong> <?php echo $row["user_mail"];?></li>
                            <li><strong>Cinsiyet:</strong> <?php echo $row["cinsiyet_ad"];?></li>
                            <li><strong>Şehir:</strong> <?php echo $row["il_ad"];?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="sidebar-side col-lg-4 col-md-12 col-sm-12 mt-lg-0 mt-5">
            <aside class="sidebar">
                <!-- Favoriye ekle butonu -->
                <form id="favori_form" action="favori_ekle.php" method="post">
    <input type="hidden" name="rehber_id" value="<?php echo $rehber_id; ?>">
    <button type="button" id="favori_button" class="btn btn-primary btn-block mb-4">Favoriye Ekle</button>
</form>


                <!-- Diğer sidebar içeriği -->
                <div class="sidebar-widget popular-posts">
                    <div class="sidebar-title">
                        <h4 class="my-heading">Rehberinizi Daha İyi Tanıyın</h4>
                    </div>
                    <?php
                    // İlanı dışındaki son üç ilanı almak için yeni bir SQL sorgusu oluşturuyoruz
                    
                    $sidebar_sql = "SELECT aciklama FROM rehber
                    where rehber.rehber_id=$rehber_id";
                    $sidebar_result = $conn->query($sidebar_sql);
                    
                    if ($sidebar_result->num_rows > 0) {
                        while ($sidebar_row = $sidebar_result->fetch_assoc()) {
                            // Her bir açıklama için işlenecek kod
                            $aciklama = $sidebar_row["aciklama"];
                            echo "<p>$aciklama</p>";
                        }
                    } else {
                        echo "0 sonuç";
                    }
                    ?>
                </div>
                <div class="sidebar-widget popular-posts">
                    <div class="sidebar-title">
                        <h4>Yeni Rehberler</h4>
                    </div>
                    <?php
                    // İlanı dışındaki son üç ilanı almak için yeni bir SQL sorgusu oluşturuyoruz
                    $sidebar_sql = "SELECT rehber_id, user_ad, user_soyad, gorsel,il_ad
                                    FROM rehber,il,user
                                    WHERE rehber_id != '$rehber_id'
                                    AND rehber.user_id=user.user_id
                                    AND il.il_id=rehber.il_id
                                    ORDER BY rehber_id DESC
                                    LIMIT 3";
                    $sidebar_result = $conn->query($sidebar_sql);

                    if ($sidebar_result->num_rows > 0) {
                        while ($sidebar_row = $sidebar_result->fetch_assoc()) {
                            // Her bir ilan için resim yolu oluşturuyoruz
                            $sidebar_imagePath = "http://localhost/web/resim/" . $sidebar_row["gorsel"];
                    ?>
                        <article class="post">
                            <figure class="post-thumb"><img src="<?php echo $sidebar_imagePath; ?>" class="radius-image" alt=""></figure>
                            <div class="text"><a href="profil.php?rehber_id=<?php echo $sidebar_row["rehber_id"] ?>"><div class="post-info"><?php echo $sidebar_row["user_ad"]." ".$sidebar_row["user_soyad"]?></div></a></div>
                        </article>
                    <?php 
                        }
                    } else {
                        echo "0 sonuç";
                    }
                    ?>
                </div>
            </aside>
        </div>
       
    </div>
</div>
<?php 
        }
    }
} else {
    echo "0 sonuç";
}
?>
</section>

<?php include 'footer.php'; ?>
<button onclick="topFunction()" id="movetop" title="Go to top">&#10548;</button>
<script>
    // Sayfa yüklendiğinde ve kaydırıldığında tetiklenecek fonksiyonlar
    window.onscroll = function() {
        scrollFunction();
    };

    // Sayfa yukarı kaydırıldığında veya aşağı kaydırıldığında tetiklenecek fonksiyon
    function scrollFunction() {
        // Ekranın üst kısmından 20 piksel veya daha fazla aşağı kaydırıldığında
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            // "movetop" elementini göster
            document.getElementById("movetop").style.display = "block";
        } else {
            // Aksi takdirde "movetop" elementini gizle
            document.getElementById("movetop").style.display = "none";
        }
    }

    // Sayfayı yukarı kaydırmak için bir fonksiyon
    function topFunction() {
        // Body elementinin scrollTop özelliğini 0 yaparak sayfayı en üstüne kaydır
        document.body.scrollTop = 0;
        // HTML elementinin scrollTop özelliğini 0 yaparak sayfayı en üstüne kaydır
        document.documentElement.scrollTop = 0;
    }

    // Favori ekle butonuna tıklama olayı
    document.getElementById("favori_button").addEventListener("click", function() {
        // Form verilerini al
        var form = document.getElementById("favori_form");
        var formData = new FormData(form);

        // Favori ekleme isteğini gönder
        fetch('favori_ekle.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Favori ekleme başarısız');
            }
            return response.json();
        })
        .then(data => {
            // Favori eklendiğine dair bildirim göster
            alert('Favoriye eklendi');
        })
        .catch(error => {
            console.error('Hata:', error);
        });
    });
</script>

<!-- /move top -->

<!-- jQuery and Bootstrap JS -->
<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/theme-change.js"></script> <!-- theme switch js (light and dark)-->
<!-- stats number counter-->
<script src="assets/js/jquery.waypoints.min.js"></script>
<script src="assets/js/jquery.countup.js"></script>
<script>
    $('.counter').countUp();
</script>
<!-- //stats number counter -->
<!-- owlcarousel -->
<script src="assets/js/owl.carousel.js"></script>
<!-- script for blog post slider -->
<script>
    $(document).ready(function () {
        $('.owl-blog').owlCarousel({
            loop: true,
            margin: 30,
            nav: false,
            responsiveClass: true,
            autoplay: false,
            autoplayTimeout: 5000,
            autoplaySpeed: 1000,
            autoplayHoverPause: false,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                480: {
                    items: 1,
                    nav: true
                },
                700: {
                    items: 1,
                    nav: true
                },
                1090: {
                    items: 1,
                    nav: true
                }
            }
        })
    })
</script>
<!-- //script for blog post slider -->
<!-- script for tesimonials carousel slider -->
<script>
    $(document).ready(function () {
        $("#owl-demo1").owlCarousel({
            loop: true,
            nav: false,
            margin: 50,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                736: {
                    items: 1,
                    nav: false
                }
            }
        })
    })
</script>
<!-- //script for tesimonials carousel slider -->
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script>
    $(document).ready(function () {
        $('.popup-with-zoom-anim').magnificPopup({
            type: 'inline',
            fixedContentPos: false,
            fixedBgPos: true,
            overflowY: 'auto',
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300,
            mainClass: 'my-mfp-zoom-in'
        });

        $('.popup-with-move-anim').magnificPopup({
            type: 'inline',
            fixedContentPos: false,
            fixedBgPos: true,
            overflowY: 'auto',
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300,
            mainClass: 'my-mfp-slide-bottom'
        });
    });
</script>
<!-- disable body scroll which navbar is in active -->
<script>
    $(function () {
        $('.navbar-toggler').click(function () {
            $('body').toggleClass('noscroll');
        })
    });
</script>
<!-- MENU-JS -->
<script>
    $(window).on("scroll", function () {
        var scroll = $(window).scrollTop();
        if (scroll >= 80) {
            $("#site-header").addClass("nav-fixed");
        } else {
            $("#site-header").removeClass("nav-fixed");
        }
    });

    $(".navbar-toggler").on("click", function () {
        $("header").toggleClass("active");
    });
    $(document).on("ready", function () {
        if ($(window).width() > 991) {
            $("header").removeClass("active");
        }
        $(window).on("resize", function () {
            if ($(window).width() > 991) {
                $("header").removeClass("active");
            }
        });
    });
</script>
<!-- //MENU-JS -->
<!-- bootstrap -->
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
