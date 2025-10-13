<?php
set_time_limit(0);
$baseDeDatos = new PDO("sqlite:cuarto/cuartoDatos.db");
$baseDeDatos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM correos where Correo='".$_POST["correo"]."' and Token='".$_POST["token"]."' and Comprobacion=0";
$resultado = $baseDeDatos->query($sql);
$resultado = $resultado->fetchAll(PDO::FETCH_OBJ);
foreach($resultado as $resultados){
	$token = $resultados->Token;
}

$sql = "UPDATE correos SET Comprobacion = 1 where Correo='".$_POST["correo"]."' and Token='".$_POST["token"]."' and Comprobacion=0";
$resultado = $baseDeDatos->query($sql);
echo $token;

?>