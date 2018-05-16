<?php
require_once("public/usuario.php");
$buscar = $_POST['b'];    
if(!empty($buscar)) {
      buscar($buscar);
}
function buscar($b) {
      $pre = new usuario();
      $sql = "SELECT * FROM pacientes WHERE nombre LIKE '%".$b."%' or paterno LIKE '%".$b."%' or materno LIKE '%".$b."%' or ci LIKE '%".$b."%' ";
      $resultado = $pre->GetDatosSql($sql);
      print_r($resultado);exit;
      if(sizeof($resultado) == 0){
            echo "No se han encontrado resultados para '<b>".$b."</b>' debe registrar primero al paciente...";
      }
      else{
            echo "<thead><tr><th>Nro.</th><th>Nombres y Apellidos</th><th>C.I.</th><th>Edad</th><th>Sexo</th><th>Accion</th><th>Realizar Atención</th><th>Historial</th></tr></thead><tbody>";
            foreach($resultado as $informacion){
                  $nombre = $informacion->nombre;
                  $paterno = $informacion->paterno;
                  $materno = $informacion->materno;
                  $completo = $nombre." ".$paterno." ".$materno;
                  $id_paciente = $informacion->id_paciente;
                  $ci = $informacion->ci;
                  $edad = $pre->edad($informacion->fec_nac);
                   
                  echo "<tr><td>".$id_paciente."</td><td>".$completo."</td><td>".$ci."</td><td>".$edad." años</td></tr>";    
            }
            echo "</tbody>";
      }
}
?>