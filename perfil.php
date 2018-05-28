<?php include("cms/module/conexion.php"); ?>
<?php include("modules/session-core.php"); ?>
<?php
$varCliente = $_SESSION['IdCliente'];
/* $cambio   = $_REQUEST['cambio']; */
$consultaClientes = "SELECT * FROM clientes WHERE cod_cliente='$varCliente'";
$ejecutarClientes = mysqli_query($enlaces,$consultaClientes) or die('Consulta fallida: ' . mysqli_error($enlaces));
$filaCli = mysqli_fetch_array($ejecutarClientes);
$cod_cliente    = $filaCli['cod_cliente'];
$nombres        = $filaCli['nombres'];
$email          = $filaCli['email'];
$clave          = $filaCli['clave'];
$direccion      = $filaCli['direccion'];
$telefono       = $filaCli['telefono'];
?>
<!DOCTYPE html>
<!--[if IE 8]> <html class="ie8"> <![endif]-->
<!--[if IE 9]> <html class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html> <!--<![endif]-->
  <head>
    <?php include("includes/head.php"); ?>
    <style id="custom-style">

    </style>
  </head>
  <body>
    <div id="wrapper">
        <?php include("includes/header.php"); ?>
        <section id="content">
        	<div id="breadcrumb-container">
        		<div class="container">
    					<ul class="breadcrumb">
    						<li><a href="index.php">Inicio</a></li>
    						<li class="active">Perfil</li>
    					</ul>
        		</div>
        	</div>
        	<div class="container">
        		<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <h1 class="title">Datos de Perfil</h1>
                <p>En esta secci&oacute;n puede modificar sus datos de usuario.</p>
                <div class="lg-margin"></div><!-- space -->
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <p><strong>Nombres:</strong></p>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <p><?php echo $nombres; ?></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <p><strong>Direcci&oacute;n:</strong></p>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <p><?php echo $direccion; ?></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <p><strong>Tel&eacute;fono:</strong></p>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <p><?php echo $telefono; ?></p>
                  </div>
                </div>
                <div class="sm-margin"></div>
                <div class="row">
                  <div class="col-lg-12">
                    <a class="btn btn-custom-alt" href="perfil-editar.php?cod_cliente=<?php echo $cod_cliente; ?>">Cambiar Datos de Perfil</a>
                  </div>
                </div>
              </div><!-- End .col-md-6 -->
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="lg-margin"></div><!-- space -->
                <h2>Datos de la Cuenta</h2>
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <p><strong>E-mail:</strong></p>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <?php echo $email; ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <p><strong>Clave:</strong></p>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <p>**************</p>
                  </div>
                </div>
                <div class="sm-margin"></div>
                <div class="row">
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <p class="linea"><a class="btn btn-custom-2" href="clave-editar.php?cod_cliente=<?php echo $cod_cliente; ?>">Cambiar Datos de Cuenta</a></p>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <p style="float:right;"><a class="btn btn-danger" href="perfil-delete.php">Eliminar Cuenta</a></p>
                  </div>
                </div>
                <div class="sm-margin"></div><!-- space -->
              </div><!-- End .col-md-6 -->      
            </div><!-- End.row -->
          </div><!-- End .container -->

        </section><!-- End #content -->
      <?php include("includes/footer.php"); ?>
    </div><!-- End #wrapper -->
  </body>
</html>