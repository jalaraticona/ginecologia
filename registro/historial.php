<?php
require_once("../public/usuario.php");
if(!isset($_SESSION["id_enf"])){
	header("Location: ../index.php");
}
$u = new usuario();
$var = str_replace ( " " , "+" , $_GET["ci"] );
$des = $u->desencriptar($var);
if(!isset($_GET["ci"]) or !is_numeric($des)){
	header("Location: index.php");
}
$sql = "SELECT * FROM pacientes WHERE ci = ".$des." ";
$datos = $u->GetDatosSql($sql);
$sql = "SELECT re.fec_reg, re.motivo, re.lugar, re.dosis, se.nombre, se.tipo FROM registrahistoria as re, servicio as se, pacientes as pa WHERE re.id_paciente = pa.id_paciente and se.id_servicio = re.id_servicio and pa.ci = ".$des." ";
$datos2 = $u->GetDatosSql($sql);
if(sizeof($datos2) == 0){
	header("Location: index.php?m=3");
}
$enc = $u->encriptar($datos[0]->ci);
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
				<a href="index.php" class="logo"><strong>Pacientes registrados a la fecha</strong></a>
			</header>

		<!-- Content -->
			<section>
				<header class="main">
					<h4>Cantidad de pacientes registrados: <?php echo $cantidad[0]->cuantos ?> pacientes</h4>
				</header>
				<div class="table-wrapper">
					<table class="alt">
						<thead>
							<tr>
								<th>N°</th>
								<th>Nombres_Apellidos</th>
								<th>C.I.</th>
								<th>Fecha de Nacimiento</th>
								<th>Sexo</th>
								<th>Mpio. residencia</th>
								<th>Fec. registro</th>
								<th>Accion</th>
								<th>Realizar Atención</th>
								<th>Historia clinica</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$cont = 0;
							foreach($datos as $dato){
								$cont++;
								$enc = $u->encriptar($dato->ci);
								?>
								<tr>
									<td><?php echo $cont ?></td>
									<td><?php echo $dato->nombre." ".$dato->paterno." ".$dato->materno?></td>
									<td><?php echo $dato->ci?></td>
									<td><?php echo $dato->fec_nac?></td>
									<td><?php echo $dato->sexo?></td>
									<td><?php echo $dato->municipio?></td>
									<td><?php echo $dato->fec_reg?></td>
									<td><a href="edit.php?ci=<?php $enc = $u->encriptar($dato->ci);
									echo $enc;?>" class="icon fa-pencil">editar</a><br>
									<!--<a href="javascript:void(0);" onclick="eliminar('delete.php?ci=<?php echo $dato->ci?>');" class="icon fa-trash">eliminar</a>--></td>
									<td><a href="../atencion/RegistraHistoria.php?ci=<?php
									 echo $enc;?>" class="icon fa-stethoscope">&nbsp;Proc. Enf.</a></td>
									<td>
									<a href="historial.php?ci=<?php
									 echo $enc;?>" class="icon fa-book">&nbsp;Ver</a>
									</td>
								</tr>
								<?php
							}
							?>
							<tr>
								<td colspan="13">
									<div class="pull-right">
										<ul class="pagination">
										    <li><a href="index.php">Primera Página</a></li>
										    <?php 
										    if($pagina == 1){
										    	?>
										    	<li class="disabled"><a href="javascript:void(0);" title="">Anterior</a></li>
										    	<?php
										    }
										    else{
										    	$anterior = $pagina-1;
										    	?>
										    	<li><a href="index.php?pagina=<?php echo $anterior ?>">Anterior</a></li>
										    	<?php
										    }
										    ?>

										    <?php
										    for($i=1; $i<$total_paginas; $i++){
										    	?>
										    	<li <?php if($pagina==$i){ echo 'class="active"'; } ?>><a href="index.php?pagina=<?php echo $i;?>"><?php echo $i; ?></a></li>
										    	<?php
										    }
										    ?>

										    <?php
										    if($cont == $cant_por_pagina and $pagina < $total_paginas){
										    	$proximo = $pagina+1;
										    	?>
										    	<li><a href="index.php?pagina=<?php echo $proximo ?>">Siguiente</a></li>
										    	<?php
										    }
										    else{
										    	?>
										    	<li class="disabled"><a href="javascript:void(0);">Siguiente</a></li>
										    	<?php
										    }
										    ?>
										    <li><a href="index.php?pagina=<?php echo $total_paginas; ?>">Ultima Pagina</a></li>
										</ul>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					<center><a href="add.php" class="button small icon fa-plus" >Agregar Paciente</a></center>
				</div>
			</section>
		</div>
	</div>

<!-- Sidebar -->
	<div id="sidebar">
		<div class="inner">

			<!-- Menu -->
			<nav id="menu">
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
					<div class="table-wrapper">
						<table>
							<tr>
								<td colspan="7"><center><h3>..:: Registro de consultas del paciente ::..</h3></center></td>
								<td>Nro.: <?php echo $datos[0]->id_paciente; ?></td>
							</tr>
							<tr>
								<td colspan="8"></td>
							</tr>
							<tr>
								<td>Nombre del paciente:</td>
								<td colspan="5"><?php echo $datos[0]->nombre." ".$datos[0]->paterno." ".$datos[0]->materno; ?></td>
								<td>Numero C.I.: </td>
								<td><?php echo $datos[0]->ci; ?></td>
							</tr>
							<tr>
								<td>Fecha de registro:</td>
								<td><?php echo $datos[0]->fec_reg; ?></td>
								<td>Fecha de Nacimiento:</td>
								<td><?php echo $datos[0]->fec_nac; ?></td>
								<td>Edad:</td>
								<td><?php echo $u->edad($datos[0]->fec_nac); ?> años</td>
								<td>Sexo: </td>
								<td><?php echo $datos[0]->sexo; ?></td>
							</tr>
							<tr>
								<td colspan="2">Municipio residencia:</td>
								<td><?php echo $datos[0]->municipio; ?></td>
								<td>Categoria:</td>
								<td><?php echo $datos[0]->municipio; ?></td>
								<td>Carrera o Cargo: </td>
								<td colspan="2"><?php echo $datos[0]->carrera_cargo; ?></td>
							</tr>
						</table>
						<hr border="2">
						<div id="div1">
						<table class="alt">
							<thead>
								<tr>
									<th>Nro.</th>
									<th>Fecha de registro</th>
									<th>Motivo de consulta</th>
									<th>Servicio</th>
									<th>Lugar</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								foreach ($datos2 as $info) {
									$fecha = $info->fec_reg;
									$motivo = $info->motivo;
									if($info->tipo == "vacuna"){
										$servicio = $info->nombre." ".$info->dosis." dosis";
									}
									else{
										$servicio = $info->nombre;
									}
									$lugar = $info->lugar." del consultorio";
									?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $fecha; ?></td>
										<td><?php echo $motivo; ?></td>
										<td><?php echo $servicio; ?></td>
										<td><?php echo $lugar; ?></td>
									</tr>
									<?php
									$i++;
								}
								?>
							</tbody>
						</table>
						</div>
					</div>
					<br>
					<center><a href="../atencion/RegistraHistoria.php?ci=<?php echo $enc;?>" class="button special small icon fa-plus" >Realizar Proc. Enfermero</a> &nbsp; <a href="../atencion/RegistraVacunacion.php?ci=<?php echo $enc;?>" class="button special small icon fa-plus" >Realizar Vacunacion</a></center>
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