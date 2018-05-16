<?php 
require_once("public/usuario.php");
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>..:: Consultorio de Ginecologia ::..</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/main.css" />
</head>
<body>
<!-- Wrapper -->
<div id="wrapper">
<!-- Main -->
	<div id="main">
		<div class="inner">

		<!-- Header -->
			<header id="header">
				<center><h2>Bienvenido al consutorio de ginecologia de la UMSA</h2></center>
			</header>

		<!-- Content -->
			<section>
				<header class="main">
					<h2>Operaciones</h2>
				</header>
				
			</section>
		</div>
	</div>
<!-- Sidebar -->
	<div id="sidebar">
		<div class="inner">

		<!-- Menu -->
			<nav id="menu">
				<header class="major">
					<h2>Menu</h2>
				</header>
				<ul>
					<li><a href="index.html">Pagina de inicio</a></li>
					<li>
						<span class="opener">Pacientes</span>
						<ul>
							<li><a href="registro/">Pacientes registrados</a></li>
							<li><a href="registro/add.php">Agregar paciente</a></li>
						</ul>
					</li>
					<li><a href="#">Busquedas</a></li>
					<li>
						<span class="opener">Antecedentes</span>
						<ul>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
						</ul>
					</li>
					<li><a href="#">Uno</a></li>
					<li><a href="#">Dos</a></li>
					<li><a href="#">Tres</a></li>
				</ul>
			</nav>

		<!-- Search -->
			<section id="search" class="alt">
				<form method="post" action="#">
					<input type="text" name="query" id="query" placeholder="Buscar paciente" />
				</form>
				<div class="table-wrapper">
					<table id="resultado" class="alt"></table>
				</div>
			</section>
		
		<!-- Footer -->
			<footer id="footer">
				<center><p class="copyright">RED <a href="https://unsplash.com">UMSALUD</a> - UMSA</p></center>
			</footer>
		</div>
	</div>
</div>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.dropotron.min.js"></script>
<script src="assets/js/jquery.scrollgress.min.js"></script>
<script src="assets/js/skel.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>