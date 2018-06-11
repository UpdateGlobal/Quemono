<?php include("cms/module/conexion.php"); ?>
<?php include("modules/verificar-ingreso-cliente.php"); ?>
<?php
    $_SESSION['IdCliente']=$xCodCliente;
    if($_SESSION['IdProducto']==""){
        $link = "/productos.php";
    }else{
        $link = "/producto-detalle.php?cod_producto=".$_SESSION['IdProducto']."&cod_categoria=".$_SESSION['IdCategoria']."&cod_sub_categoria=".$_SESSION['IdSCategoria']."&cod_sub_subcategoria=".$_SESSION['IdSSCategoria'];
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
  </head>
  <body>
    <div id="wrapper">
      <?php include("includes/header.php"); ?>
      <section id="content">
        <div id="breadcrumb-container">
        	<div class="container">
    				<ul class="breadcrumb">
    					<li><a href="/index.php">Inicio</a></li>
    					<li class="active">Confirmaci&oacute;n</li>
    				</ul>
        	</div>
        </div>
        <div class="container">
        	<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <h1 class="title">&iexcl;Listo!</h1>
              <p><strong>Hola <?php echo utf8_decode($xAlias); ?> Tus pedidos se enviaron con &eacute;xito</strong></p>
              <p>En breves momentos un representante de nuestra empresa se pondra en contacto con ud.</p>
              <p>Atentamente </br>
              Dtpo. Ventas</p>
              <p><a href="/index.php" class="btn btn-custom-alt">Volver al Inicio</a> <a href="/cerrar-sesion.php" class="btn btn-custom-2">Cerrar sesi&oacute;n</a></p>
              <div class="lg-margin"></div>
            </div><!-- End .col-md-6 -->
          </div><!-- End.row -->
        </div><!-- End .container -->  
      </section><!-- End #content -->
      <?php include("includes/footer.php"); ?>
    </div><!-- End #wrapper -->
  </body>
</html>