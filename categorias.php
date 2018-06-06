<?php include("cms/module/conexion.php"); ?>
<?php include("modules/session-core.php"); ?>
<?php $cod_categoria = $_REQUEST['cod_categoria']; ?>
<?php 
$conCategoria = "SELECT * FROM productos_categorias WHERE cod_categoria='$cod_categoria' ORDER BY orden";
$resCategoria = mysqli_query($enlaces,$conCategoria) or die('Consulta fallida: ' . mysqli_error($enlaces));
$filCat = mysqli_fetch_array($resCategoria);
    $xCodCatx        = $filCat['cod_categoria'];
    $xCategoriax     = $filCat['categoria'];
?>
<!DOCTYPE html>
<!--[if IE 8]> <html class="ie8"> <![endif]-->
<!--[if IE 9]> <html class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html> <!--<![endif]-->
    <head>
        <?php include("includes/head.php"); ?>
        <script>
            function ValidarBus(){
                if(document.bus.buscador.value==""){
                    alert("Debes ingresar datos para la búsqueda");
                    document.bus.buscador.focus();
                    return;
                }
                document.bus.action="buscar.php";
                document.bus.submit();
            }
        </script>
        <style id="custom-style">
        </style>
    </head>
    <body>
        <div id="wrapper">
            <?php $menu=$xCategoriax; include("includes/header.php"); ?>
            <section id="content">
                <div id="breadcrumb-container">
                    <div class="container">
                        <ul class="breadcrumb">
                            <li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                            <li><a href="productos.php">Productos</a></li>
                            <li class="active"><?php echo $xCategoriax; ?></li>
                        </ul>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-9 col-sm-8 col-xs-12 main-content">
                                    <h1 class="title"><?php echo $xCategoriax; ?></h1>
                                    <?php
                                        $consultarPro = "SELECT * FROM productos WHERE estado='1' AND cod_categoria='$cod_categoria'";
                                        $resultadoPro = mysqli_query($enlaces, $consultarPro);
                                        $total_registros = mysqli_num_rows($resultadoPro);
                                        if($total_registros==0){ 
                                    ?>
                                    <div class="lg-margin"></div><!-- .space -->
                                    <div class="category-item-container">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <h3>No hay productos en esta categor&iacute;a<br>
                                                Puede usar el buscador para ubicar el producto que desee.</h3>
                                            </div>
                                    <?php 
                                        }else{

                                        $registros_por_paginas = 9;
                                        $total_paginas = ceil($total_registros/$registros_por_paginas);
                                        $pagina = intval($_GET['p']);
                                        if($pagina<1 or $pagina>$total_paginas){
                                            $pagina=1;
                                        }
                                        $posicion = ($pagina-1)*$registros_por_paginas;
                                        $limite = "LIMIT $posicion, $registros_por_paginas";
                                    ?>
                                    
                                    <div class="lg-margin"></div><!-- space -->
                                    <div class="category-toolbar clearfix">
                                        <div class="toolbox-filter clearfix">
                                            <div class="sort-box">
                                                <span class="separator"><strong>Visualizaci&oacute;n:</strong></span>
                                            </div>
                                            <div class="view-box">
                                                <a href="categorias.php?cod_categoria=<?php echo $xCodCatx; ?>" class="active icon-button icon-grid"><i class="fa fa-th-large"></i></a>
                                                <a href="categorias-list.php?cod_categoria=<?php echo $xCodCatx; ?>" class="icon-button icon-list"><i class="fa fa-th-list"></i></a>
                                            </div><!-- End .view-box -->
                                        </div><!-- End .toolbox-filter -->
                                        <div class="toolbox-pagination clearfix">
                                            <?php
                                                $paginas_mostrar = 5;
                                                if ($total_paginas>1){
                                                    echo "
                                                        <ul class='pagination'>";
                                                    if($pagina>1){
                                                        echo "<li><a href='?cod_categoria=".$xCodCatx."&p=".($pagina-1)."'><i class='fa fa-angle-left'></i></a></li>";
                                                    }
                                                    for($i=$pagina; $i<=$total_paginas && $i<=($pagina+$paginas_mostrar); $i++){
                                                        if($i==$pagina){
                                                            echo "<li class='active'><a>$i</a></li>";
                                                        }else{
                                                            echo "<li><a href='?cod_categoria=".$xCodCatx."&p=$i'>$i</a></li>";
                                                        }
                                                    }
                                                    if(($pagina+$paginas_mostrar)<$total_paginas){
                                                        echo "<li><a>...</a></li>";
                                                    }
                                                    if($pagina<$total_paginas){
                                                        echo "<li><a href='?cod_categoria=".$xCodCatx."&p=".($pagina+1)."'><i class='fa fa-angle-right'></i></a></li>";
                                                    }
                                                    echo "</ul>";
                                                }
                                            ?>
                                        </div><!-- End .toolbox-pagination -->
                                        
                                    </div><!-- End .category-toolbar -->
                                    <div class="md-margin"></div><!-- .space -->
                                    <div class="category-item-container">
                                        <div class="row">
                                            <?php
                                                $consultarPro = "SELECT * FROM productos WHERE cod_categoria='$cod_categoria' AND estado='1' ORDER BY orden ASC $limite";
                                                $resultadoPro = mysqli_query($enlaces, $consultarPro);
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
                                            <?php
                                                $paginas_mostrar = 5;
                                                if ($total_paginas>1){
                                                    echo "
                                                        <ul class='pagination'>";
                                                    if($pagina>1){
                                                        echo "<li><a href='?cod_categoria=".$xCodCatx."&p=".($pagina-1)."'><i class='fa fa-angle-left'></i></a></li>";
                                                    }
                                                    for($i=$pagina; $i<=$total_paginas && $i<=($pagina+$paginas_mostrar); $i++){
                                                        if($i==$pagina){
                                                            echo "<li class='active'><a>$i</a></li>";
                                                        }else{
                                                            echo "<li><a href='?cod_categoria=".$xCodCatx."&p=$i'>$i</a></li>";
                                                        }
                                                    }
                                                    if(($pagina+$paginas_mostrar)<$total_paginas){
                                                        echo "<li><a>...</a></li>";
                                                    }
                                                    if($pagina<$total_paginas){
                                                        echo "  <li><a href='?cod_categoria=".$xCodCatx."&p=".($pagina+1)."'><i class='fa fa-angle-right'></i></a></li>";
                                                    }
                                                    echo "</ul>";
                                                }
                                            }
                                            ?>
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