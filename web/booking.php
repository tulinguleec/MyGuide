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


<!-- Booking -->
<section class="contact py-5">
	<div class="container py-lg-5 py-sm-4">
		<h2 class="heading text-capitalize text-center mb-lg-5 mb-4"> Kaydınızı oluşturun</h2>
		<div class="contact-grids">
			<div class="row">
				<div class="col-lg-7 contact-left-form">
					<form action="#" method="post" class="row">
						<div class="col-sm-6 form-group contact-forms">
						  <input type="text" class="form-control" placeholder="Ad Soyad" required="">
						</div>
						<div class="col-sm-6 form-group contact-forms">
						  <input type="email" class="form-control" placeholder="Email" required="">
						</div>
						<div class="col-sm-6 form-group contact-forms">
						  <input type="text" class="form-control" placeholder="Telefon" required=""> 
						</div>
						<div class="col-sm-6 form-group contact-forms">
						  <input type="text" class="form-control" placeholder="Doğum Tarihi" required=""> 
						</div>
						<div class="col-sm-6 form-group contact-forms">
							<select class="form-control" id="yetiskin">
								<option>Yetişkin</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5 ya da daha fazla</option>
							</select>
						</div>
						<div class="col-sm-6 form-group contact-forms">
							<select class="form-control" id="cocuk">
								<option>Çocuk</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5 ya da daha fazla</option>
							</select>
						</div>
						<div class="col-md-12 form-group contact-forms">
						  <textarea class="form-control" placeholder="Mesaj" rows="3" required=""></textarea>
						</div>
						<div class="col-md-12 booking-button">
							<button class="btn btn-block sent-butnn">kayıt ol</button>
						</div>
					</form>
				</div>
				<div class="col-lg-5 contact-right pl-lg-5">
				
					<div class="image-tour position-relative">
						<img src="images/turkiyedeki-tarihi-mekanlar.jpg" alt="" class="img-fluid" />
						<p><span class="fa fa-tags"></span> <span>20$ - 15% off</span></p>
					</div>
					
					<h4>Turlarımızı Keşfedin!</h4>
					<p class="mt-3">Türkiye'nin her bir yanından rehberlerimiz ile kendinize uygun turlarınızı oluşturun. Şehrinizi ve rehberinizi seçin, en uygun fiyatlı şekilde gezmiş olun.</p>
					
				</div>
			</div>
		</div>
	</div>
</section>
<!-- //Booking -->

<?php 
include "footer.php"; ?>


<!-- move top -->
<div class="move-top text-right">
	<a href="#home" class="move-top"> 
		<span class="fa fa-angle-up  mb-3" aria-hidden="true"></span>
	</a>
</div>
<!-- move top -->

	
</body>
</html>