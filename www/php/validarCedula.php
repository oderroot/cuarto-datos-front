<?php
set_time_limit(0);
$baseDeDatos = new PDO("sqlite:cuarto/cuartoDatos.db");
$baseDeDatos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT COUNT(*) AS Cuenta FROM Informacion where Numero_Documento='".$_POST["documento"]."' and Tipo_Documento='".$_POST["tipo"]."'";
$resultado = $baseDeDatos->query($sql);
$resultado = $resultado->fetchAll(PDO::FETCH_OBJ);
foreach($resultado as $resultados){
	$cuenta = $resultados->Cuenta;
}

echo json_encode($cuenta);

?>