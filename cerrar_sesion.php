<?php include "cms/module/conexion.php"; ?>
<?php include "cms/module/verificar.php"; ?>
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

$sql = "DELETE FROM carrito WHERE cod_orden='$varOrden' AND cod_cliente='$varCliente'";
$result = mysqli_query(mysqli_connect("localhost","root","", "update_quemono"),$sql);

header("Location:index.php");
?>