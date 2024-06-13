<?php include "header.php";
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


<!-- Contact -->
<section class="contact py-5">
	<div class="container py-lg-5 py-sm-3">
			<h2 class="heading text-capitalize text-center mb-sm-5 mb-4"> Bizimle İletişime Geçin</h2>
			<ul class="list-unstyled row text-center mt-lg-5 mt-4 px-lg-5">
                <li class="col-md-4 col-sm-6 adress-w3pvt-info">
                    <div class=" adress-icon">
                        <span class="fa fa-map-marker"></span>
                    </div>

                    <h6>Lokasyon</h6>
                    <p>MyGuide
                        <br> Alsancak, Atatürk Cd. 270 A, 35220 Konak/İzmir </p>
                </li>

                <li class="col-md-4 col-sm-6 adress-w3pvt-info mt-sm-0 mt-4">
                    <div class="adress-icon">
                        <span class="fa fa-envelope-open-o"></span>
                    </div>
                    <h6>Telefon & Email</h6>
                    <p>(0232) 463 25 25</p>
                    <a href="mailto:info@example.com" class="mail">info@myguide.com</a>
                </li>
                <li class="col-md-4 col-sm-6 adress-w3pvt-info mt-md-0 mt-4">

                    <div class="adress-icon">
                        <span class="fa fa-comments-o"></span>
                    </div>

                    <h6>Bizi Takip Edin</h6>
					<ul class="social_section_1info mt-2">
						<li class="mb-2 facebook"><a href="#"><span class="fa fa-facebook"></span></a></li>
						<li class="mb-2 twitter"><a href="#"><span class="fa fa-twitter"></span></a></li>
						<li class="google"><a href="#"><span class="fa fa-google-plus"></span></a></li>
						<li class="linkedin"><a href="#"><span class="fa fa-linkedin"></span></a></li>
					</ul>
                </li>
            </ul>
			
			<div class="contact-grids mt-5">
				<div class="row">
					<div class="col-lg-6 col-md-6 contact-left-form">
						<form action="#" method="post">
							<div class=" form-group contact-forms">
							  <input type="text" class="form-control" placeholder="Ad soyad" required="">
							</div>
							<div class="form-group contact-forms">
							  <input type="email" class="form-control" placeholder="Email" required="">
							</div>
							<div class="form-group contact-forms">
							  <input type="text" class="form-control" placeholder="Telefon" required=""> 
							</div>
							<div class="form-group contact-forms">
							  <textarea class="form-control" placeholder="Mesaj" rows="3" required=""></textarea>
							</div>
							<button class="btn btn-block sent-butnn">Gönder</button>
						</form>
					</div>
					<div class="col-lg-6 col-md-6 contact-right pl-lg-5">
						<h4>Bizimle ilgili herhangi bir sorunuz var mı? Bize Yazın. </h4>
						<p class="mt-md-4 mt-2">Sana En Uygun Teklifi Seç
							Hizmet verenlere sorularını sor, gerçek müşteri referanslarını incele. Sana en uygun teklifi MyGuide Garantisi ile seç!</p>
						<h5 class="mt-lg-5 mt-3">Çalışma Saatleri</h5>
						<p class="mt-3">Pazartesi - Cuma : 09:00 / 18:00 </p>
						<p>Cumartesi - Pazar : 10:00 / 16:00 </p>
					</div>
				</div>
			</div>
	</div>
</section>
<!-- //Contact -->

<!-- map -->	
<div class="map p-2">
	<iframe src="https://www.google.com/maps/d/u/0/embed?mid=1Nki80AImFPYWqMmvWegXgZCWLkU0Z_Q&ehbc=2E312F&noprof=1" width="640" height="480"></iframe>
</div>
<!-- //map -->




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