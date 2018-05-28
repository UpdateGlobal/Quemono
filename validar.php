<?php include "cms/module/conexion.php"; ?>
<?php
$proceso = $_POST['proceso'];
if($proceso == "iniciar"){
	$email = $_POST['email'];
	$clave = $_POST['clave'];
	// crear consulta
	$consulta = "SELECT * FROM clientes WHERE email='$email' AND estado='1'";
	$resultado = mysqli_query($enlaces, $consulta);
	while($fila=mysqli_fetch_array($resultado)){
		$xCodCliente = $fila['cod_cliente'];
		$xAlias = utf8_encode($fila['nombres']);
		$xEmail = $fila['email'];
		$xClave = $fila['clave'];
	}
	$contador = mysqli_num_rows($resultado);
	mysqli_free_result($resultado);
	
	//echo $xClave; exit();
	if($contador>0){
	    $clave_ok = password_verify($clave, $xClave);
	    if ($clave_ok){
    	    session_start();
    		$_SESSION['xCodCliente'] = $xCodCliente;
    		$_SESSION['xAlias_c'] = $xAlias;
    		$_SESSION['xEmail_c'] = $xEmail;
    		header("Location:bienvenido.php");    
	    }else{
	        header("Location:seguridad.php");
	    }
	}else{
		header("Location:seguridad.php");
	}
	
}
?>