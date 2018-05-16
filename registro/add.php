<?php 
require_once("../public/usuario.php");
$u = new usuario();
if(isset($_POST["paterno"])){
	$u->insertarPaciente();
}
?>
<html>
<head>
	<title>..:: Consultorio de Ginecologia ::..</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
	<link rel="stylesheet" href="../assets/css/main.css" />
	<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
</head>
<body>
<!-- Wrapper -->
<div id="wrapper">
<!-- Main -->
	<div id="main">
		<div class="inner">

		<!-- Header -->
			<header id="header">
				<a href="index.html" class="logo"><strong>UMSA</strong></a>
			</header>

		<!-- Content -->
			<section>
				<header class="main">
					<h1>Registrar paciente</h1>
				</header>
				<div class="table-wrapper">
					<form method="post" action="">
						<div class="row uniform">
							<div class="6u 12u$(xsmall)">
								<input type="text" name="nombre" id="nombre" value="" placeholder="Ingrese nombres" />
							</div>
							<div class="6u 12u$(xsmall)">
								<input type="text" name="paterno" id="paterno" value="" placeholder="Ingrese apellido paterno" />
							</div>
							<div class="6u 12u$(xsmall)">
								<input type="text" name="materno" id="materno" value="" placeholder="Ingrese apellido materno" />
							</div>
							<div class="6u$ 12u$(xsmall)">
								<input type="text" name="ci" id="ci" value="" placeholder="Ingrese Nro. C.I." />
							</div>
							<div class="6u 12u$(xsmall)">
								<input type="date" name="fec_nac" id="fec_nac" value="" placeholder="Ingrese fecha de naciemiento" />
							</div>
							<div class="12u$">
								<div class="select-wrapper">
								<select name="residencia" id="residencia" required="true">
									<?php  $municipios = ['ixiamas','san buena ventura','sica sica','calamarca','collana','colquencha','patacamaya','umala','charazani','curva','puerto acosta','mocomoco','puerto carabuco','escoma','humanata','caranavi','alto beni','apolo','pelechuco','san pedro de curahuara','chacarilla','papel pampa','viacha','andres de machaca','desaguadero','guaqui','jesús de machaca','taraco','tiahuanaco','inquisivi','cajuata','colquiri','ichoca','licoma pampa','quime','santiago de machaca','catacora','sorata','combaya','guanay','mapiri','quiabaya','tacacoma','teoponte','tipuani','luribay','cairoma','malla','sapahaqui','yaco','pucarani','batallas','laja','puerto perez','copacabana','san pedro de tiquina','tito yupanqui','chuma','aucapata','ayata','palca','achocalla','el alto','la paz','mecapaca','coroico','coripata','achacachi','ancoraimes','chua cocani','huarina','huatajata','santiago de huata','coro coro','calacoto','caquiaviri','charana','comanche','nazacara de pacajes','santiago de callapa','waldo ballivian','chulumani','irupana','la asunta','palos blancos','yanacachi'];
									for ($i = 0; $i < sizeof($municipios) ; $i++) {
										$mun = $municipios[$i];
										if($mun == "la paz"){
											?>
											<option value="<?php echo $mun ?>" selected><?php echo $mun;?></option>
											<?php
										}
										else{
										?>
										<option value="<?php echo $mun ?>"><?php echo $mun;?></option>
									 	<?php
										}
									}
									?>
							
						</select>
							</div>
						</div>
							<!-- Break -->
							<div class="12u$">
								<div class="select-wrapper">
									<select name="sexo" id="sexo">
										<option value="masculino" selected>Masculino</option>
										<option value="femenino">Femenino</option>
									</select>
								</div>
							</div>
							<!-- Break -->
							<div class="12u$">
								<textarea name="antecedentes" id="antecedentes" placeholder="Ingrese los antecedentes respectivos del paciente" rows="6"></textarea>
							</div>
							<!-- Break -->
							<div class="12u$">
								<ul class="actions">
									<li><input type="submit" value="Guardar datos" class="special" /></li>
									<li><input type="reset" value="Limpiar" /></li>
								</ul>
							</div>
						</div>
					</form>
				</div>
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
					<li><a href="../index.php">Pagina de inicio</a></li>
					<li>
						<span class="opener">Pacientes</span>
						<ul>
							<li><a href="index.php">Pacientes registrados</a></li>
							<li><a href="add.php">Agregar paciente</a></li>
						</ul>
					</li>
					<li><a href="#">Busquedas</a></li>
					<li>
						<span class="opener">Otro Submenu</span>
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
						<input type="text" name="query" id="query" placeholder="Search" />
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
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/skel.min.js"></script>
<script src="../assets/js/util.js"></script>
<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
<script src="../assets/js/main.js"></script>
</body>
</html>