        <header id="header" class="header4">
            <div id="header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="header-top-left">
                                <ul id="top-links" class="clearfix">
                                    <?php if($xAlias!=""){ ?>
                                    <li><a href="/perfil.php" title="Perfil"><span class="top-icon top-icon-user"></span><span class="">Perfil</span></a></li>
                                    <li><a href="/carrito.php" title="Carrito"><span class="top-icon top-icon-cart"></span><span class="">Carrito</span></a></li>
                                    <li><a href="/cerrar_sesion.php" title="Log Out"><span class="top-icon top-icon-check"></span><span class="">Log Out</span></a></li>
                                    <?php }else{ ?>
                                    <li><a href="/login.php" title="Login"><span class="top-icon top-icon-pencil"></span><span class="">Login</span></a></li>
                                    <li><a href="/registrarse.php" title="Registrarse"><span class="top-icon top-icon-user"></span><span class="">Registrarse</span></a></li>
                                    <?php } ?>
                                </ul>
                            </div><!-- End .header-top-left -->
                            <div class="header-top-right">
                                <?php if($xAlias!=""){ ?>
                                    <?php
                                        if(isset($_SESSION['IdOrden'])){
                                            $varOrden   = $_SESSION['IdOrden'];
                                        }else{
                                            $varOrden   = 0;
                                        }
                                        if(isset($_SESSION['IdCliente'])){
                                            $varCliente = $_SESSION['IdCliente'];
                                        }else{
                                            $varCliente = "";
                                        }
                                        $totalM = 0;
                                        $carritoM = "SELECT * FROM productos as p, carrito as c WHERE c.cod_orden='$varOrden' AND c.cod_cliente='$varCliente' AND p.cod_producto=c.cod_producto";
                                        $resultadoM = mysqli_query($enlaces,$carritoM);
                                        $filaM = mysqli_fetch_assoc($resultadoM);
                                        $totalCarritoM = mysqli_num_rows($resultadoM);
                                        $nump = $totalCarritoM;
                                    ?>
                                    <div class="dropdown-cart-menu-container pull-right">
                                        <div class="btn-group dropdown-cart">
                                            <button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown">
                                                <span class="cart-menu-icon"></span>
                                                <?php echo $nump; ?> Compra(s)
                                            </button>
                                            <?php
                                                if($totalCarritoM>0){
                                            ?>
                                            <div class="dropdown-menu dropdown-cart-menu pull-right clearfix" role="menu">
                                                <p class="dropdown-cart-description"><strong>Su(s) Compra(s):</strong></p>
                                                <ul class="dropdown-cart-product-list">
                                                    <?php
                                                        do{
                                                            $xCodproM    = $filaM['cod_producto'];
                                                            $xNombreM    = $filaM['nom_producto'];
                                                            $xImagenM    = $filaM['imagen'];
                                                            $xCantidadM  = $filaM['cantidad'];
                                                            if($filaM['precio_oferta']!= 0){
                                                                $pmostrarM = $filaM['precio_oferta'];
                                                            }else{
                                                                $pmostrarM = $filaM['precio_normal'];
                                                            }
                                                            $subtotalM = ($xCantidadM*$pmostrarM);
                                                            $totalM = ($totalM+$subtotalM);
                                                    ?>
                                                    <li class="item clearfix">
                                                        <figure>
                                                            <a href="producto.php?cod_producto=<?php echo $xCodproM; ?>"><img src="/cms/assets/img/productos/<?php echo $xImagenM; ?>" alt="<?php echo $xNombreM; ?>"></a>
                                                        </figure>
                                                        <div class="dropdown-cart-details">
                                                            <p class="item-name">
                                                                <a href="producto.php?cod_producto=<?php echo $xCodproM; ?>"><?php echo $xNombreM; ?> </a>
                                                            </p>
                                                            <p>
                                                                x <?php echo $xCantidadM; ?>
                                                                <span class="item-price"><?php echo number_format($subtotalM,2); ?></span>
                                                            </p>
                                                        </div><!-- End .dropdown-cart-details -->
                                                    </li>
                                                    <?php
                                                        }
                                                        while($filaM=mysqli_fetch_array($resultadoM))
                                                    ?>
                                                </ul>
                                                <?php 
                                                    $igvM = ($totalM/10);
                                                    $netoM = ($totalM+$igvM);
                                                ?>
                                                <ul class="dropdown-cart-total">
                                                    <li><span class="dropdown-cart-total-title">IGV: 10%</span></li>
                                                    <li><span class="dropdown-cart-total-title">Total: <?php echo number_format(($totalM+$igvM),2); ?></span></li>
                                                </ul><!-- .dropdown-cart-total -->
                                                <div class="dropdown-cart-action">
                                                    <p><a href="/carrito.php" class="btn btn-custom-2 btn-block">Carrito</a></p>
                                                    <p><a href="/productos.php" class="btn btn-custom btn-block">Productos</a></p>
                                                </div><!-- End .dropdown-cart-action --> 
                                            </div><!-- End .dropdown-cart -->
                                            <?php }else{ ?>
                                            <?php } ?>
                                        </div><!-- End .btn-group -->
                                    </div><!-- End .dropdown-cart-menu-container -->
                                <?php }else{ } ?>

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
                                            <a href="/index.php" title="<?php echo $xAlt; ?>"><img src="/cms/assets/img/meta/<?php echo $xLogo; ?>" alt="<?php echo $xAlt; ?>" width="250" /></a>
                                        </h1>
                                        <?php
                                            mysqli_free_result($resultadoMet); 
                                        ?>
                                    </div><!-- End .logo-container -->
                                    <div id="menu-right-side" class="clerfix">
                                        <div id="quick-access">
                                            <script>
                                                function ValidarBusca(){
                                                    if(document.busca.buscador.value==""){
                                                        alert("Debes ingresar datos para la búsqueda");
                                                        document.busca.buscador.focus();
                                                        return;
                                                    }
                                                    document.busca.action="/buscar.php";
                                                    document.busca.submit();
                                                }
                                            </script>
                                            <form class="form-inline quick-search-form" name="busca" role="form" action="/buscar.php">
                                                <div class="form-group">
                                                    <input type="text" name="buscador" class="form-control" placeholder="Buscar producto..." onkeypress="if(event.keyCode==13){ValidarBusca();}" >
                                                </div><!-- End .form-inline -->
                                                <input class="btn btn-custom" value="" name="" type="submit" id="quick-search" />
                                            </form>

                                        </div><!-- End #quick-access -->
                                        <nav id="main-nav">
                                            <div id="responsive-nav">
                                                <div id="responsive-nav-button">
                                                    Menu <span id="responsive-nav-button-icon"></span>
                                                </div><!-- responsive-nav-button -->
                                            </div>
                                            <ul class="menu clearfix">
                                                <li><a class="<?php echo ($menu == "inicio" ? "active" : "")?>" href="/index.php">Inicio</a></li>
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
                                                <li><a class="<?php echo ($menu == "promociones" ? "active" : "")?>" href="/promociones.php">Promociones</a></li>
                                                <li><a class="<?php echo ($menu == "contacto" ? "active" : "")?>" href="/contacto.php">Contacto</a></li>
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