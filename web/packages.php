<?php
include "header.php";
include "baglanti.php"; 

// İl seçilmiş mi kontrol et
if(isset($_POST['selectedCity'])) {
    $selectedCityId = $_POST['selectedCity'];
    // Seçilen ile göre rehberleri getir
    $sql = "SELECT user.user_id,user.user_ad,user.user_soyad,user.user_tel,user.user_mail,user.dogum_yil,rehber.rehber_id,rehber.aciklama,rehber.ucret,rehber.gorsel,il.il_ad,il.il_id,cinsiyet.cinsiyet_ad,diller.dil_ad
	FROM rehber,il,user,diller,cinsiyet
	WHERE rehber.il_id=il.il_id
	AND user.user_id=rehber.user_id
	AND user.cinsiyet_id=cinsiyet.cinsiyet_id
	AND rehber.dil_id=diller.dil_id
	AND il.il_id=$selectedCityId
	ORDER BY rehber.rehber_id DESC";
} else {
    // Tüm rehberleri getir
    $sql = "SELECT user.user_id,user.user_ad,user.user_soyad,user.user_tel,user.user_mail,user.dogum_yil,rehber.rehber_id,rehber.aciklama,rehber.ucret,rehber.gorsel,il.il_ad,il.il_id,cinsiyet.cinsiyet_ad,diller.dil_ad
	FROM rehber,il,user,diller,cinsiyet
	WHERE rehber.il_id=il.il_id
	AND user.user_id=rehber.user_id
	AND user.cinsiyet_id=cinsiyet.cinsiyet_id
	AND rehber.dil_id=diller.dil_id
	ORDER BY rehber.rehber_id DESC";
}


$result = $conn->query($sql);
$sql2 = "SELECT * FROM il";
$result2 = $conn->query($sql2);
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

<!-- tour packages -->
<section class="packages pt-5">
    <div class="search-container">
        <form method="POST" action="">
            <select name="selectedCity" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <option value="" selected disabled>İl Seçin</option>
                <?php
                if ($result2->num_rows > 0) {
                    while($row = $result2->fetch_assoc()) {
                        echo '<option value="'.$row["il_id"].'">'.$row["il_ad"].'</option>';
                    }
                }
                ?>
            </select>
            <button type="submit" class="btn btn-primary">Seç</button> <!-- Formu göndermek için buton eklendi -->
        </form>
    </div>

    <div class="container py-lg-4 py-sm-3">
        <h2 class="heading text-capitalize text-center"> Rehberlerimizi Keşfedin</h2>
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
                echo "0 sonuç";
            }
            ?>
        </div>
    </div>
</section>
<!-- tour packages -->

<!-- text -->
<section class="text-content">
	<div class="overlay-inner py-5">
		<div class="container py-md-3">
			<div class="test-info">
				<h4 class="tittle">Kendi Turlarınızı Oluşturun!</h4>
				<p class="mt-3">Siz de acentelerden bıkmış bir tur Rehberi iseniz aramıza katılın! Rehberlerimizden biri olun. Kendi turlarınızı oluşturun ve müşterileriniz size ulaşşın.
					Konum, tarih ve saat bilgisi ekleyin ve kendi turunuzu oluşturmuş olun. Geriye sadece eğlenmek kalsın!
				</p>
				<div class="text-left mt-4">
						<a href="deneme.php">Tur İlanı Ekle</a>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
    document.getElementById('createTourButton').addEventListener('click', function(event) {
        var rehberId = <?php echo json_encode($_SESSION['rehber_id']); ?>;
        if (!rehberId) {
            event.preventDefault();
            alert('Rehber kaydınız bulunmuyorsa tur ilanı açamazsınız');
        }
    });
</script>
<!-- //text -->

<section class="destinations py-5" id="destinations">
	<div class="container py-xl-5 py-lg-3">
	<h3 class="heading text-capitalize text-center"> Popüler Lokasyonlar</h3> 
		<p class="text mt-2 mb-5 text-center"></p>
		<div class="row inner-sec-w3layouts-w3pvt-lauinfo">
			<div class="col-md-3 col-sm-6 col-6 destinations-grids text-center">
				<h4 class="destination mb-3">İstanbul</h4>
				<div class="image-position position-relative">
					<img src="images/HD-wallpaper-istanbul-sunset-sunet.jpg" class="img-fluid" alt="">
					<div class="rating">
						<ul>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
						</ul>
					</div>
				</div>
				<div class="destinations-info">
					<div class="caption mb-lg-3">
						<h4>İstanbul</h4>
						<a href="services.php">Şimdi İnceleyin</a>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-6 destinations-grids text-center">
				<h4 class="destination mb-3">Kapadokya</h4>
				<div class="image-position position-absolute">
					<img src="images/kapadokya3.jpg" class="img-fluid" alt="">
					<div class="rating">
						<ul>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
						</ul>
					</div>
				</div>
				<div class="destinations-info">
					<div class="caption mb-lg-3">
						<h4>Kapadokya</h4>
						<a href="services.php">Şimdi İnceleyin</a>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-6 destinations-grids text-center mt-md-0 mt-4">
				<h4 class="destination mb-3">Muğla</h4>
				<div class="image-position position-absolute">
					<img src="images/free-photo-of-aerial-view-of-the-butterfly-valley-fethiye-mugla-turkey.jpg" class="img-fluid" alt="">
					<div class="rating">
						<ul>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
						</ul>
					</div>
				</div>
				<div class="destinations-info">
					<div class="caption mb-lg-3">
						<h4>Muğla</h4>
						<a href="services.php">Şimdi İnceleyin</a>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-6 destinations-grids text-center mt-md-0 mt-4">
				<h4 class="destination mb-3">Mardin</h4>
				<div class="image-position position-relative">
					<img src="images/mardin-turkey.jpg" class="img-fluid" alt="">
					<div class="rating">
						<ul>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
						</ul>
				</div>
				<div class="destinations-info">
					<div class="caption mb-lg-3">
						<h4>Mardin</h4>
						<a href="services.php">Şimdi İnceleyin</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

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
