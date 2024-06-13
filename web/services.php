<?php
include "header.php";
include "baglanti.php"; 

$user_id = $_SESSION['user_id'];


if(isset($_POST['selectedCity'])) {
    $selectedCityId = $_POST['selectedCity'];
    // Seçilen ile göre rehberleri getir
    $sql = "SELECT user.user_ad,user.user_soyad,tur.tur_id,tur.tur_ad,tur.tur_fiyat,tur.tur_saat,tur.tur_tarih,il.il_ad,diller.dil_ad,tur.tur_gorsel,tur.tur_aciklama
	FROM rehber,il,diller,tur,user
	WHERE diller.dil_id=rehber.dil_id
	AND rehber.rehber_id=tur.rehber_id
	AND tur.il_id=il.il_id
	AND user.user_id=rehber.user_id
	AND il.il_id=$selectedCityId
	ORDER BY tur.tur_id DESC";
} else {
    // Tüm rehberleri getir
	$sql = "SELECT user.user_ad,user.user_soyad,tur.tur_id,tur.tur_ad,tur.tur_fiyat,tur.tur_saat,tur.tur_tarih,il.il_ad,diller.dil_ad,tur.tur_gorsel,tur.tur_aciklama
	FROM rehber,il,diller,tur,user
	WHERE diller.dil_id=rehber.dil_id
	AND rehber.rehber_id=tur.rehber_id
	AND tur.il_id=il.il_id
    AND user.user_id=rehber.user_id
	ORDER BY tur.tur_id DESC";
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
        <h2 class="heading text-capitalize text-center"> Turlarımızı Keşfedin</h2>
        <p class="text mt-2 mb-5 text-center"></p>
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
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
								<a href="#" class="btn btn-primary btn-lg kayitOlButonlari" data-tur-id="<?php echo $row["tur_id"]; ?>" data-user-id="<?php echo $user_id; ?>">Kayıt Ol</a>
    </div>
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

<!-- services -->
<section class="services pt-5">
	<div class="container py-lg-5 py-sm-3">
		<h2 class="heading text-capitalize text-center mb-lg-5 mb-4"> Sizlere Sağladıklarımız</h2>
		<div class="row">
			<div class="col-lg-3 main-title-text">
				<h4 class="my-lg-4 mb-4">Binlerce kilometrelik yolculuk tek bir adımla başlar.</h4>
				<img src="images/bodrum-merkezi.jpg" alt="" class="img-fluid" />
			</div>
			<div class="col-lg-9 mt-lg-0 mt-5">
				<div class="row">
					<div class="col-lg-4 col-md-6 col-sm-6 service-grid-wthree text-center mb-5">
						<div class="ser-fashion-grid">
							<div class="about-icon mb-md-4 mb-3">
								<span class="fa fa-building" aria-hidden="true"></span>
							</div>
							<div class="ser-sevice-grid">
							  <h4 class="pb-3">Güvenilir Hizmet</h4>
							  <p>Lisanslı profesyonel rehberlerle tur imkanı</p>
							</div>
					  </div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-6 service-grid-wthree text-center mb-5">
						<div class="ser-fashion-grid">
							<div class="about-icon mb-md-4 mb-3">
								<span class="fa fa-free-code-camp" aria-hidden="true"></span>
							</div>
							<div class="ser-sevice-grid">
								<h4 class="pb-3">7/24 İletişim</h4>
							  <p>İstediğiniz her saatte tatilinizi planlamaya başlayın</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-6 service-grid-wthree text-center mb-5">
						<div class="ser-fashion-grid">
							<div class="about-icon mb-md-4 mb-3">
								<span class="fa fa-users" aria-hidden="true"></span>
							</div>
							<div class="ser-sevice-grid">
								<h4 class="pb-3">Kalabalıktan Uzak</h4>
							  <p>Kendi oluşturacağınız tur grubunuzla özel gezi ve tatiller planlayın.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-6 service-grid-wthree text-center mb-5">
						<div class="ser-fashion-grid">
							<div class="about-icon mb-md-4 mb-3">
								<span class="fa fa-money" aria-hidden="true"></span>
							</div>
							<div class="ser-sevice-grid">
								<h4 class="pb-3">Uygun Fiyatlar</h4>
							  <p>Rehberlerle birebir iletişim sayesinde daha uygun fiyatlar</p>
							</div>
					  </div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-6 service-grid-wthree text-center mb-5">
						<div class="ser-fashion-grid">
							<div class="about-icon mb-md-4 mb-3">
								<span class="fa fa-binoculars" aria-hidden="true"></span>
							</div>
							<div class="ser-sevice-grid">
								<h4 class="pb-3">Kullanıcı Değerlendirmeleri</h4>
							  <p>Deneyim ve yorumlarınız ile yeni kullanıcılara örnek olun</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-6 service-grid-wthree text-center mb-5">
						<div class="ser-fashion-grid">
							<div class="about-icon mb-md-4 mb-3">
								<span class="fa fa-camera" aria-hidden="true"></span>
							</div>
							<div class="ser-sevice-grid">
								<h4 class="pb-3">Kolay Rezervasyon</h4>
							  <p>Tatilinizde gezeceğiniz lokasyonları düşünmek zorunda kalmadan gezinizin tadını çıkarın</p>
							</div>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- //services -->


<!-- places -->
<section class="trav-grids py-5" id="desti">
	<div class="container py-xl-5 py-lg-3">
		<h3 class="heading text-capitalize text-center mb-lg-5 mb-4">Popüler Lokasyonlar</h3>
		<div class="row">
			<div class="col-lg-6 mt-4">
				<div class="grids-tem-one">
					<div class="row">
						<div class="col-sm-5 grids-img-left">
							<img src="images/HD-wallpaper-istanbul-sunset-sunet.jpg" alt="" class="img-fluid">
						</div>
						<div class="col-sm-7 right-cont">
							<h4 class="mb-2 let mt-sm-0 mt-2 tm-clr">İstanbul</h4>
							<ul class="d-flex">
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
							</ul>
							<p class="mt-3">İstanbul, Türkiye'de Marmara Bölgesi'nde yer alan ve İstanbul ilinin merkezi olan şehirdir. Ekonomik, tarihî ve sosyo-kültürel açıdan önde gelen şehirlerden biridir. Şehir, iktisadi büyüklük açısından dünyada 34. sırada yer alır.</p>
							<p class="duration mt-2"><span class="fa fa-clock-o mr-2"></span><strong>Duration</strong> : 2 Days, 3hrs</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 mt-4">
				<div class="grids-tem-one">
					<div class="row">
						<div class="col-sm-5 grids-img-left">
							<img src="images/free-photo-of-aerial-view-of-the-butterfly-valley-fethiye-mugla-turkey.jpg" alt="" class="img-fluid">
						</div>
						<div class="col-sm-7 right-cont">
							<h4 class="mb-2 let mt-sm-0 mt-2 tm-clr">Nevşehir/Kapadokya</h4>
							<ul class="d-flex">
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
							</ul>
							<p class="mt-3">Kapadokya, 60 milyon yıl önce Erciyes, Hasandağı ve Göllüdağ’ın püskürttüğü lav ve küllerin oluşturduğu yumuşak tabakaların milyonlarca yıl boyunca yağmur ve rüzgâr tarafından aşındırılmasıyla ortaya çıkan bölgedir.</p>
							<p class="duration mt-2"><span class="fa fa-clock-o mr-2"></span><strong>Duration</strong> : 2 Days, 3hrs</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row pt-lg-3">
			<div class="col-lg-6 mt-4">
				<div class="grids-tem-one">
					<div class="row">
						<div class="col-sm-5 grids-img-left">
							<img src="images/kapadokya3.jpg" alt="" class="img-fluid">
						</div>
						<div class="col-sm-7 right-cont">
							<h4 class="mb-2 let mt-sm-0 mt-2 tm-clr">Muğla/Bodrum</h4>
							<ul class="d-flex">
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
							</ul>
							<p class="mt-3">Bodrum, Muğla'nın 13 ilçesinden birisidir. İlçe günümüzde önemli bir turizm merkezi olması ile anılmaktadır ki bunda Bodrum'un kendine has bazı özellikleri olması etkilidir. Bodrum sadece Türkiye'de değil, dünyada da turizm açısından bilinen bir ilçedir.</p>
							<p class="duration mt-2"><span class="fa fa-clock-o mr-2"></span><strong>Duration</strong> : 2 Days, 3hrs</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 mt-4">
				<div class="grids-tem-one">
					<div class="row">
						<div class="col-sm-5 grids-img-left">
							<img src="images/mardin-turkey.jpg" alt="" class="img-fluid">
						</div>
						<div class="col-sm-7 right-cont">
							<h4 class="mb-2 mt-sm-0 mt-2 let tm-clr">Mardin</h4>
							<ul class="d-flex">
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
							</ul>
							<p class="mt-3">Mardin, Türkiye'nin Mardin ilinin merkezi olan şehirdir. Şehirde uluslararası kuruluşlarca kültür mirası kabul edilmiş, koruma altına alınmış tarihi yapılar mevcuttur.</p>
							<p class="duration mt-2"><span class="fa fa-clock-o mr-2"></span><strong>Duration</strong> : 2 Days, 3hrs</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- //places -->


<!-- move top -->
<div class="move-top text-right">
	<a href="#home" class="move-top"> 
		<span class="fa fa-angle-up  mb-3" aria-hidden="true"></span>
	</a>
</div>
<!-- move top -->
<?php include "footer.php"; ?>
<script>
// Tüm kayıt ol butonlarını seçin
var kayitOlButonlari = document.querySelectorAll('.btn.btn-primary.btn-lg.kayitOlButonlari');

// Her bir kayıt ol butonuna tıklanıldığında çalışacak fonksiyonu tanımlayın
kayitOlButonlari.forEach(function(button) {
    button.addEventListener("click", function(event) {
        // Tarayıcıda varsayılan işlemi engelle (formun gönderilmesini durdur)
        event.preventDefault();

        // Kullanıcıya onay için bir uyarı göster
        var onay = confirm("Rezervasyonu onaylıyor musunuz?");
        
        // Kullanıcı onayladıysa, AJAX isteği gönder
        if (onay) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "rez_ekle.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Başarılı bir şekilde eklendiğinde kullanıcıya bilgi ver
                    alert(xhr.responseText);
                }
            };
            // Gönderilecek veri (tur_id'yi ve user_id'yi ilgili ilana göre alın)
            var tur_id = this.getAttribute("data-tur-id");
            var user_id = this.getAttribute("data-user-id");
            var data = "tur_id=" + tur_id + "&user_id=" + user_id;
            xhr.send(data);
        }
    });
});
</script>
</body>
</html>