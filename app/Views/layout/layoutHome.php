<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Pet Netto</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="icon" type="image/png" href="<?= base_url("assets/images/petnetto_icone.png") ?>" />

		<link
			href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap"
			rel="stylesheet">

		<link rel="stylesheet"
			href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

		<link rel="stylesheet" href="<?= base_url("assets/css/animate.css") ?>">

		<link rel="stylesheet" href="<?= base_url("assets/css/owl.carousel.min.css") ?>">
		<link rel="stylesheet" href="<?= base_url("assets/css/owl.theme.default.min.css") ?>">
		<link rel="stylesheet" href="<?= base_url("assets/css/magnific-popup.css") ?>">

		<link rel="stylesheet" href="<?= base_url("assets/css/bootstrap-datepicker.css") ?>">
		<link rel="stylesheet" href="<?= base_url("assets/css/jquery.timepicker.css") ?>">

		<link rel="stylesheet" href="<?= base_url("assets/css/flaticon.css") ?>">
		<link rel="stylesheet" href="<?= base_url("assets/css/style.css") ?>">
	</head>
	<body>
		<div class="wrap">
			<div class="container">
				<div class="row">
					<div class="col-md-6 d-flex align-items-center">
						<p class="mb-0 phone pl-md-2">
							<a href="#" class="mr-2"><span class="fa fa-phone mr-1"></span> +55 32 3729-1234</a>
							<a href="#"><span class="fa fa-paper-plane mr-1"></span>
								petnetto@gmail.com</a>
						</p>
					</div>
					<div class="col-md-6 d-flex justify-content-md-end">
						<div class="social-media">
							<p class="mb-0 d-flex">
								<a href="#"
									class="d-flex align-items-center justify-content-center"><span
										class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
								<a href="#"
									class="d-flex align-items-center justify-content-center"><span
										class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
								<a href="#"
									class="d-flex align-items-center justify-content-center"><span
										class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<nav
			class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
			<div class="container">
				<a class="navbar-brand" href="index.php">
					<span class="flaticon-pawprint-1 mr-2"></span>Pet Netto</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse"
					data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false"
					aria-label="Toggle navigation">
					<span class="fa fa-bars"></span> Menu
				</button>
				<div class="collapse navbar-collapse" id="ftco-nav">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item <?= (getPagina() == 'home' ? 'active' : '') ?>"><a href="<?= base_url() ?>" class="nav-link">Home</a></li>
						<li class="nav-item <?= (getPagina() == 'sobrenos' ? 'active' : '') ?>"><a href="<?= base_url() ?>sobrenos" class="nav-link">Sobre nós</a></li>
						<li class="nav-item <?= (getPagina() == 'veterinarios' ? 'active' : '') ?>"><a href="index.php?pagina=veterinarios" class="nav-link">Veterinários</a></li>
						<li class="nav-item <?= (getPagina() == 'servicos' ? 'active' : '') ?>"><a href="index.php?pagina=servicos" class="nav-link">Serviços</a></li>
						<li class="nav-item <?= (getPagina() == 'precos' ? 'active' : '') ?>"><a href="index.php?pagina=precos" class="nav-link">Preços</a></li>
						<li class="nav-item <?= (getPagina() == 'blog' ? 'active' : '') ?>"><a href="index.php?pagina=blog" class="nav-link">Blog</a></li>
						<li class="nav-item <?= (getPagina() == 'contato' ? 'active' : '') ?>"><a href="index.php?pagina=contato" class="nav-link">Contato</a></li>
						<li class="nav-item <?= (getPagina() == 'login' ? 'active' : '') ?>"><a href="<?= base_url() ?>login" class="nav-link">Area Restrita</a></li>
					</ul>
				</div>
			</div>
		</nav>
        <main>
            <?= $this->renderSection('conteudo'); ?>
        </main>
		<footer class="footer">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-lg-4 mb-3 mb-md-0">
						<ul class="ftco-footer-social p-0">
							<li class="ftco-animate"><a href="#" data-toggle="tooltip"
									data-placement="top" title="Twitter"><span
										class="fa fa-twitter"></span></a></li>
							<li class="ftco-animate"><a href="#" data-toggle="tooltip"
									data-placement="top" title="Facebook"><span
										class="fa fa-facebook"></span></a></li>
							<li class="ftco-animate"><a href="#" data-toggle="tooltip"
									data-placement="top" title="Instagram"><span
										class="fa fa-instagram"></span></a></li>
						</ul>
					</div>
					<div class="col-md-6 col-lg-4 pl-lg-5 mb-4 mb-md-0">
						<h2 class="footer-heading">Links</h2>
						<ul class="list-unstyled">
							<li><a href="index.php" class="py-2 d-block">Home</a></li>
							<li><a href="index.php?pagina=sobrenos" class="py-2 d-block">Sobre nós</a></li>
							<li><a href="index.php?pagina=servicos" class="py-2 d-block">Serviços</a></li>
							<li><a href="index.php?pagina=contato" class="py-2 d-block">Contato</a></li>
						</ul>
					</div>
					<div class="col-md-6 col-lg-4 mb-4 mb-md-0">
						<h2 class="footer-heading">Contato?</h2>
						<div class="block-23 mb-3">
							<ul>
								<li><span class="icon fa fa-map"></span><span class="text">Praça Irmã Annina Bisegna, 40 - Centro, Muriaé - MG, 36880-083</span></li>
								<li><a href="#"><span class="icon fa fa-phone"></span><span
											class="text">+55 32 3729 1234</span></a></li>
								<li><a href="#"><span class="icon fa fa-paper-plane"></span><span
											class="text">petnetto@gmail.com</span></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col-md-12 text-center">
						<p
							class="copyright">
							Copyright
							&copy;<script>document.write(new Date().getFullYear());</script> Todos os direitos reservados. by Pet Netto
						</p>
					</div>
				</div>
			</div>
		</footer>

		<!-- loader -->

		<script src="<?= base_url("assets/js/jquery.min.js") ?>"></script>
		<script src="<?= base_url("assets/js/jquery-migrate-3.0.1.min.js") ?>"></script>
		<script src="<?= base_url("assets/js/popper.min.js") ?>"></script>
		<script src="<?= base_url("assets/js/bootstrap.min.js") ?>"></script>
		<script src="<?= base_url("assets/js/jquery.easing.1.3.js") ?>"></script>
		<script src="<?= base_url("assets/js/jquery.waypoints.min.js") ?>"></script>
		<script src="<?= base_url("assets/js/jquery.stellar.min.js") ?>"></script>
		<script src="<?= base_url("assets/js/jquery.animateNumber.min.js") ?>"></script>
		<script src="<?= base_url("assets/js/bootstrap-datepicker.js") ?>"></script>
		<script src="<?= base_url("assets/js/jquery.timepicker.min.js") ?>"></script>
		<script src="<?= base_url("assets/js/owl.carousel.min.js") ?>"></script>
		<script src="<?= base_url("assets/js/jquery.magnific-popup.min.js") ?>"></script>
		<script src="<?= base_url("assets/js/scrollax.min.js") ?>"></script>
		<script
			src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
		<script src="<?= base_url("assets/js/google-map.js") ?>"></script>
		<script src="<?= base_url("assets/js/main.js") ?>"></script>

	</body>
</html>