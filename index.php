<?php include("cms/module/conexion.php"); ?>
<?php include("modules/session-core.php"); ?>
<!DOCTYPE html>
<!--[if IE 8]> <html class="ie8"> <![endif]-->
<!--[if IE 9]> <html class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
    <head>
        <?php include("includes/head.php"); ?>
        <style id="custom-style">
        </style>
    </head>
    <body>
        <div id="wrapper">
            <?php $menu="inicio"; include("includes/header.php"); ?>
            <section id="content">
            	<div id="slider-rev-container">
                    <div id="slider-rev">
                        <ul>
                            <?php
                                $consultarBanner = "SELECT * FROM banners WHERE estado='1' ORDER BY orden";
                                $resultadoBanner = mysqli_query($enlaces,$consultarBanner) or die('Consulta fallida: ' . mysqli_error($enlaces));
                                while($filaBan = mysqli_fetch_array($resultadoBanner)){
                                    $xCodigo    = $filaBan['cod_banner'];
                                    $xImagen    = $filaBan['imagen'];
                                    $xLink      = $filaBan['link'];
                                    $xTitulo    = $filaBan['titulo'];
                                    $xTexto     = $filaBan['texto'];
                            ?>
                            <li data-transition="random" data-slotamount="10" data-masterspeed="400" data-saveperformance="on" data-title="<?php echo $xTitulo; ?>">
                                <img src="/images/revslider/dummy.png" alt="slidebg2" data-lazyload="/cms/assets/img/banner/<?php echo $xImagen; ?>" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat">
                                <div class="tp-mask-wrap" data-x="700" data-y="200" data-speed="600" data-start="700" data-easing="Power3.easeIn" data-endspeed="300"></div>
                                <div class="tp-caption rev-text sfl stl" data-x="720" data-y="190" data-speed="800" data-start="1100" data-easing="Power3.easeIn" data-endspeed="300" style="background-color: rgba(0, 0, 0, 0.5); padding: 8px; color: #fff;"><span class="tp-caption rev-title" style="color: #f1ce9e; position: relative;"><?php echo $xTitulo; ?></span><br><?php echo $xTexto; ?></div>
                                <div class="tp-caption sfb stb" data-x="720" data-y="400" data-speed="1200" data-start="2000" data-easing="Power3.easeIn" data-endspeed="300">
                                    <a href="<?php echo $xLink; ?>" class="btn btn-custom-2">Ver m&aacute;s</a>
                                </div>
                            </li>
                            <?php
                                }
                                mysqli_free_result($resultadoBanner);
                            ?>
                        </ul>
                    </div><!-- End #slider-rev -->
                </div><!-- End #slider-rev-container -->
                
                <div class="xlg-margin"></div><!-- Space -->

            	<div class="container">
            		<div class="row">
            			<div class="col-md-12">
            				
            				<div class="row">
            					
            					<div class="col-md-12 col-sm-12 col-xs-12 main-content">
                                    <div class="row home-banners">
                                        <?php
                                          $consultarCon = "SELECT * FROM ofertas WHERE cod_ofertas='1' AND estado='1'";
                                          $resultadoCon = mysqli_query($enlaces,$consultarCon) or die('Consulta fallida: ' . mysqli_error($enlaces));
                                          $filaCon = mysqli_fetch_array($resultadoCon);
                                            $xCodigo     = $filaCon['cod_ofertas'];
                                            $xImagen     = $filaCon['imagen'];
                                            $xLink       = $filaCon['link'];
                                        ?>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <a href="<?php echo $xLink; ?>"><img src="/cms/assets/img/ofertas/<?php echo $xImagen; ?>" class="img-responsive"></a>
                                        </div><!-- End .col-md-4 -->
                                        <?php
                                          mysqli_free_result($resultadoCon);
                                        ?>
                                        <?php
                                          $consultarCon = "SELECT * FROM ofertas WHERE cod_ofertas='2' AND estado='1'";
                                          $resultadoCon = mysqli_query($enlaces,$consultarCon) or die('Consulta fallida: ' . mysqli_error($enlaces));
                                          $filaCon = mysqli_fetch_array($resultadoCon);
                                            $xCodigo     = $filaCon['cod_ofertas'];
                                            $xImagen     = $filaCon['imagen'];
                                            $xLink       = $filaCon['link'];
                                        ?>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <a href="<?php echo $xLink; ?>"><img src="/cms/assets/img/ofertas/<?php echo $xImagen; ?>" class="img-responsive"></a>
                                        </div><!-- End .col-md-4 -->
                                        <?php
                                          mysqli_free_result($resultadoCon);
                                        ?>
                                        <?php
                                          $consultarCon = "SELECT * FROM ofertas WHERE cod_ofertas='3' AND estado='1'";
                                          $resultadoCon = mysqli_query($enlaces,$consultarCon) or die('Consulta fallida: ' . mysqli_error($enlaces));
                                          $filaCon = mysqli_fetch_array($resultadoCon);
                                            $xCodigo     = $filaCon['cod_ofertas'];
                                            $xImagen     = $filaCon['imagen'];
                                            $xLink       = $filaCon['link'];
                                        ?>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <a href="<?php echo $xLink; ?>"><img src="/cms/assets/img/ofertas/<?php echo $xImagen; ?>" class="img-responsive"></a>
                                        </div><!-- End .col-md-4 -->
                                        <?php
                                          mysqli_free_result($resultadoCon);
                                        ?>
                                    </div><!-- End .home-banners -->

                                    <div class="lg-margin"></div><!-- space -->

                                    <div class="latest-items carousel-wrapper">
                                        <header class="content-title">
                                            <div class="title-bg">
                                                <h2 class="title">Promociones</h2>
                                            </div><!-- End .title-bg -->
                                            <p class="title-desc">Suspendisse quis diam congue, pharetra tortor in, lobortis diam.</p>
                                        </header>

                                        <div class="carousel-controls">
                                            <div id="latest-items-slider-prev" class="carousel-btn carousel-btn-prev"></div><!-- End .carousel-prev -->
                                            <div id="latest-items-slider-next" class="carousel-btn carousel-btn-next carousel-space"></div><!-- End .carousel-next -->
                                        </div><!-- End .carousel-controls -->

                                        <div class="latest-items-slider owl-carousel">
                                            <?php
                                                $consultaPro = "SELECT * FROM productos WHERE promocion='1' AND estado='1' ORDER BY orden ASC";
                                                $resultadoPro = mysqli_query($enlaces, $consultaPro);
                                                while($filaPro = mysqli_fetch_array($resultadoPro)){
                                                    $xCod_producto    = $filaPro['cod_producto'];
                                                    $xCod_principal     = $filaPro['cod_principal'];
                                                    $xCod_categoria     = $filaPro['cod_categoria'];
                                                    $xCod_sub_categoria = $filaPro['cod_sub_categoria'];
                                                    $xSlugp           = $filaPro['slug'];
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
                                                        <a href="/producto/<?php echo $xSlugp; ?>">
                                                            <img src="/cms/assets/img/productos/<?php echo $xImagen; ?>" alt="<?php echo $xNom_producto; ?>" class="item-image">
                                                            <img src="/cms/assets/img/productos/hover/<?php echo $xHoverImagen; ?>" alt="<?php echo $xNom_producto; ?> hover" class="item-image-hover">
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
                                                    <span class="discount-rect"><?php echo $xDescuento; ?></span>
                                                    <?php } ?>
                                                </div><!-- End .item-image-wrapper -->
                                                <div class="item-meta-container">
                                                    <h3 class="item-name"><a href="/producto/<?php echo $xSlugp; ?>"><?php echo $xNom_producto; ?></a></h3>
                                                    <div class="item-action">
                                                        <form name="fcarrito<?php echo $xCodigo; ?>" id="fcarritop" action="/verificar.php" method="post">
                                                            <input type="hidden" name="cantidad" value="1" />
                                                            <input type="hidden" name="cod_producto" value="<?php echo $xCod_producto; ?>" />
                                                            <input type="hidden" name="cod_principal" value="<?php echo $xCod_principal; ?>" />
                                                            <input type="hidden" name="cod_categoria" value="<?php echo $xCod_categoria; ?>" />
                                                            <input type="hidden" name="cod_sub_categoria" value="<?php echo $xCod_sub_categoria; ?>" />
                                                            <button type="input" class="item-add-btn">
                                                                <span class="icon-cart-text"><i class="fa fa-shopping-cart" aria-hidden="true"></i> A&ntilde;adir</span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div><!-- End .item-meta-container -->
                                            </div><!-- End .item -->
                                            <?php
                                                }
                                                mysqli_free_result($resultadoPro);
                                            ?>
                                        </div><!--latest-items-slider -->
                                    </div><!-- End .latest-items -->

            						<div class="lg-margin"></div><!-- Space -->

    								<div class="row">
    									<div class="col-md-6 col-sm-6 col-xs-12">
                                            <?php
                                                $consultarCon = "SELECT * FROM contenidos WHERE cod_contenido='1' AND estado='1'";
                                                $resultadoCon = mysqli_query($enlaces,$consultarCon) or die('Consulta fallida: ' . mysqli_error($enlaces));
                                                $filaCon = mysqli_fetch_array($resultadoCon);
                                                    $xCodigo      = $filaCon['cod_contenido'];
                                                    $xTitulo      = utf8_encode($filaCon['titulo_contenido']);
                                                    $xImagen      = $filaCon['img_contenido'];
                                                    $xContenido   = utf8_encode($filaCon['contenido']);
                                                    $xEstado      = $filaCon['estado'];
                                            ?>
                                            <header class="content-title">
                                                <h2 class="title"><?php echo $xTitulo; ?></h2>
                                            </header>
                                            <!-- < ?php
                                                $xContenido_r = strip_tags($xContenido);
                                                $strCut = substr($xContenido_r,0,840);
                                                $xContenido_r = substr($strCut,0,strrpos($strCut, ' ')).'...';
                                            ?> -->
                                            <?php echo $xContenido; ?>
                                        </div><!-- End .col-md-6 -->
    									<div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="sm-margin visible-xs"></div><!-- space -->
                                            <img src="/cms/assets/img/nosotros/<?php echo $xImagen; ?>" alt="Showcase Venedor" class="img-responsive">
                                        </div><!-- End .col-md-5 -->
    								    <?php
                                            mysqli_free_result($resultadoCon);
                                        ?>
                                    </div><!-- End .row -->

            						<div class="xlg-margin"></div><!-- Space -->
            						
            						<div class="hot-items carousel-wrapper">
            							<header class="content-title">
    										<div class="title-bg">
    											<h2 class="title">En Venta</h2>
    										</div><!-- End .title-bg -->
    										<p class="title-desc">Suspendisse quis diam congue, pharetra tortor in.</p>
    									</header>

                                        <div class="carousel-controls">
                                            <div id="hot-items-slider-prev" class="carousel-btn carousel-btn-prev"></div><!-- End .carousel-prev -->
                                            <div id="hot-items-slider-next" class="carousel-btn carousel-btn-next carousel-space"></div><!-- End .carousel-next -->
                                        </div><!-- End .carousel-controls -->

                						<div class="hot-items-slider owl-carousel">
                                            <?php
                                                $consultaPro = "SELECT * FROM productos WHERE estado='1' ORDER BY orden ASC";
                                                $resultadoPro = mysqli_query($enlaces, $consultaPro);
                                                while($filaPro = mysqli_fetch_array($resultadoPro)){
                                                    $xCod_producto    = $filaPro['cod_producto'];
                                                    $xCod_principal     = $filaPro['cod_principal'];
                                                    $xCod_categoria     = $filaPro['cod_categoria'];
                                                    $xCod_sub_categoria = $filaPro['cod_sub_categoria'];
                                                    $xSlugp           = $filaPro['slug'];
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
                                                        <a href="/producto/<?php echo $xSlugp; ?>">
                                                            <img src="/cms/assets/img/productos/<?php echo $xImagen; ?>" alt="<?php echo $xNom_producto; ?>" class="item-image">
                                                            <img src="/cms/assets/img/productos/hover/<?php echo $xHoverImagen; ?>" alt="<?php echo $xNom_producto; ?> hover" class="item-image-hover">
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
                                                    <span class="discount-rect"><?php echo $xDescuento; ?></span>
                                                    <?php } ?>
                                                </div><!-- End .item-image-wrapper -->
                                                <div class="item-meta-container">
                                                    <h3 class="item-name"><a href="/producto/<?php echo $xSlugp; ?>"><?php echo $xNom_producto; ?></a></h3>
                                                    <div class="item-action">
                                                        <form name="fcarrito<?php echo $xCodigo; ?>" id="fcarritop" action="/verificar.php" method="post">
                                                            <input type="hidden" name="cantidad" value="1" />
                                                            <input type="hidden" name="cod_producto" value="<?php echo $xCod_producto; ?>" />
                                                            <input type="hidden" name="cod_principal" value="<?php echo $xCod_principal; ?>" />
                                                            <input type="hidden" name="cod_categoria" value="<?php echo $xCod_categoria; ?>" />
                                                            <input type="hidden" name="cod_sub_categoria" value="<?php echo $xCod_sub_categoria; ?>" />
                                                            <button type="input" class="item-add-btn">
                                                                <span class="icon-cart-text"><i class="fa fa-shopping-cart" aria-hidden="true"></i> A&ntilde;adir</span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div><!-- End .item-meta-container --> 
                                            </div><!-- End .item -->
                                            <?php
                                                }
                                                mysqli_free_result($resultadoPro);
                                            ?>
                						</div><!--hot-items-slider -->
                                    </div><!-- End .hot-items -->
                                </div><!-- End .col-md-12 -->
                            </div><!-- End .row -->

                            <div class="lg-margin"></div><!-- Space -->
            				<div id="brand-slider-container" class="carousel-wrapper">
            					<header class="content-title">
    								<div class="title-bg">
    									<h2 class="title">Nuestras Marcas</h2>
    								</div><!-- End .title-bg -->
    							</header>
                                <div class="carousel-controls">
                                    <div id="brand-slider-prev" class="carousel-btn carousel-btn-prev">
                                    </div><!-- End .carousel-prev -->
                                    <div id="brand-slider-next" class="carousel-btn carousel-btn-next carousel-space">
                                    </div><!-- End .carousel-next -->
                                </div><!-- End .carousel-controllers -->
                                <div class="sm-margin"></div><!-- space -->
                                <div class="row">
                                    <div class="brand-slider owl-carousel">
                                        <?php
                                            $consultarCarrusel = "SELECT * FROM carrusel WHERE estado='1' ORDER BY orden";
                                            $resultadoCarrusel = mysqli_query($enlaces,$consultarCarrusel) or die('Consulta fallida: ' . mysqli_error($enlaces));
                                            while($filaCar = mysqli_fetch_array($resultadoCarrusel)){
                                                $xCod_marca = $filaCar['cod_carrusel'];
                                                $xMarca     = $filaCar['imagen'];
                                                $xSlugm     = $filaCar['slug'];
                                        ?>
                                        <a href="/marcas/<?php echo $xSlugm; ?>"><img src="/cms/assets/img/carrusel/<?php echo $xMarca; ?>" /></a>
                                        <?php
                                            }
                                            mysqli_free_result($resultadoCarrusel);
                                        ?>
                                    </div><!-- End .brand-slider -->
                                </div><!-- End .row -->
            				</div><!-- End #brand-slider-container -->
            			</div><!-- End .col-md-12 -->
            		</div><!-- End .row -->
    			</div><!-- End .container -->
            </section><!-- End #content -->
            <?php include("includes/footer.php"); ?>
        </div><!-- End #wrapper -->
    </body>
</html>