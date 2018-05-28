<?php include("cms/module/conexion.php"); ?>
<?php include("modules/verificar-ingreso-cliente.php"); ?>
<?php
    $_SESSION['IdCliente']=$xCodCliente;
    /* if($_SESSION['IdProducto']==""){
        $link = "productos.php";
    }else{
        $link = "detalle.php?cod_producto=".$_SESSION['IdProducto']."&cod_categoria=".$_SESSION['IdCategoria'];
    } */
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
    					<li class="active">Login</li>
    				</ul>
        	</div>
        </div>
        <div class="container">
        	<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <h1 class="title">Bienvenido</h1>
              <p><strong><?php echo utf8_decode($xAlias); ?></strong> Bienvenido al sistema de carrito de compras</p>
              <p>A partir de estos momentos Ud. puede hacer uso del sistema de carrito de compras y el sistema de pedidos en l&iacute;nea. Puede a&ntilde;adir productos. Eliminar Productos, Actualizar datos y cantidades y hacer su pedido en l&iacute;nea a su vez tambi&eacute;n realizar compras.</p>
              <div class="lg-margin"></div>
              <p><a href="index.php" class="btn btn-custom-alt">Volver al Index</a> <a href="cerrar-sesion.php" class="btn btn-custom-2">Cerrar Sesi&oacute;n</a></p>
              <div class="lg-margin"></div>
            </div><!-- End .col-md-6 -->
          </div><!-- End.row -->
        </div><!-- End .container -->  
      </section><!-- End #content -->
      <?php include("includes/footer.php"); ?>
    </div><!-- End #wrapper -->
  </body>
</html>