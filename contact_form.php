<?php include("cms/module/conexion.php"); ?>
<?php 
/*--- Enviar datos al email ----*/
$consultarCot = 'SELECT * FROM contacto';
$resultadoCot = mysqli_query($enlaces,$consultarCot) or die('Consulta fallida: ' . mysqli_error($enlaces));
$filaCot = mysqli_fetch_array($resultadoCot);
	$xDesemail = $filaCot['form_mail'];

$toEmail = $xDesemail;
$subject = "Nuevo Mensaje desde Quemono";
$mailHeaders = 'From: '.$_POST["email"]."\r\n".
'Reply-To: '.$_POST["email"]."\r\n" .
'X-Mailer: PHP/' . phpversion();

/* ---- o ---- */

$xNombres		= $_POST["nombres"];
$xTelefono 		= $_POST["telefono"];
$xEmail 		= $_POST["email"];
$xMensaje 		= $_POST["mensaje"];
$xFecha 		= $_POST["fecha_ingreso"];

$mensaje = "Informacion de Contacto\n";
$mensaje .= "------------------------\n";
$mensaje .= "Nombres: ".$_POST["nombres"]."\n";
$mensaje .= "Telefono: ".$_POST["telefono"]."\n";
$mensaje .= "Email: ".$_POST["email"]."\n";
$mensaje .= "Mensaje: ".$_POST["mensaje"]."\n";

/* ---- o ---- */

$contacto = "INSERT INTO formulario(nombres, telefono, email, mensaje, fecha_ingreso)VALUES('$xNombres', '$xTelefono', '$xEmail', '$xMensaje', '$xFecha')";
$result=mysqli_query($enlaces, $contacto) or die('Consulta fallida: ' . mysqli_error($enlaces));


if(mail($toEmail, $subject, $mensaje, $mailHeaders)) {
	print "<div class='alert alert-success' role='alert'>Mensaje Enviado Exitosamente.</div>";
} else {
	print "<div class='alert alert-danger' role='alert'>Problema al enviar el mensaje, intentelo m&aacute;s tarde.</div>";
}

?>