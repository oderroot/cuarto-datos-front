<?php
header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
$baseDeDatos = new PDO("sqlite:php/cuarto/cuartoDatos.db");
$baseDeDatos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<!DOCTYPE html>

<html >
<head>
  <script type='text/javascript' src='js/jquery-1.9.1.min.js'></script>
  <script type='text/javascript' src="js/jquery-ui.js"></script>
  <script type='text/javascript' src='js/jquery.msgBox.js'></script>
  <script type='text/javascript' src='js/funciones.js'></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="css/msgBoxLight.css" />
  <meta charset="utf-8">
  <meta http-equiv="Expires" content="0">
<meta http-equiv="Last-Modified" content="0">
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
<meta http-equiv="Pragma" content="no-cache">
  <title>Registro</title>
  
  
  
      <link href="css/style2.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" type="text/css" href="view.css" media="all">
      <style type="text/css">
	.ui-dialog-titlebar, .ui-dialog-buttonset {
    text-align: left;
    float: none !important;
}	  


 input[type=number]::-webkit-inner-spin-button, 
      input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
      }
      input[type=number] { -moz-appearance:textfield; }
      
      
       input[type=date]::-webkit-inner-spin-button, 
      input[type=date]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
      }
      input[type=date] { -moz-appearance:textfield; }
	  

		  
body {
     background-image: url(./ptar_canoas2.png);
	 height: 100%; 
	 background-position: center;
     background-repeat: no-repeat;
	 overflow: hidden;
     background-size: cover;
    @media only screen and (max-device-width: 700px) {
 }
		  
 .ui-dialog .ui-dialog-buttonpan{
text-align: center !important
}



 .ui - dialog{
	 max-width:100%
 }





      </style>
</head>

<body>
  
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<!--<div class="loader-background"><div class="loader"></div></div>-->
<img id="carga" src="carga2acua.gif" class="img_loader">

<form id="forma" method="POST">
  <header></header>
  
    <br>
    <br>
<!--<img src="bn_logo265.jpg"
  srcset="bn_logo347.jpg 400w, bn_logo265.jpg 520w, bn_logo347.jpg 320w"
  sizes="(min-width: 576px) 30.0vw, 100vw"
  alt="Ptar">
-->

<div class="token">

<select  style="width:190px; margin-left:-260px; padding: 4px 15px;"  name="tipoDoc" id="tipo" >
    <option disabled selected>Selecciona Tipo </option>
    <option value="CC">Cédula de Ciudadania</option>
    <option value="CE">Cédula de Extranjeria</option>
    <option value="PA">Pasaporte</option>
</select>

      <!-- <input type="text" name="tipoDoc" id="tipo" list="tipoDoc" placeholder="Tipo">
		<datalist id="tipoDoc">
			<option value="CC" >Cedula de Ciudadania</option>
			<option value="CE">Cedula de Extranjeria</option>
			<option value="PA">Pasaporte</option>
		 </datalist>-->
<input type="text" placeholder="Número" name="udocumento" id="udocumento"  required style="position:relative; left: 310px;
    transform: translate(-50%, 0); width:95px; margin-left:-40px" disabled>
      </div>
<input type="text" placeholder="Nombre completo" name="uname" id="uname" required>
<input type="text" placeholder="Empresa" name="uempresa" id="uempresa" required>
<input type="text" name="paises" id="paises2" list="paises" placeholder="Seleccione el Pais">
<datalist id="paises">
<?php
$sql = "select * from Indicativos";
$resultado = $baseDeDatos->query($sql);
$paises = $resultado->fetchAll(PDO::FETCH_OBJ);
foreach($paises as $pais){
	//var_dump($pais->Pais);
?>
	<option value="<?php echo $pais->Pais; ?>"><?php echo $pais->Pais ?></option>
<?php	
}
?>
 </datalist>
</br>
<p>



        <input type="number" placeholder="Tel&eacute;fono" name="utelefono" id="utelefono" required >
        </p>
      <div class="token">

        <input type="email" placeholder="Correo" name="ucorreo" id="ucorreo" required >
        <button type="button" id="validar"> Enviar Código</button>

      </div>
      <div class="token">

        <input type="text" placeholder="Código de Verificación" name="token_send" id="token_send" required disabled="disabled">
        <button type="button" id="tokenT" class="confirm-token"> Confirmar Código</button>

      </div>
<div id="form_container">
<!--<button id="uso" type="button">Información General</button>-->
<a href="#" id="uso" style="margin: 0px 5px;">Información General</a> 
<!--<button id="politica" type="button">Leer Política de datos personales</button>-->
<a href="#" id="politica" style="margin: 0px 12px;">Leer Política de datos personales</a> 
<button id="aceptar" type="button">Aceptar</button>
  </form>


<div id="dialog" title="Cuadro Informativo" style="text-align: justify;">
  <p>Usted está en el Cuarto de datos del proyecto PTAR Canoas de la EAAB – ESP.
 <br><br>
Este sitio está destinado para entregar a la ciudadanía información del proyecto más importante para la descontaminación del río Bogotá.
 <br><br>
Ud. podrá encontrar en aquí información como planos record de los interceptores que transportaran las aguas a la planta, diseños detallados de la planta, diseños de la Estación elevadora de aguas residuales Canoas y presentaciones relacionadas con el proyecto, entre otros.
 <br><br>
Para acceder a la información debe realizar su inscripción.  Una vez introduzca sus datos recibirá en el correo ingresado un código de verificación con el cual podrá completar su registro a la plataforma.
</p>
</div>

<div id="dialog2" title="Politica" style="text-align: justify;">
  <p>En atención a que es mi interés consultar el cuarto virtual publicado por la EAAB-ESP que contiene información relacionada con el proyecto PTAR Canoas y en mi calidad de titular de datos personales, autorizo de manera expresa e irrevocable a esa entidad, o a quien ésta delegue, o a quien represente sus  derechos, para el tratamiento y manejo de mis datos personales el cual consiste en recolectar, almacenar, depurar, usar, analizar, actualizar, cruzar información propia y transferir o transmitir, con el fin de facilitar las actividades del objeto social y las actividades complementarias que pueda desarrollar. <br> <br>
Declaro que soy responsable de la veracidad de los datos suministrados y autorizo a la Empresa de Acueducto y Alcantarillado de Bogotá-ESP para efectuar sus procedimientos de notificación y comunicación a la dirección de correspondencia y/o correo electrónico registrados.   <br><br>
El tratamiento de datos será utilizado mediante correo electrónico, WhatsApp, mensajes de texto, comunicación telefónica y escrita, entre otros, para las finalidades establecidas en la Política de Tratamiento de datos personales publicada en la página web <a href="https://www.acueducto.com.co">www.acueducto.com.co</a> <br><br>
 
Usted contará con los derechos de conocimiento, acceso, rectificación, actualización, revocatoria de la autorización y supresión sobre los datos personales no públicos a los que se dará Tratamiento. Los cuales podrá ejercer ante el Responsable del Tratamiento.<br><br>
La información del formato del cual forma parte la presente autorización la he suministrado de forma voluntaria y es verídica<br><br>
</p>
</div>



</body>
</html>
