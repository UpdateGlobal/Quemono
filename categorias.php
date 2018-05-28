<?php include("cms/module/conexion.php"); ?>
<?php include("modules/session-core.php"); ?>
<?php $cod_categoria = $_REQUEST['cod_categoria']; ?>
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
            <?php
                $consultarCatmenu = "SELECT * FROM productos_categorias WHERE cod_categoria='$cod_categoria' ORDER BY orden";
                $resultadoCatmenu = mysqli_query($enlaces,$consultarCatmenu) or die('Consulta fallida: ' . mysqli_error($enlaces));
                $filaCat = mysqli_fetch_array($resultadoCatmenu);
                    $xCatmenu = $filaCat['categoria'];
            ?>
            <?php include("includes/header.php"); ?>
            <section id="content">
            	<div id="breadcrumb-container">
                    <div class="container">
                        <ul class="breadcrumb">
                            <li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                            <li><a hfref="productos.php">Productos</a></li>
                            <li class="active">aa</li>
                        </ul>
                    </div>
                </div>
            	<div class="container">
            		<div class="row">
            			<div class="col-md-12">
            				<div class="row">
            					<div class="col-md-9 col-sm-8 col-xs-12 main-content">
                                    <h1 class="title">Productos</h1>
                                    <div class="lg-margin"></div><!-- space -->
            						<div class="category-toolbar clearfix">
    									<div class="toolbox-filter clearfix">
    										<div class="sort-box">
                                                <span class="separator"><strong>Visualizaci&oacute;n:</strong></span>
                                            </div>
    										<div class="view-box">
    											<a href="productos.php" class="active icon-button icon-grid"><i class="fa fa-th-large"></i></a>
    											<a href="productos-list.php" class="icon-button icon-list"><i class="fa fa-th-list"></i></a>
    										</div><!-- End .view-box -->
    										
    									</div><!-- End .toolbox-filter -->
    									<div class="toolbox-pagination clearfix">
    										<ul class="pagination">
    											<li class="active"><a href="#">1</a></li>
    											<li><a href="#">2</a></li>
    											<li><a href="#">3</a></li>
    											<li><a href="#">4</a></li>
    											<li><a href="#">5</a></li>
    											<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
    										</ul>
    									</div><!-- End .toolbox-pagination -->
            	                        
            						</div><!-- End .category-toolbar -->
            						<div class="md-margin"></div><!-- .space -->
            						<div class="category-item-container">
            						    <div class="row">
                                            <?php
                                                $consultaPro = "SELECT * FROM productos WHERE estado='1' ORDER BY orden ASC";
                                                $resultadoPro = mysqli_query($enlaces, $consultaPro);
                                                while($filaPro = mysqli_fetch_array($resultadoPro)){
                                                    $xCod_producto    = $filaPro['cod_producto'];
                                                    $xNom_producto    = mysqli_real_escape_string($enlaces, $filaPro['nom_producto']);
                                                    $xPrecio_oferta   = number_format($filaPro['precio_oferta'],2);
                                                    $xPrecio_normal   = number_format($filaPro['precio_normal'],2);
                                                    $xImagen          = $filaPro['imagen'];
                                                    $xDescuento       = $filaPro['descuento'];
                                                    $xHoverImagen     = $filaPro['h_imagen'];
                                                    $xFecha           = $filaPro['fecha_ing'];
                                            ?>
                							<div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                    <div class="item-image-wrapper">
                                                        <figure class="item-image-container">
                                                            <a href="producto.php?cod_producto=<?php echo $xCod_producto; ?>">
                                                                <img src="cms/assets/img/productos/<?php echo $xImagen; ?>" alt="<?php echo $xNom_producto; ?>" class="item-image">
                                                                <?php
                                                                    if($xHoverImagen!=""){
                                                                ?>
                                                                <img src="cms/assets/img/productos/hover/<?php echo $xHoverImagen; ?>" alt="<?php echo $xNom_producto; ?> Hover" class="item-image-hover">
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                <img src="cms/assets/img/productos/<?php echo $xImagen; ?>" alt="<?php echo $xNom_producto; ?> Hover" class="item-image-hover">
                                                                <?php    
                                                                    }
                                                                ?>
                                                            </a>
                                                        </figure>
                                                        <div class="item-price-container">
                                                        <?php
                                                            if($xPrecio_oferta!=0){
                                                        ?>
                                                            <span class="old-price"><?php echo $xPrecio_normal; ?></span>
                                                            <span class="item-price"><?php echo $xPrecio_oferta; ?></span>
                                                        <?php }else{ ?>
                                                            <span class="item-price"><?php echo $xPrecio_normal; ?></span>
                                                        <?php } ?>
                                                        </div><!-- End .item-price-container -->
                                                        <?php
                                                            $today = date("Y-m-d");
                                                            if($xFecha == $today){
                                                        ?>
                                                        <span class="new-rect">Nuevo</span>
                                                        <?php
                                                            }else{ }
                                                        ?>
                                                        <?php
                                                            if($xDescuento==""){
                                                            }else{
                                                        ?>
                                                        <span class="discount-rect">-25%</span>
                                                        <?php } ?>
                                                    </div><!-- End .item-image-wrapper -->
                                                    <div class="item-meta-container">
                                                        <h3 class="item-name"><a href="producto.php?cod_producto=<?php echo $xCod_producto; ?>"><?php echo $xNom_producto; ?></a></h3>
                                                        <div class="item-action">
                                                            <a href="#" class="item-add-btn">
                                                                <span class="icon-cart-text"><i class="fa fa-shopping-cart" aria-hidden="true"></i> A&ntilde;adir</span>
                                                            </a>
                                                        </div><!-- End .item-action -->
                                                    </div><!-- End .item-meta-container --> 
                                                </div><!-- End .item -->
                                            </div><!-- End .col-md-4 -->
                                            <?php
                                                }
                                                mysqli_free_result($resultadoPro);
                                            ?>
                                        </div><!-- End .row -->
            					    </div><!-- End .category-item-container -->
            						
            						<div class="pagination-container clearfix">
            							<div class="pull-right">
    										<ul class="pagination">
    											<li class="active"><a href="#">1</a></li>
    											<li><a href="#">2</a></li>
    											<li><a href="#">3</a></li>
    											<li><a href="#">4</a></li>
    											<li><a href="#">5</a></li>
    											<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
    										</ul>
            							</div><!-- End .pull-right -->
            						</div><!-- End pagination-container -->
            					</div><!-- End .col-md-9 -->
                                <?php include("includes/sidebar.php"); ?>
            				</div><!-- End .row -->
            			</div><!-- End .col-md-12 -->
            		</div><!-- End .row -->
    			</div><!-- End .container -->
            </section><!-- End #content -->
            <?php include("includes/footer.php"); ?>
        </div><!-- End #wrapper -->
    </body>
</html>