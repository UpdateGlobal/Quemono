<?php include("cms/module/conexion.php"); ?>
<?php include("modules/verificar-ingreso-cliente.php"); ?>
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
    $totalC = "";

    $carritoC = "SELECT * FROM productos as p, carrito as c WHERE c.cod_orden='$varOrden' AND c.cod_cliente='$varCliente' AND p.cod_producto=c.cod_producto";
    $resultadoC = mysqli_query($enlaces,$carritoC);
    $filaC = mysqli_fetch_assoc($resultadoC);
    $totalCarritoC=mysqli_num_rows($resultadoC);
?>
<!DOCTYPE html>
<!--[if IE 8]> <html class="ie8"> <![endif]-->
<!--[if IE 9]> <html class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html> <!--<![endif]-->
    <head>
        <?php include("includes/head.php"); ?>
        <script>
            function Procesar(strAccion){
                if(strAccion=="Ordenar"){
                    document.ftienda.action="pedidos-en-linea.php";
                }else{
                    document.ftienda.action="verifica-carrito.php";
                }
                document.ftienda.method="POST";
                document.ftienda.proceso.value=strAccion;
                document.ftienda.submit();
            }
        </script>
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
                            <li class="active">Carrito</li>
    					</ul>
            		</div>
            	</div>
            	<div class="container">
            		<div class="row">
            			<div class="col-md-12">
                            <?php
                                if($totalCarritoC>0){
                            ?>
    						<header class="content-title">
    							<h1 class="title">Carrito</h1>
    							<p class="title-desc">Quisque sed cursus ipsum. Proin dictum at nisi quis condimentum.</p>
    						</header>
            				<div class="xs-margin"></div><!-- space -->
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <p><strong>Nº de Orden : </strong><?php echo $filaC['cod_orden']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <p><strong>Usuario : </strong><?php echo utf8_decode($xAlias); ?></p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <p><strong>Email : </strong><?php echo $xEmail; ?></p>
                                </div>
                            </div>
            				<div class="row">
            					<div class="col-md-12 table-responsive">
                                    <table class="table cart-table">
                						<thead>
                							<tr>
        										<th width="5%" scope="col">&nbsp;</th>
                                                <th width="15%" scope="col">Producto</th>
                                                <th width="30%" scope="col">Imagen</th>
                                                <th width="10%" scope="col">Cantidad</th>
                                                <th width="20%" scope="col">Precio</th>
                                                <th width="20%" scope="col">Total</th>
                							</tr>
                						</thead>
                                        <?php
                                            do{
                                                $xCodproC  = $filaC['cod_producto'];
                                                $xNombreC  = $filaC['nom_producto'];
                                                $xCodigoC  = $filaC['codigo'];
                                                $xImagenC  = $filaC['imagen'];
                                                $xCantidadC  = $filaC['cantidad'];
                                                if($filaC['precio_oferta']!= 0){
                                                    $pmostrarC = $filaC['precio_oferta'];
                                                }else{
                                                    $pmostrarC = $filaC['precio_normal'];
                                                }
                                                $subtotalC = ($xCantidadC*$pmostrarC);
                                                $totalC = ($totalC+$subtotalC);
                                        ?>
        								<tbody>
        									<tr>
                                                <td><input type="checkbox" name="chk<?php echo $xCodproC; ?>"></td>
        										<td class="item-name-col">
        											<header class="item-name"><?php echo $xNombreC; ?></header>
                                                    <strong>C&oacute;digo:</strong> <?php echo $xCodigoC; ?>
                                                </td>
                                                <td>
                                                    <p class="text-center">
                                                        <figure>
            												<img src="cms/assets/img/productos/<?php echo $xImagenC; ?>" alt="<?php echo $xNombreC; ?>">
            											</figure>
                                                    </p>
        										</td>
                                                <td>
                                                    <div class="custom-quantity-input">
                                                        <input type="text" class="form-control" id="txt<?php echo $xCodproC; ?>" name="txt<?php echo $xCodproC; ?>" value="<?php echo $xCantidadC; ?>" size="2">
                                                    </div>
                                                </td>
                                                <td class="item-price-col">
                                                    <span class="item-price-special"><?php echo number_format($pmostrarC,2); ?></span>
                                                </td>
        										<td class="item-total-col">
                                                    <span class="item-price-special"><?php echo number_format($subtotalC,2); ?></span>
        										</td>
        									</tr>
        								</tbody>
                                        <?php
                                            }
                                            while($filaC=mysqli_fetch_array($resultadoC))
                                        ?>
                                    </table>
                                    <?php 
                                        $igvC = ($totalC/18);
                                        $netoC = ($totalC+$igvC);
                                    ?>
            					</div><!-- End .col-md-12 -->
            				</div><!-- End .row -->
            				<div class="lg-margin"></div><!-- End .space -->
            				<div class="row">
            					<div class="col-md-8 col-sm-12 col-xs-12 lg-margin">
                                    <a class="btn btn-custom-2" href="productos.php"><i class="fa fa-shopping-cart"></i> Seguir Comprando</a>
                                    <a class="btn btn-warning" href="javascript:Procesar('Actualizar')"><i class="fa fa-refresh"></i> Actualizar</a>
                                    <a class="btn btn-danger" href="javascript:Procesar('Eliminar')"><i class="fa fa-trash"></i> Borrar</a>
                                    <a class="btn btn-success" href="javascript:Procesar('Ordenar')"><i class="fa fa-paper-plane"></i> Ordenar Pedido</a>
            					</div><!-- End .col-md-8 -->
            					<div class="col-md-4 col-sm-12 col-xs-12">
            						<table class="table total-table">
            							<tbody>
            								<tr>
            									<td class="total-table-title">Monto Bruto:</td>
            									<td><?php echo number_format($totalC,2); ?></td>
            								</tr>
            								<tr>
            									<td class="total-table-title">+IGV (18%):</td>
            									<td><?php echo number_format($igvC,2); ?></td>
            								</tr>
            							</tbody>
            							<tfoot>
            								<tr>
    											<td>Total neto a pagar:</td>
    											<td>$<?php echo number_format(($totalC+$igvC),2); ?></td>
            								</tr>
            							</tfoot>
            						</table>
            						<div class="md-margin"></div><!-- End .space -->
            					</div><!-- End .col-md-4 -->
            				</div><!-- End .row -->
                            <?php }else{ ?>
                                <p>En estos momentos el carrito esta sin productos, por favor seleccione uno o mas productos desde el cat&aacute;logo</p>
                            <?php } ?>
            				<div class="md-margin2x"></div><!-- Space -->
            			</div><!-- End .col-md-12 -->
            		</div><!-- End .row -->
    			</div><!-- End .container -->
            </section><!-- End #content -->
            <?php include("includes/footer.php"); ?>
        </div>
    </body>
</html>