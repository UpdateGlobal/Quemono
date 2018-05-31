<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php 
$cod_categoria = $_REQUEST['cod_principal'];
$eliminar = "DELETE FROM productos_principal WHERE cod_principal='$cod_principal'";
$resultado = mysqli_query($enlaces,$eliminar);
header("Location:productos-principal.php");
?>