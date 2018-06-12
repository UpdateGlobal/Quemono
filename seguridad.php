<?php include("cms/module/conexion.php"); ?>
<?php include("modules/session-core.php"); ?>
<!DOCTYPE html>
<!--[if IE 8]> <html class="ie8"> <![endif]-->
<!--[if IE 9]> <html class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html> <!--<![endif]-->
  <head>
    <?php include("includes/head.php"); ?>
    <meta http-equiv="refresh" content="7;URL=index.php" />
    <style id="custom-style"></style>
  </head>
  <body>
    <div id="wrapper">
      <?php include("includes/header.php"); ?>
      <section id="content">
        <div id="breadcrumb-container">
        	<div class="container">
    				<ul class="breadcrumb">
    					<li><a href="/index.php">Inicio</a></li>
    					<li class="active">Seguridad</li>
    				</ul>
        	</div>
        </div>
        <div class="container">
        	<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <h2>Seguridad</h2>
              <div class="lg-margin"></div><!-- space -->
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="alert alert-danger text-center" role="alert">
                    <h3>Usuario no autorizado</h3>
                    <p>Lo sentimos, ud. no es un usuario registrado en nuestro sistema. Si cree que se trata de un error vuelva a intentarlo ingresando el email y la clave correcta</p>
                    <p><span class="label label-danger">Si ha olvidado su clave puede pedir que sea enviada a su correo haciendo <a class="alert-span" href="/olvida.php">[Click aqu&iacute;]</a></span></p>
                  </div>
                  <p><a class="btn btn-custom-2" href="/index.php">Volver al inicio</a></p>
                </div>
              </div>
            </div><!-- End .col-md-6 -->
          </div><!-- End .container -->
        </section><!-- End #content -->
      <?php include("includes/footer.php"); ?>
    </div><!-- End #wrapper -->
  </body>
</html>