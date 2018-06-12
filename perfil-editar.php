<?php include("cms/module/conexion.php"); ?>
<?php include("modules/session-core.php"); ?>
<?php
$cod_cliente    = $_REQUEST['cod_cliente'];
if (isset($_REQUEST['proceso'])) {
  $proceso  = $_POST['proceso'];
  $chk    = $_POST['chk'];
} else {
  $proceso  = "";
  $chk    = "";
}
if($proceso == ""){
  $consultaClientes = "SELECT * FROM clientes WHERE cod_cliente='$cod_cliente'";
  $ejecutarClientes = mysqli_query($enlaces,$consultaClientes) or die('Consulta fallida: ' . mysqli_error($enlaces));
  $filaCli = mysqli_fetch_array($ejecutarClientes);
  $cod_cliente    = $filaCli['cod_cliente'];
  $xNombres       = $filaCli['nombres'];
  $direccion      = $filaCli['direccion'];
  $telefono       = $filaCli['telefono'];
}

if($proceso=="Actualizar"){
  $cod_cliente    = $_POST['cod_cliente'];
  $direccion      = mysqli_real_escape_string($enlaces, $_POST['direccion']);
  $telefono       = mysqli_real_escape_string($enlaces, $_POST['telefono']);
  $actualizarClientes = "UPDATE clientes SET cod_cliente='$cod_cliente', direccion='$direccion', telefono='$telefono' WHERE cod_cliente='$cod_cliente'";
  $resultadoActualizar = mysqli_query($enlaces,$actualizarClientes) or die('Consulta fallida: ' . mysqli_error($enlaces));
  
  if($chk=="s") { 
    $consultaClientes = "SELECT * FROM clientes WHERE cod_cliente='$cod_cliente'";
    $ejecutarClientes = mysqli_query($enlaces,$consultaClientes) or die('Consulta fallida: ' . mysqli_error($enlaces));
    $filaCli = mysqli_fetch_array($ejecutarClientes);
    $cod_cliente    = $filaCli['cod_cliente'];
    $nombres        = $xNombres;
    $direccion      = htmlspecialchars($filaCli['direccion']);
    $telefono       = htmlspecialchars($filaCli['telefono']);
    $email          = $filaCli['email'];
    $clave          = $filaCli['clave'];

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
    $encabezado = "Perfil Actualizado - Tienda virtual";
    $mensaje .= "
      <p>Cambio de datos realizado, acceda en: <a href='".$xUrl."'>Enlace</a></p>
      <h3>Nuevos Datos de Perfil</h3>
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
      <br>
      <h4>Informaci&oacute;n de la Cuenta</h4>
      <table width='100%' border=0 cellpadding=0 cellspacing=0 align=center>
        <tr>
          <td width='25%'><strong>Email : </strong></th>
          <td width='75%'>".$email."</th>
        </tr>
        <tr>
          <td><strong>Clave : </strong></th>
          <td>".$clave."</th>
        </tr>
      </table>
      <p>Cualquier duda contacte a soporte: ".$xDesemail."</p>";
    $mailcabecera = 'MIME-Version: 1.0'."\r\n";
    $mailcabecera.= 'Content-type:text/html; charset-iso-8859-1'."\r\n";
    $mailcabecera.= "Desde: ".$xDesemail;
    $mailcabecera.= "<".$xDesemail.">\r\n";
    $mailCabecera.= "Responder a: ".$xDesemail;
    $mensajeEmail = $mensaje;
    mail($emailDestino,$encabezado,$mensajeEmail,$mailcabecera);
  }
  header("Location:/perfil.php");
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
        if(document.perfil.direccion.value==""){
          alert("Debe escribir su dirección");
          document.perfil.direccion.focus();
          return;
        }
        if(document.perfil.telefono.value==""){
          alert("Ingrese su telefono");
          document.perfil.telefono.focus();
          return;
        }
        document.perfil.action = "/perfil-editar.php";
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
                <li class="active">Editar Perfil</li>
              </ul>
        		</div>
        	</div>
        	<div class="container">
            <form name="perfil" method="post" action="">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <h1 class="title">Datos de Perfil</h1>
                  <p>En esta secci&oacute;n puede modificar sus datos de usuario.</p>
                  <div class="lg-margin"></div><!-- space -->
                  <div class="input-group">
                    <span class="input-group-addon"><span class="input-icon input-icon-user"></span><span class="input-text">Nombres</span></span><input type="text" disabled class="form-control input-lg" placeholder="Su Nombre" value="<?php echo $xNombres; ?>">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon"><span class="input-icon input-icon-address"></span><span class="input-text">Su Direcci&oacute;n</span></span><input type="text" required class="form-control input-lg" id="direccion" name="direccion" placeholder="Su Dirección" value="<?php echo $direccion; ?>">
                  </div><!-- End .input-group -->
                  <div class="input-group">
                    <span class="input-group-addon"><span class="input-icon input-icon-phone"></span><span class="input-text">Su Tel&eacute;fono</span></span><input type="text" required class="form-control input-lg" id="telefono" name="telefono" placeholder="Su Teléfono" value="<?php echo $telefono; ?>">
                  </div><!-- End .input-group -->
                  <div class="input-group custom-checkbox">
                    <input type="checkbox" name="chk" value="s" /><span class="checbox-container"><i class="fa fa-check"></i></span> Enviar cambios al correo electr&oacute;nico.
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"></div>
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