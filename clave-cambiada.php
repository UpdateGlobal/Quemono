<?php include("cms/module/conexion.php"); ?>
<?php include("modules/session-core.php"); ?>
<?php
  $varCliente = $_SESSION['IdCliente'];
  $consultaClientes = "SELECT * FROM clientes WHERE cod_cliente='$varCliente'";
  $ejecutarClientes = mysqli_query($enlaces,$consultaClientes) or die('Consulta fallida: ' . mysqli_error($enlaces));
  $filaCli = mysqli_fetch_array($ejecutarClientes);
  $cod_cliente        = $filaCli['cod_cliente'];
  $email              = $filaCli['email'];
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
      function Validae(){
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
                  <p><strong>Hola <?php echo utf8_decode($xAlias); ?> tu clave se cambi&oacute; con &eacute;xito</strong></p>
                  <p>Un correo con todos sus datos ha sido enviado a <?php echo $email; ?>.<br>
                  No olvide inciar sesi&oacute;n con su nueva contrase&ntilde;a</p>
                  <p>Atentamente</br>
                  Dtpo. Ventas</p>
                  <p><a href="/perfil.php" class="btn btn-custom-alt">Volver al Perfil</a> <a href="/cerrar-sesion.php" class="btn btn-custom-2">CERRAR SESION</a></p>
                </div>
              </div>
              <div class=""></div>
            </form>
          </div><!-- End .container -->
        </section><!-- End #content -->
      <?php include("includes/footer.php"); ?>
    </div><!-- End #wrapper -->
  </body>
</html>