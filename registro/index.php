<?php 
require_once("../public/usuario.php");
$u = new usuario();
$cant_por_pagina = 10;
if(isset($_GET["pagina"])){
	if(is_numeric($_GET["pagina"])){
		if($_GET["pagina" == 1]){
			header("Location: index.php");
		}
		else{
			$pagina = $_GET["pagina"];
		}
	}
	else{
		header("Location: index.php");
	}
}
else{
	$pagina = 1;
}
$empezar_desde = ($pagina-1)*$cant_por_pagina;
$sql1 = "SELECT count(*) AS cuantos FROM pacientes";
$cantidad = $u->GetDatosSql($sql1);
$sql2 = "SELECT * FROM pacientes LIMIT ".$empezar_desde.",".$cant_por_pagina." ";
$datos = $u->GetDatosSql($sql2);

$total_paginas = ceil($cantidad[0]->cuantos/$cant_por_pagina);
?>
<html>
<head>
	<title>..:: Consultorio de Ginecologia ::..</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="../assets/css/main.css" />
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
<script src="../assets/js/main.js"></script>
</body>
</html>