<?php include("cms/module/conexion.php"); ?>
<?php include("modules/session-core.php"); ?>
<?php 
    $cod_producto  = $_REQUEST['cod_producto'];
    $consultaPro   = "SELECT cp.cod_categoria, cp.categoria, scp.cod_sub_categoria, scp.subcategoria, mp.cod_carrusel, mp.marca, p.* FROM productos_categorias as cp, productos_sub_categorias as scp, carrusel as mp, productos as p WHERE p.cod_categoria=cp.cod_categoria AND p.cod_sub_categoria=scp.cod_sub_categoria AND p.cod_carrusel=mp.cod_carrusel AND cod_producto=$cod_producto ORDER BY orden ASC";
    $resultadoPro  = mysqli_query($enlaces, $consultaPro);
    $filaPro       = mysqli_fetch_array($resultadoPro);
        $xCod_producto      = $filaPro['cod_producto'];
        $xCod_categoria     = $filaPro['cod_categoria'];
        $xCategoriap        = $filaPro['categoria'];
        $xCod_sub_categoria = $filaPro['cod_sub_categoria'];
        $xSubCategoriap     = $filaPro['subcategoria'];
        $xNom_producto      = mysqli_real_escape_string($enlaces, $filaPro['nom_producto']);
        $xDescripcion       = mysqli_real_escape_string($enlaces, $filaPro['descripcion']);
        $xCaracteristicas   = mysqli_real_escape_string($enlaces, $filaPro['caracteristicas']);
        $xInfo_adicional    = mysqli_real_escape_string($enlaces, $filaPro['info_adicional']);
        $xVideo             = $filaPro['video'];
        $xStock             = $filaPro['stock'];
        $xCodigox           = $filaPro['codigo'];
        $xPrecio_oferta     = number_format($filaPro['precio_oferta'],2);
        $xPrecio_normal     = number_format($filaPro['precio_normal'],2);
        $xDescuento         = $filaPro['descuento'];
        $xPromocion         = $filaPro['promocion'];
        $xFecha             = $filaPro['fecha_ing'];
        $xImagen            = $filaPro['imagen'];
        $xH_Imagen          = $filaPro['h_imagen'];
        $xCod_carrusel      = $filaPro['cod_carrusel'];
        $xMarca             = $filaPro['marca'];
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
    						<li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                            <li><a href="productos.php">Productos</a></li>
                            <li><a href="categorias.php?cod_categoria=<?php echo $xCod_categoria; ?>"><?php echo $xCategoriap; ?></a></li>
                            <li><a href="subcategorias.php?cod_sub_categoria=<?php echo $xCod_sub_categoria; ?>"><?php echo $xSubCategoriap; ?></a></li>
    						<li class="active"><?php echo $xNom_producto; ?></li>
    					</ul>
            		</div>
            	</div>
            	<div class="container">
            		<div class="row">
            			<div class="col-md-12">
            				<div class="row">
            				
            				    <div class="col-md-6 col-sm-12 col-xs-12 product-viewer clearfix">

                					<div id="product-image-carousel-container">
                						<ul id="product-carousel" class="celastislide-list" style="height: 100px;">
        	        						<li class="active-slide"><a data-rel='prettyPhoto[product]' href="cms/assets/img/productos/<?php echo $xImagen; ?>" data-image="cms/assets/img/productos/<?php echo $xImagen; ?>" data-zoom-image="cms/assets/img/productos/<?php echo $xImagen; ?>" class="product-gallery-item"><img src="cms/assets/img/productos/<?php echo $xImagen; ?>" alt="<?php echo $xNom_producto; ?>"></a></li>
                                            <?php 
                                                $galeria="SELECT * FROM productos_galeria WHERE cod_producto='$cod_producto'";
                                                $ejecutag=mysqli_query($enlaces, $galeria);
                                                while($filagp=mysqli_fetch_array($ejecutag)){
                                                    $xImgG = $filagp['imagen'];
                                            ?>
                                                <li><a data-rel='prettyPhoto[product]' href="cms/assets/img/productos/galeria/<?php echo $xImgG; ?>" data-image="cms/assets/img/productos/galeria/<?php echo $xImgG; ?>" data-zoom-image="cms/assets/img/productos/galeria/<?php echo $xImgG; ?>" class="product-gallery-item"><img src="cms/assets/img/productos/galeria/<?php echo $xImgG; ?>" alt="Phone photo 2"></a></li>
                                            <?php 
                                                }

                                            ?>
                					   </ul><!-- End product-carousel -->
                					</div>

                					<div id="product-image-container">
                						<figure>
                                            <img src="cms/assets/img/productos/<?php echo $xImagen; ?>" data-zoom-image="cms/assets/img/productos/<?php echo $xImagen; ?>" alt="<?php echo $xNom_producto; ?>" id="product-image">
                							<figcaption class="item-price-container">
                                                <?php
                                                    if($xPrecio_oferta!=0){
                                                ?>
                                                <span class="old-price"><?php echo $xPrecio_normal; ?></span>
                                                <span class="item-price"><?php echo $xPrecio_oferta; ?></span>
                                                <?php }else{ ?>
                                                <span class="item-price"><?php echo $xPrecio_normal; ?></span>
                                                <?php } ?>
                                            </figcaption>
                						</figure>
                					</div><!-- product-image-container -->
                				</div><!-- End .col-md-6 -->

            				    <div class="col-md-6 col-sm-12 col-xs-12 product">
                                    <div class="lg-margin visible-sm visible-xs"></div><!-- Space -->
                					<h1 class="product-name"><?php echo $xNom_producto; ?></h1>
                    				<ul class="product-list">
                                        <li><span>Disponibilidad:</span> <?php echo $xStock; ?></li>
                                        <li><span>C&oacute;digo de Producto:</span> <?php echo $xCodigox; ?></li>
                                        <li><span>Marca:</span> <?php echo $xMarca; ?></li>
                                    </ul>
                				    <hr>
                                    <div class="product-add clearfix">
        								<div class="custom-quantity-input">
        									<input type="text" name="quantity" value="1">
        								</div>
        								<button class="btn btn-custom-2"><i class="fa fa-shopping-cart" aria-hidden="true"></i> A&ntilde;adir al Carrito</button>
        							</div><!-- .product-add -->
                                    <div class="md-margin"></div><!-- Space -->
                					<div class="product-extra clearfix">
        								<div class="share-button-group">
        									<!-- AddThis Button BEGIN -->
        									<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
            									<a class="addthis_button_facebook"></a>
            									<a class="addthis_button_twitter"></a>
            									<a class="addthis_button_email"></a>
            									<a class="addthis_button_print"></a>
            									<a class="addthis_button_compact"></a><a class="addthis_counter addthis_bubble_style"></a>
        									</div>
        									<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
        									<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52b2197865ea0183"></script>
        									<!-- AddThis Button END -->
        								</div><!-- End .share-button-group -->
                					</div>
                				</div><!-- End .col-md-6 -->
            				</div><!-- End .row -->
            				
            				<div class="lg-margin2x"></div><!-- End .space -->
            				
            				<div class="row">
            					<div class="col-md-9 col-sm-12 col-xs-12">		
            						<div class="tab-container left product-detail-tab clearfix">
            							<ul class="nav-tabs">
                                            <?php
                                                if($xDescripcion!=""){
                                            ?>
                                            <li class="active"><a href="#overview" data-toggle="tab">Descripci&oacute;n</a></li>
                                            <?php } ?>
                                            <?php
                                                if($xCaracteristicas!=""){
                                            ?>
                                            <li><a href="#description" data-toggle="tab">Caracter&iacute;sticas</a></li>
    										<?php } ?>
                                            <?php
                                                if($xInfo_adicional!=""){
                                            ?>
                                            <li><a href="#additional" data-toggle="tab">Informaci&oacute;n Adicional</a></li>
    										<?php } ?>
                                            <?php
                                                if($xVideo!=""){
                                            ?>
                                            <li><a href="#video" data-toggle="tab">V&iacute;deo</a></li>
                                            <?php } ?>
                                        </ul>
            							<div class="tab-content clearfix">
            								<?php
                                                if($xDescripcion!=""){
                                            ?>
                                            <div class="tab-pane active" id="overview">
                                                <div class="lista-contenido">
            									   <?php echo $xDescripcion; ?> 
                                                </div>
            								</div><!-- End .tab-pane -->
            								<?php } ?>
                                            <?php
                                                if($xCaracteristicas!=""){
                                            ?>
                                            <div class="tab-pane" id="description">
    								            <div class="lista-contenido">
                                                    <?php echo $xCaracteristicas; ?>
                                                </div>
            								</div><!-- End .tab-pane -->
                                            <?php } ?>
            								<?php
                                                if($xInfo_adicional!=""){
                                            ?>
                                            <div class="tab-pane" id="additional">
                							    <div class="lista-contenido">
                                                    <?php echo $xInfo_adicional; ?>
                                                </div>
                                            </div><!-- End .tab-pane -->
                							<?php } ?>
                                            <?php
                                                if($xVideo!=""){
                                            ?>
                                            <div class="tab-pane" id="video">
                								<div class="video-container">
                									<strong>A Video about Product</strong>
                									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur adipisci esse.</p>
                									<hr>
                									<?php echo $xVideo; ?>		
                								</div><!-- End .video-container -->
                							</div><!-- End .tab-pane -->
                                            <?php } ?>
                                        </div><!-- End .tab-content -->
                                    </div><!-- End .tab-container -->
            				        <div class="lg-margin visible-xs"></div>
            				    </div><!-- End .col-md-9 -->
            				    <div class="lg-margin2x visible-sm visible-xs"></div><!-- Space -->
            					<div class="col-md-3 col-sm-12 col-xs-12 sidebar">
                                    <div class="widget related">
                                        <h3>Productos Relacionados</h3>
            							
                						<div class="related-slider flexslider sidebarslider">
                							<ul class="related-list clearfix">
                								<li>
                									
                                                    <div class="related-product clearfix">
                										<figure>
                											<img src="images/products/thumbnails/item1.jpg" alt="item1">
                										</figure>
                										<h5><a href="#">Jacket Suiting Blazer</a></h5>
                										<div class="ratings-container">
        													<div class="ratings">
        														<div class="ratings-result" data-result="84"></div>
        													</div><!-- End .ratings -->
        												</div><!-- End .rating-container -->
                										<div class="related-price">$40</div><!-- End .related-price -->
                									</div><!-- End .related-product -->
                										
                									<div class="related-product clearfix">
                										<figure>
                											<img src="images/products/thumbnails/item2.jpg" alt="item2">
                										</figure>
                										<h5><a href="#">Gap Graphic Cuffed</a></h5>
                										<div class="ratings-container">
        													<div class="ratings">
        														<div class="ratings-result" data-result="84"></div>
        													</div><!-- End .ratings -->
        												</div><!-- End .rating-container -->
                										<div class="related-price">18$</div><!-- End .related-price -->
                									</div><!-- End .related-product -->
                										
                									<div class="related-product clearfix">
                										<figure>
                											<img src="images/products/thumbnails/item3.jpg" alt="item3">
                										</figure>
                										<h5><a href="#">Women's Lauren Dress</a></h5>
                										<div class="ratings-container">
        													<div class="ratings">
        														<div class="ratings-result" data-result="84"></div>
        													</div><!-- End .ratings -->
        												</div><!-- End .rating-container -->
                    									<div class="related-price">$30</div><!-- End .related-price -->
                    								</div><!-- End .related-product -->
                    							
                                                </li>
                								<li>
                									<div class="related-product clearfix">
                										<figure>
                											<img src="images/products/thumbnails/item4.jpg" alt="item4">
                										</figure>
                										<h5><a href="#">Swiss Mobile Phone</a></h5>
                										<div class="ratings-container">
        													<div class="ratings">
        														<div class="ratings-result" data-result="64"></div>
        													</div><!-- End .ratings -->
        												</div><!-- End .rating-container -->
                										<div class="related-price">$39</div><!-- End .related-price -->
                									</div><!-- End .related-product -->
                										
                									<div class="related-product clearfix">
                										<figure>
                											<img src="images/products/thumbnails/item5.jpg" alt="item5">
                										</figure>
                										<h5><a href="#">Zwinzed HeadPhones</a></h5>
                										<div class="ratings-container">
        													<div class="ratings">
        														<div class="ratings-result" data-result="94"></div>
        													</div><!-- End .ratings -->
        												</div><!-- End .rating-container -->
                										<div class="related-price">$18.99</div><!-- End .related-price -->
                									</div><!-- End .related-product -->
                										
                									<div class="related-product clearfix">
                										<figure>
                											<img src="images/products/thumbnails/item6.jpg" alt="item6">
                										</figure>
                										<h5><a href="#">Kless Man Suit</a></h5>
                										<div class="ratings-container">
        													<div class="ratings">
        														<div class="ratings-result" data-result="74"></div>
        													</div><!-- End .ratings -->
        												</div><!-- End .rating-container -->
                										<div class="related-price">$99</div><!-- End .related-price -->
                									</div><!-- End .related-product -->
                								</li>
                								<li>	
                									<div class="related-product clearfix">
                										<figure>
                											<img src="images/products/thumbnails/item2.jpg" alt="item2">
                										</figure>
                										<h5><a href="#">Gap Graphic Cuffed</a></h5>
                										<div class="ratings-container">
        													<div class="ratings">
        														<div class="ratings-result" data-result="84"></div>
        													</div><!-- End .ratings -->
        												</div><!-- End .rating-container -->
                										<div class="related-price">$17</div><!-- End .related-price -->
                									</div><!-- End .related-product -->
                										
                									<div class="related-product clearfix">
                										<figure>
                											<img src="images/products/thumbnails/item4.jpg" alt="item4">
                										</figure>
                										<h5><a href="#">Women's Lauren Dress</a></h5>
                										<div class="ratings-container">
        													<div class="ratings">
        														<div class="ratings-result" data-result="84"></div>
        													</div><!-- End .ratings -->
        												</div><!-- End .rating-container -->
                										<div class="related-price">$30</div><!-- End .related-price -->
                									</div><!-- End .related-product -->

                								</li>
                							</ul>
                						</div><!-- End .related-slider -->
                					</div><!-- End .widget -->
                						
            					</div><!-- End .col-md-4 -->
            				</div><!-- End .row -->
                            <div class="lg-margin2x"></div><!-- Space -->
            				<div class="purchased-items-container carousel-wrapper">
                                <header class="content-title">
                                    <div class="title-bg">
                                        <h2 class="title">Promociones</h2>
                                    </div><!-- End .title-bg -->
                                    <p class="title-desc">Morbi fermentum malesuada ligula, sed iaculis ligula vestibulum vitae.</p>
                                </header>
                                <div class="carousel-controls">
                                    <div id="purchased-items-slider-prev" class="carousel-btn carousel-btn-prev"></div><!-- End .carousel-prev -->
                                    <div id="purchased-items-slider-next" class="carousel-btn carousel-btn-next carousel-space"></div><!-- End .carousel-next -->
                                </div><!-- End .carousel-controllers -->
                                <div class="purchased-items-slider owl-carousel">
                                    <?php
                                        $consultaPro = "SELECT * FROM productos WHERE estado='1' ORDER BY orden ASC";
                                        $resultadoPro = mysqli_query($enlaces, $consultaPro);
                                        while($filaPro = mysqli_fetch_array($resultadoPro)){
                                            $xCod_producto    = $filaPro['cod_producto'];
                                            $xNom_producto    = mysqli_real_escape_string($enlaces, $filaPro['nom_producto']);
                                            $xPrecio_oferta   = number_format($filaPro['precio_oferta'],2);
                                            $xPrecio_normal   = number_format($filaPro['precio_normal'],2);
                                            $xImagen          = $filaPro['imagen'];
                                            $xHoverImagen     = $filaPro['h_imagen'];
                                            $xDescuento       = $filaPro['descuento'];
                                            $xFecha           = $filaPro['fecha_ing'];
                                    ?>
                                    <div class="item item-hover">
                                        <div class="item-image-wrapper">
                                            <figure class="item-image-container">
                                                <a href="producto.php?cod_producto=<?php echo $xCod_producto; ?>">
                                                    <img src="cms/assets/img/productos/<?php echo $xImagen; ?>" alt="<?php echo $xNom_producto; ?>" class="item-image">
                                                    <img src="cms/assets/img/productos/hover/<?php echo $xHoverImagen; ?>" alt="<?php echo $xNom_producto; ?>" class="item-image-hover">
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
                                                <a href="producto.php?cod_producto=<?php echo $xCod_producto; ?>" class="item-add-btn">
                                                    <span class="icon-cart-text"><i class="fa fa-shopping-cart" aria-hidden="true"></i> A&ntilde;adir</span>
                                                </a>
                                            </div><!-- End .item-action -->
                                        </div><!-- End .item-meta-container -->
                                    </div><!-- End .item -->
                                    <?php
                                        }
                                        mysqli_free_result($resultadoPro);
                                    ?>
                                </div><!--purchased-items-slider -->
                            </div><!-- End .purchased-items-container -->
            			</div><!-- End .col-md-12 -->
            		</div><!-- End .row -->
    			</div><!-- End .container -->
            </section><!-- End #content -->
            <?php include("includes/footer.php"); ?>
        </div><!-- End #wrapper -->
    </body>
</html>