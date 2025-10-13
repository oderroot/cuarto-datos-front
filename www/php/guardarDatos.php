<?php
//echo "sasasas";
set_time_limit(0);
$baseDeDatos = new PDO("sqlite:cuarto/cuartoDatos.db");
$baseDeDatos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$indicativos = "SELECT * FROM INDICATIVOS WHERE Pais='".$_POST['pais']."'";
$resultado = $baseDeDatos->query($indicativos);
if (!$resultado) {
	echo json_encode(1);
}
else{
	$resultado = $resultado->fetchAll(PDO::FETCH_OBJ);
	foreach($resultado as $resultados){
		$indicativo = $resultados->Indicativo;
	}
	$sqlI = "INSERT INTO Informacion (Tipo_Documento, Numero_Documento, Nombres, Empresa, Indicativo, Telefono, Correo, Registro) values('".$_POST["tipo"]."','".$_POST["documento"]."','".$_POST["nombres"]."','".$_POST["empresa"]."','".$indicativo."','".$_POST["telefono"]."','".$_POST["correo"]."','".date("Y-m-d H:i:s")."')";
	$resultadoI = $baseDeDatos->query($sqlI);
	if (!$resultadoI) {
		echo json_encode(2);
	}
	else{
		echo json_encode(0);
	}
	
}


// $sql = "INSERT INTO Informacion (Nombres, Empresa, Indicativo, Telefono, Correo, Registro) values()";
// $resultado = $baseDeDatos->query($sql);
// $resultado = $resultado->fetchAll(PDO::FETCH_OBJ);



?>