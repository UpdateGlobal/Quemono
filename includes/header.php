        <header id="header" class="header4">
            <div id="header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="header-top-left">
                                <ul id="top-links" class="clearfix">
                                    <?php if($xAlias!=""){ ?>
                                    <li><a href="perfil.php" title="Perfil"><span class="top-icon top-icon-user"></span><span class="">Perfil</span></a></li>
                                    <li><a href="carrito.php" title="Carrito"><span class="top-icon top-icon-cart"></span><span class="">Carrito</span></a></li>
                                    <li><a href="cerrar_sesion.php" title="Log Out"><span class="top-icon top-icon-check"></span><span class="">Log Out</span></a></li>
                                    <?php }else{ ?>
                                    <li><a href="login.php" title="Login"><span class="top-icon top-icon-pencil"></span><span class="">Login</span></a></li>
                                    <li><a href="registrarse.php" title="Registrarse"><span class="top-icon top-icon-user"></span><span class="">Registrarse</span></a></li>
                                    <?php } ?>
                                </ul>
                            </div><!-- End .header-top-left -->
                            <div class="header-top-right">

                                <div class="dropdown-cart-menu-container pull-right">
                                    <div class="btn-group dropdown-cart">
                                        <button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown">
                                            <span class="cart-menu-icon"></span>
                                            0 item(s) <span class="drop-price">- $0.00</span>
                                        </button>
                                        
                                        <div class="dropdown-menu dropdown-cart-menu pull-right clearfix" role="menu">
                                            <p class="dropdown-cart-description">Recently added item(s).</p>
                                            <ul class="dropdown-cart-product-list">
                                                <li class="item clearfix">
                                                    <a href="#" title="Delete item" class="delete-item"><i class="fa fa-times"></i></a>
                                                    <a href="#" title="Edit item" class="edit-item"><i class="fa fa-pencil"></i></a>
                                                    <figure>
                                                        <a href="#"><img src="images/item1.jpg" alt="phone 4"></a>
                                                    </figure>
                                                    <div class="dropdown-cart-details">
                                                        <p class="item-name">
                                                            <a href="#">Cam Optia AF Webcam </a>
                                                        </p>
                                                        <p>
                                                            1x
                                                            <span class="item-price">$499</span>
                                                        </p>
                                                    </div><!-- End .dropdown-cart-details -->
                                                </li>
                                                <li class="item clearfix">
                                                    <a href="#" title="Delete item" class="delete-item"><i class="fa fa-times"></i></a>
                                                    <a href="#" title="Edit item" class="edit-item"><i class="fa fa-pencil"></i></a>
                                                    <figure>
                                                        <a href="#"><img src="images/item2.jpg" alt="phone 2"></a>
                                                    </figure>
                                                    <div class="dropdown-cart-details">
                                                        <p class="item-name">
                                                            <a href="#">Iphone Case Cover Original</a>
                                                        </p>
                                                        <p>
                                                            1x
                                                            <span class="item-price">$499<span class="sub-price">.99</span></span>
                                                        </p>
                                                    </div><!-- End .dropdown-cart-details -->
                                                </li>
                                            </ul>    
                                            <ul class="dropdown-cart-total">
                                                <li><span class="dropdown-cart-total-title">Shipping:</span>$7</li>
                                                <li><span class="dropdown-cart-total-title">Total:</span>$1005<span class="sub-price">.99</span></li>
                                            </ul><!-- .dropdown-cart-total -->
                                            <div class="dropdown-cart-action">
                                                <p><a href="cart.html" class="btn btn-custom-2 btn-block">Cart</a></p>
                                                <p><a href="checkout.html" class="btn btn-custom btn-block">Checkout</a></p>
                                            </div><!-- End .dropdown-cart-action --> 
                                        </div><!-- End .dropdown-cart -->
                                    </div><!-- End .btn-group -->
                                </div><!-- End .dropdown-cart-menu-container -->

                                <div class="header-top-dropdowns pull-right">
                                    <div class="btn-group dropdown-money">
                                    </div><!-- End .btn-group -->
                                    <div class="btn-group dropdown-language">
                                    </div><!-- End .btn-group -->
                                </div><!-- End .header-top-dropdowns -->
                            </div><!-- End .header-top-right -->
                        </div><!-- End .col-md-12 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End #header-top -->

            <div id="inner-header" style="padding-top: 0px;">

                <div id="main-nav-container">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 clearfix">
                                <div id="menu-wrapper" class="clearfix">
                                    <div class="logo-container">
                                    <?php
                                        $consultarMet = 'SELECT * FROM metatags';
                                        $resultadoMet = mysqli_query($enlaces,$consultarMet) or die('Consulta fallida: ' . mysqli_error($enlaces));
                                        $filaMet = mysqli_fetch_array($resultadoMet);
                                            $xLogo   = $filaMet['logo'];
                                            $xAlt    = $filaMet['titulo'];
                                    ?> 
                                    <h1 class="logo clearfix">
                                        <span>QueMono</span>
                                        <a href="index.php" title="<?php echo $xAlt; ?>"><img src="cms/assets/img/meta/<?php echo $xLogo; ?>" alt="<?php echo $xAlt; ?>" width="250" /></a>
                                    </h1>
                                    <?php
                                        mysqli_free_result($resultadoMet); 
                                    ?>
                                </div><!-- End .logo-container -->
                                <div id="menu-right-side" class="clerfix">
                                <div id="quick-access">
                                <form class="form-inline quick-search-form" role="form" action="#">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Buscar producto...">
                                    </div><!-- End .form-inline -->
                                    <button type="submit" id="quick-search" class="btn btn-custom"></button>
                                </form>
                                </div><!-- End #quick-access -->
                                    <nav id="main-nav">
                                        <div id="responsive-nav">
                                            <div id="responsive-nav-button">
                                                Menu <span id="responsive-nav-button-icon"></span>
                                            </div><!-- responsive-nav-button -->
                                        </div>
                                        <ul class="menu clearfix">
                                        <li><a class="<?php echo ($menu == "inicio" ? "active" : "")?>" href="index.php">Inicio</a></li>
                                        <li><a class="<?php echo ($menu == "nosotros" ? "active" : "")?>" href="#">Nosotros</a></li>
                                        <?php
                                            $consultarPrincipal = "SELECT * FROM productos_principal WHERE menu=1 ORDER BY orden";
                                            $resultadoPrincipal = mysqli_query($enlaces,$consultarPrincipal) or die('Consulta fallida: ' . mysqli_error($enlaces));
                                            while($filaPri = mysqli_fetch_array($resultadoPrincipal)){
                                                $xCodigoPri = $filaPri['cod_principal'];
                                                $xPrincipal = $filaPri['principal'];
                                                $xMenu      = $filaPri['menu'];
                                                $xSlug      = $filaPri['slug'];
                                        ?>
                                        <li class="mega-menu-container"><a class="<?php echo ($menu == $xPrincipal ? "active" : "")?>" href="catalogo.php?cod_principal=<?php echo $xCodigoPri; ?>"><?php echo $xPrincipal; ?></a>
                                            <?php 
                                                $consultarCat = "SELECT * FROM productos_categorias WHERE cod_principal='$xCodigoPri'";
                                                $resultadoCat = mysqli_query($enlaces, $consultarCat);
                                                $Totalprincipal = mysqli_num_rows($resultadoCat);
                                                if($Totalprincipal==0){

                                                }else{
                                            ?>
                                            <div class="mega-menu clearfix">
                                                <?php
                                                    $consultarCategoria = "SELECT * FROM productos_categorias WHERE cod_principal='$xCodigoPri' ORDER BY orden";
                                                    $resultadoCategoria = mysqli_query($enlaces,$consultarCategoria) or die('Consulta fallida: ' . mysqli_error($enlaces));
                                                    while($filaCat = mysqli_fetch_array($resultadoCategoria)){
                                                        $xCodigoCat = $filaCat['cod_categoria'];
                                                        $xCodigoPri = $filaCat['cod_principal'];
                                                        $xCategoria = $filaCat['categoria'];
                                                        $xSlug      = $filaCat['slug'];
                                                ?>
                                                <div class="col-5">
                                                    <a href="categorias.php?cod_categoria=<?php echo $xCodigoCat; ?>" class="mega-menu-title"><?php echo $xCategoria; ?></a><!-- End .mega-menu-title -->

                                                    <ul class="mega-menu-list clearfix">
                                                        <?php
                                                            $numSubC = 0;
                                                            $consultarSubCat = "SELECT * FROM productos_sub_categorias WHERE cod_categoria='$xCodigoCat' AND estado='1' ORDER BY orden";
                                                            $resultadoSubCat = mysqli_query($enlaces, $consultarSubCat);
                                                            while($filaSC = mysqli_fetch_array($resultadoSubCat)){
                                                                $xCodigoSubC  = $filaSC['cod_sub_categoria'];
                                                                $xCodigoCat   = $filaSC['cod_categoria'];
                                                                $xSCategoria  = $filaSC['subcategoria'];
                                                                $xSlugc       = $filaSC['slug'];
                                                                $numSubC++;
                                                        ?>
                                                        <li><a href="subcategorias.php?cod_sub_categoria=<?php echo $xCodigoSubC; ?>"><?php echo $xSCategoria; ?></a></li>
                                                        <?php
                                                            }
                                                            mysqli_free_result($resultadoSubCat);
                                                        ?>
                                                    </ul>
                                                </div>
                                                <?php
                                                    }
                                                    mysqli_free_result($resultadoCategoria);
                                                ?>
                                            </div><!-- End .mega-menu -->
                                            <?php 
                                                }
                                            ?>
                                        </li>
                                        <?php
                                            }
                                            mysqli_free_result($resultadoPrincipal);
                                        ?>
                                        <li><a class="<?php echo ($menu == "promociones" ? "active" : "")?>" href="#">Promociones</a>
                                            <ul>
                                                <li><a href="product.html">Product</a></li>
                                                <li><a href="cart.html">Cart</a></li>
                                                <li><a href="category.html">Category</a>
                                                    <ul>
                                                        <li><a href="category-list.html">Category list</a></li>
                                                        <li><a href="category.html">Category Banner 1</a></li>
                                                        <li><a href="category-banner-2.html">Category Banner 2</a></li>
                                                        <li><a href="category-banner-3.html">Category Banner 3</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="blog.html">Blog</a>
                                                    <ul>
                                                        <li><a href="blog.html">Right Sidebar</a></li>
                                                        <li><a href="blog-sidebar-left.html">Left Sidebar</a></li>
                                                        <li><a href="blog-sidebar-both.html">Both Sidebar</a></li>
                                                        <li><a href="single.html">Blog Post</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="checkout.html">Checkout</a></li>
                                                <li><a href="aboutus.html">About Us</a></li>
                                                <li><a href="register-account.html">Register Account</a></li>
                                                <li><a href="compare-products.html">Compare Products</a></li>
                                                <li><a href="login.html">Login</a></li>
                                                <li><a href="404.html">404 Page</a></li>
                                                <li><a href="elements/tabs.html">Tabs</a></li>
                                                <li><a href="elements/titles.html">Titles</a></li>
                                                <li><a href="elements/typography.html">Typography</a></li>
                                                <li><a href="elements/collapses.html">collapses</a></li>
                                                <li><a href="elements/animations.html">animations</a></li>
                                                <li><a href="elements/grids.html">Grid System</a></li>
                                                <li><a href="elements/alerts.html">Alert Boxes</a></li>
                                                <li><a href="elements/buttons.html">Buttons</a></li>
                                                <li><a href="elements/medias.html">Media</a></li>
                                                <li><a href="elements/forms.html">Forms</a></li>
                                                <li><a href="elements/icons.html">Icons</a></li>
                                                <li><a href="elements/lists.html">Lists</a></li>
                                                <li><a href="elements/more.html">More</a></li>
                                                <li><a href="#">Classic</a>
                                                    <ul>
                                                        <li><a href="portfolio-2.html">Two Columns</a></li>
                                                        <li><a href="portfolio-3.html">Three Columns</a></li>
                                                        <li><a href="portfolio-4.html">Four Columns</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">Masonry</a>
                                                    <ul>
                                                        <li><a href="portfolio-masonry-2.html">Two Columns</a></li>
                                                        <li><a href="portfolio-masonry-3.html">Three Columns</a></li>
                                                        <li><a href="portfolio-masonry-4.html">Four Columns</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">Portfolio Posts</a>
                                                    <ul>
                                                        <li><a href="single-portfolio.html">Image Post</a></li>
                                                        <li><a href="single-portfolio-gallery.html">Gallery Post</a></li>
                                                        <li><a href="single-portfolio-video.html">Video Post</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a class="<?php echo ($menu == "contacto" ? "active" : "")?>" href="contacto.php">Contacto</a></li>
                                    </ul>
                                    </nav>
                                   </div><!-- End #menu-right-side -->
                                </div><!-- End #menu-wrapper -->
                            </div><!-- End .col-md-12 -->
                        </div><!-- End .row -->
                    </div><!-- End .container -->
                </div><!-- End #nav -->
            </div><!-- End #inner-header -->
        </header><!-- End #header -->