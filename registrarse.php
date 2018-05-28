<?php include("cms/module/conexion.php"); ?>
<?php include("modules/session-core.php"); ?>
<?php 
if (isset($_REQUEST['proceso'])) {
  $proceso  = $_POST['proceso'];
} else {
  $proceso = "";
  $advertencia = "";
}
$resultado = 1;
if($proceso=="Registrar"){
  $nombres      = $_POST['nombres'];
  $email        = $_POST['email'];
  $clave        = $_POST['clave'];
  $direccion    = $_POST['direccion'];
  $telefono     = $_POST['telefono'];
  $estado       = $_POST['estado'];

  /*-- Validar cliente para que no se repita ---*/
  $verificar = "SELECT * FROM clientes WHERE email='$email'";
  $ejecutar = mysqli_query($enlaces, $verificar);
  $numcli = mysqli_num_rows($ejecutar);
  if($numcli==0){

    /*---- Mensaje para el correo electronico ----*/
    $consultarMet = 'SELECT * FROM metatags';
    $resultadoMet = mysqli_query($enlaces,$consultarMet) or die('Consulta fallida: ' . mysqli_error($enlaces));
    $filaMet = mysqli_fetch_array($resultadoMet);
      $xCodigo  = $filaMet['cod_meta'];
      $xUrl     = $filaMet['url'];

    $emailDestino = $email;
    $encabezado = "Bienvenido a Quemono";
    $encabezada = "Nuevo Usuario Registrado";
    $mensaje = "
      <p>Acceda en: <a href='".$xUrl."' target='_target'>Enlace</a></p>

      <h3>Informaci&oacute;n de la Cuenta</h3>
      <table width='100%' border='0' cellpadding='0' cellspacing='0' align='center'>
        <tr>
          <td width='25%'><strong>Email : </strong></th>
          <td width='75%'>".$email."</th>
        </tr>
        <tr>
          <td><strong>Clave : </strong></th>
          <td>".$clave."</th>
        </tr>
      </table>
      <br>
      <h3>Datos de Perfil</h3>
      <table width='100%' border='0' cellpadding='0' cellspacing='0' align='center'>
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
      </table>";

    mysqli_free_result($resultadoMet);
    /*----- Codigo enviar pedidos al correo ---*/

    $consultarCot = 'SELECT * FROM contacto';
    $resultadoCot = mysqli_query($enlaces,$consultarCot) or die('Consulta fallida: ' . mysqli_error($enlaces));
    while($filaCot = mysqli_fetch_array($resultadoCot)){
      $xFormemail   = $filaCot['form_mail'];
    }
    $destino = $xFormemail;
    $mailCabecera = 'MIME-Version: 1.0'."\r\n";
    $mailCabecera.= 'Content-type:text/html; charset-iso-8859-1'."\r\n";
    $mailCabecera.= "FROM: ".$xFormemail;
    $mailCabecera.= "<".$xFormemail.">\r\n";
    $mailCabecera.= "Reply-To: ".$xFormemail;
    $mensajeEmail = $mensaje;
    mail($emailDestino,$encabezado,$mensajeEmail,$mailCabecera);

    mail($destino,$encabezada,$mensajeEmail,$mailCabecera);

    $clave_status = password_hash($clave, PASSWORD_BCRYPT);

    if ($clave_status!==false){
      $insertar="INSERT INTO clientes(nombres, email, clave, direccion, telefono, estado) VALUE('$nombres', '$email', '$clave_status', '$direccion', '$telefono', '$estado')";
      $resultado = mysqli_query($enlaces, $insertar);
      $resultado = 0;
    }else{
      $advertencia = "<div class='alert alert-warning' role='alert'>¡Pruebe ingresando otra clave!</div>";
    }
  }else{
    $advertencia = "<div class='alert alert-danger' role='alert'>¡Cliente registrado ya existe!</div>";
  }
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
      function ValidarReg(){
        var condiciones = $("#aceptar").is(":checked");

        if(document.fregistro.nombres.value==""){
          alert("Debes llenar tu nombre");
          document.fregistro.nombres.focus();
          return;
        }
        if(document.fregistro.email.value==""){
          alert("Debes llenar tu email");
          document.fregistro.email.focus();
          return;
        }
        if(document.fregistro.clave.value==""){
          alert("Debes llenar su clave");
          document.fregistro.clave.focus();
          return;
        }
        if(document.fregistro.direccion.value==""){
          alert("Debes llenar tu direccion");
          document.fregistro.direccion.focus();
          return;
        }
        if(document.fregistro.telefono.value==""){
          alert("Debes llenar tu teléfono");
          document.fregistro.telefono.focus();
          return;
        }
        if (!condiciones) {
          alert("Debes aceptar nuestras políticas de privacidad");
          return;
        }
        document.fregistro.action="registrarse.php";
        document.fregistro.proceso.value="Registrar";
        document.fregistro.submit();
      }
      function soloNumeros(e){
        var key = window.Event ? e.which : e.keyCode 
        return ((key >= 48 && key <= 57) || (key==8)) 
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
    						<li><a href="index.php">Inicio</a></li>
    						<li class="active">Registro</li>
    					</ul>
        		</div>
        	</div>
        	<div class="container">
        		<div class="row">
        			<div class="col-md-12">
                <?php 
                  if($resultado==1){
                ?>
                <header class="content-title">
                  <h1 class="title">Registrar Cuenta</h1>
                  <p class="title-desc">Si ya tiene un cuenta puede registrarse en: <a href="login.php">login page</a>.</p>
                </header>
                <div class="xs-margin"></div><!-- space -->
						    <form method="POST" action="" name="fregistro" id="fregistro">
        				  <div class="row">
    								<div class="col-md-6 col-sm-6 col-xs-12">
    									<fieldset>
        								<h2 class="sub-title">Detalles Personales</h2>
        								<div class="input-group">
        									<span class="input-group-addon"><span class="input-icon input-icon-user"></span><span class="input-text">Su Nombre</span></span>
        									<input type="text" required class="form-control input-lg" id="nombres" name="nombres" placeholder="Su Nombre">
        								</div><!-- End .input-group -->
        								<div class="input-group">
        									<span class="input-group-addon"><span class="input-icon input-icon-email"></span><span class="input-text">Su Email</span></span>
        									<input type="text" required class="form-control input-lg" id="email" name="email" placeholder="Su Email">
        								</div><!-- End .input-group -->
        								<div class="input-group">
                          <span class="input-group-addon"><span class="input-icon input-icon-address"></span><span class="input-text">Su Direcci&oacute;n</span></span><input type="text" required class="form-control input-lg" id="direccion" name="direccion" placeholder="Su Dirección">
                        </div><!-- End .input-group -->
                        <div class="input-group">
    										  <span class="input-group-addon"><span class="input-icon input-icon-phone"></span><span class="input-text">Su Tel&eacute;fono</span></span><input type="text" required class="form-control input-lg" id="telefono" name="telefono" placeholder="Su Teléfono">
    						        </div><!-- End .input-group -->
                        <div class="input-group">
                          <span class="input-group-addon"><span class="input-icon input-icon-password"></span><span class="input-text">Su Clave</span></span>
                          <input type="password" required class="form-control input-lg" id="clave" name="clave" placeholder="Su Clave">
                        </div>
                        <div class="input-group custom-checkbox">
                          <input type="checkbox" name="aceptar" id="aceptar" required /><span class="checbox-container"><i class="fa fa-check"></i></span>
                          He le&iacute;do y estoy deacuerdo con las <a href="politicas.php">Pol&iacute;ticas de Privacidad</a>.
                        </div>
                        <?php echo $advertencia; ?>
                        <input type="button" onClick="javascript:ValidarReg();" value="Crear mi cuenta" class="btn btn-custom-2 md-margin" />
                        <input type="hidden" name="estado" value="1" />
                        <input type="hidden" name="proceso" />
						          </fieldset>
                    </div><!-- End .col-md-6 -->
    						  </div><!-- End .row -->
        				</form>
                <?php 
                  }else{
                ?>
                <header class="content-title">
                  <h1 class="title">Cuenta Registrada</h1>
                  <p class="title-desc">Su cuenta se registr&oacute; exitosamente.</p>
                </header>
                <div class="xs-margin"></div><!-- space -->
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <p>Gracias por registrarse como cliente a partir de estos momentos Ud. puede hacer uso del sistema de carrito de compras y el sistema de pedidos en l&iacute;nea. Puede a&ntilde;adir productos. Eliminar Productos, Actualizar datos y cantidades y hacer su pedido en l&iacute;nea a su vez tambi&eacute;n realizar compras.</p>
                    <p>Atentamente<br>Dtpo. Ventas</p>
                    <p><a href="login.php" class="btn btn-custom-alt">Ingresar</a> | <a href="index.php" class="btn btn-custom-2">Volver al Index</a></p>
                  </div>
                </div>
                <?php 
                  }
                ?>
              </div><!-- End .col-md-12 -->
            </div><!-- End .row -->
          </div><!-- End .container -->
        
        </section><!-- End #content -->
        
      <?php include("includes/footer.php"); ?>
    </div><!-- End #wrapper -->
  </body>
</html>