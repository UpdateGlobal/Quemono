<?php include "module/conexion.php"; ?>
<?php include "module/verificar.php"; ?>
<?php 
$cod_pregunta = $_REQUEST['cod_pregunta'];
$eliminar = "DELETE FROM preguntas WHERE cod_pregunta='$cod_pregunta'";
$resultado = mysqli_query($enlaces,$eliminar);
header("Location:preguntas.php");
?>