<?php include("cms/module/conexion.php"); ?>
<?php include("modules/session-core.php"); ?>
<?php
$cod_cliente    = $_REQUEST['cod_cliente'];
if (isset($_REQUEST['proceso'])) {
  $proceso  = $_POST['proceso'];
} else {
  $proceso  = "";
}
if($proceso == ""){
  $consultaClientes = "SELECT * FROM clientes WHERE cod_cliente='$cod_cliente'";
  $ejecutarClientes = mysqli_query($enlaces,$consultaClientes) or die('Consulta fallida: ' . mysqli_error($enlaces));
  $filaCli = mysqli_fetch_array($ejecutarClientes);
  $cod_cliente  = $filaCli['cod_cliente'];
  $email        = $filaCli['email'];
}

if($proceso=="Actualizar"){ 
  $cod_cliente    = $_POST['cod_cliente'];
  if($_POST['clave']==""){
    $claveM       = "[No se cambió]";
  }else{
    $claveM       = $_POST['clave'];
    $clave        = password_hash($_POST['clave'], PASSWORD_BCRYPT);
  }
  $actualizarClientes = "UPDATE clientes SET cod_cliente='$cod_cliente', clave='$clave' WHERE cod_cliente='$cod_cliente'";
  $resultadoActualizar = mysqli_query($enlaces,$actualizarClientes) or die('Consulta fallida: ' . mysqli_error($enlaces));
  
  $consultaClientes = "SELECT * FROM clientes WHERE cod_cliente='$cod_cliente'";
  $ejecutarClientes = mysqli_query($enlaces,$consultaClientes) or die('Consulta fallida: ' . mysqli_error($enlaces));
  $filaCli        = mysqli_fetch_array($ejecutarClientes);
  $cod_cliente    = $filaCli['cod_cliente'];
  $email          = $filaCli['email'];
  $nombres        = $filaCli['nombres'];
  $direccion      = $filaCli['direccion'];
  $telefono       = $filaCli['telefono'];
  
  $consultarCot = 'SELECT * FROM contacto';
  $resultadoCot = mysqli_query($enlaces,$consultarCot) or die('Consulta fallida: ' . mysqli_error($enlaces));
  while($filaCot = mysqli_fetch_array($resultadoCot)){
    $xDesemail = $filaCot['form_mail'];
  }

  $consultarMet = 'SELECT * FROM metatags';
  $resultadoMet = mysqli_query($enlaces,$consultarMet) or die('Consulta fallida: ' . mysqli_error($enlaces));
  $filaMet = mysqli_fetch_array($resultadoMet);
    $xUrl       = $filaMet['url'];

  $emailDestino = $email;
  $encabezado = "Cambio de Clave - Tienda virtual";
  $mensaje .= "
    <p>Cambio de clave realizado, acceda en: <a href='".$xUrl."'>Enlace</a></p>
    <h3>Nueva Informaci&oacute;n de la Cuenta</h3>
    <table width='100%' border=0 cellpadding=0 cellspacing=0 align=center>
      <tr>
        <td width='25%'><strong>Email : </strong></th>
        <td width='75%'>".$email."</th>
      </tr>
      <tr>
        <td><strong>Clave : </strong></th>
        <td>".$claveM."</th>
      </tr>
    </table>
    <br>
    <h4>Datos de Perfil</h4>
    <table width='100%' border=0 cellpadding=0 cellspacing=0 align=center>
      <tr>
        <td width='25%'><strong>Nombre : </strong></th>
        <td width='75%'>".$nombres."<br></th>
      </tr>
      <tr>
        <td><strong>Direcci&oacute;n : </strong></th>
        <td>".$direccion."<br></th>
      </tr>
      <tr>
        <td><strong>Tel&eacute;fono : </strong></th>
        <td>".$telefono."<br></th>
      </tr>
    </table>
    <p>Cualquier duda contacte a soporte:".$xDesemail."</p>";
  $mailcabecera = 'MIME-Version: 1.0'."\r\n";
  $mailcabecera.= 'Content-type:text/html; charset-iso-8859-1'."\r\n";
  $mailcabecera.= "Desde: ".$xDesemail;
  $mailcabecera.= "<".$xDesemail.">\r\n";
  $mailCabecera.= "Responder a: ".$xDesemail;
  $mensajeEmail = $mensaje;
  mail($emailDestino,$encabezado,$mensajeEmail,$mailcabecera);
  header("Location:/clave-cambiada.php");
}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html class="ie8"> <![endif]-->
<!--[if IE 9]> <html class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html> <!--<![endif]-->
  <head>
    <?php include("includes/head.php"); ?>
    <style id="custom-style">

    </style>
    <script>
      function Validar(){
        if(document.perfil.clave.value==""){
          alert("Ingrese una clave");
          document.perfil.clave.focus();
          return; 
        }
        document.perfil.action = "/clave-editar.php";
        document.perfil.proceso.value="Actualizar";
        document.perfil.submit();
      }
    </script>
  </head>
  <body>
    <div id="wrapper">
        <?php include("includes/header.php"); ?>
        <section id="content">
        	<div id="breadcrumb-container">
        		<div class="container">
    					<ul class="breadcrumb">
                <li><a href="/index.php">Inicio</a></li>
                <li><a href="/perfil.php">Perfil</a></li>
                <li class="active">Editar Clave</li>
              </ul>
        		</div>
        	</div>
        	<div class="container">
            <form name="perfil" method="post" action="">
              <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <h1 class="title">Datos de la Cuenta</h1>
                  <p><strong>Cambio de Clave</strong> La clave cambiada ser&aacute; enviada al correo registrado.</p>
                  <div class="lg-margin"></div><!-- space -->
                  <div class="input-group">
                    <span class="input-group-addon"><span class="input-icon input-icon-email"></span><span class="input-text">Email</span></span><input type="text" disabled class="form-control input-lg" placeholder="Su Email" value="<?php echo $xEmail; ?>">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon"><span class="input-icon input-icon-password"></span><span class="input-text">Su Clave</span></span><input type="text" required class="form-control input-lg" id="clave" name="clave" placeholder="Ingrese su nueva clave" value="">
                  </div><!-- End .input-group -->
                  <p><strong>Nota:</strong> La clave cambiada ser&aacute; enviada al correo registrado.</p>
                </div>
              </div>
              <div style="height: 30px;"></div>
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <p class="linea">
                    <a href="/perfil.php" class="btn btn-custom-alt">&laquo; Volver</a>
                    <input type="button" value="Cambiar Datos" class="btn btn-custom-2" onClick="javascript:Validar();">
                  </p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"></div>
                <input type="hidden" name="cod_cliente" value="<?php echo $cod_cliente; ?>">
                <input type="hidden" name="proceso">
              </div>
            </form>
          </div><!-- End .container -->
        </section><!-- End #content -->
      <?php include("includes/footer.php"); ?>
    </div><!-- End #wrapper -->
  </body>
</html>