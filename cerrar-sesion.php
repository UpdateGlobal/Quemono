<?php include "cms/modulos/conexion.php"; ?>
<?php 
session_start();
session_destroy();

if(isset($_SESSION['IdOrden'])){
  $varOrden   = $_SESSION['IdOrden'];
}else{
  $varOrden   = 0;
}
if(isset($_SESSION['IdCliente'])){
  $varCliente = $_SESSION['IdCliente'];
}else{
  $varCliente = "";
}

//Borrando registros de la tabla carrito
$xCliente = $_SESSION['IdCliente'];
$xOrden = $_SESSION['IdOrden'];
$borrar = "DELETE FROM carrito WHERE cod_orden='$xOrden' AND cod_cliente='$xCliente'";
$resultado = mysqli_query($enlaces, $borrar);

header("Location:index.php");
?>