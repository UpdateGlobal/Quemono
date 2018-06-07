<?php include "cms/module/conexion.php"; ?>
<?php include "modules/verificar-ingreso-cliente.php"; ?>
<?php
$varOrden   = $_SESSION['IdOrden'];
$varCliente = $_SESSION['IdCliente'];
$totalC = 0;
$carritoC = "SELECT * FROM productos as p, carrito as c WHERE c.cod_orden='$varOrden' AND c.cod_cliente='$varCliente' AND p.cod_producto=c.cod_producto";
$resultadoC = mysqli_query($enlaces, $carritoC);
$filaC = mysqli_fetch_assoc($resultadoC);
$totalCarritoC=mysqli_num_rows($resultadoC);

/*-- Consulta para mostra datos del cliente ---*/
$clientes = "SELECT * FROM clientes WHERE cod_cliente='$xCodCliente'";
$resultCli = mysqli_query($enlaces, $clientes);
$filaCli = mysqli_fetch_array($resultCli);
?>
<!DOCTYPE html>
<!--[if IE 8]> <html class="ie8"> <![endif]-->
<!--[if IE 9]> <html class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html> <!--<![endif]-->
    <head>
        <?php include("includes/head.php"); ?>
        <script>
            function Enviar(){
                document.ftienda.action="envia-pedido.php";
                document.ftienda.metod="POST";
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
                            <li><a href="carrito-compras.php">Carrito de Compras</a></li>
                            <li class="active">Pedidos en L&iacute;nea</li>
    					</ul>
            		</div>
            	</div>
            	<div class="container">
                    <form id="ftienda" method="post" name="ftienda">
                		<div class="row">
                			<div class="col-md-12">
                                <?php
                                    if($totalCarritoC>0){
                                ?>
        						<header class="content-title">
        							<h1 class="title">Pedidos en L&iacute;nea</h1>
        							<p class="title-desc">Quisque sed cursus ipsum. Proin dictum at nisi quis condimentum.</p>
        						</header>
                				<div class="xs-margin"></div><!-- space -->
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <p><strong>Nº de Orden : </strong><?php echo $filaC['cod_orden']; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                					<div class="col-md-12 table-responsive">
                                        <table class="table cart-table">
                    						<thead>
                    							<tr>
                                                    <th width="20%" scope="col">Producto</th>
                                                    <th width="15%" scope="col">C&oacute;digo</th>
                                                    <th width="20%" scope="col">Imagen</th>
                                                    <th width="10%" scope="col">Cantidad</th>
                                                    <th width="15%" scope="col">Precio</th>
                                                    <th width="20%" scope="col">Total</th>
                    							</tr>
                    						</thead>
                                            <?php
                                                do{
                                                    $xCodproC   = $filaC['cod_producto'];
                                                    $xNombreC   = $filaC['nom_producto'];
                                                    $xCodigoC   = $filaC['codigo'];
                                                    $xImagenC   = $filaC['imagen'];
                                                    $xCantidadC = $filaC['cantidad'];
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
                                                    <td class="item-name-col">
            											<header class="item-name"><?php echo $xNombreC; ?></header>
                                                    </td>
                                                    <td><?php echo $xCodigoC; ?></td>
                                                    <td>
                                                        <p class="text-center">
                                                            <figure>
                												<img src="cms/assets/img/productos/<?php echo $xImagenC; ?>" alt="<?php echo $xNombreC; ?>">
                											</figure>
                                                        </p>
            										</td>
                                                    <td>
                                                        <?php echo $xCantidadC; ?>
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
                                            $igvC = ($totalC/10);
                                            $netoC = ($totalC+$igvC);
                                        ?>
                					</div><!-- End .col-md-12 -->
                				</div><!-- End .row -->
                				<div class="lg-margin"></div><!-- End .space -->
                				<div class="row">
                					<div class="col-md-8 col-sm-12 col-xs-12 lg-margin">
                                        
                					</div><!-- End .col-md-8 -->
                					<div class="col-md-4 col-sm-12 col-xs-12">
                						<table class="table total-table">
                							<tbody>
                								<tr>
                									<td class="total-table-title">Monto Bruto:</td>
                									<td><?php echo number_format($totalC,2); ?></td>
                								</tr>
                								<tr>
                									<td class="total-table-title">+IGV (10%):</td>
                									<td><?php echo number_format($igvC,2); ?></td>
                								</tr>
                							</tbody>
                							<tfoot>
                								<tr>
        											<td>Total neto a pagar:</td>
        											<td><?php echo number_format(($totalC+$igvC),2); ?></td>
                								</tr>
                							</tfoot>
                						</table>
                						<div class="md-margin"></div><!-- End .space -->
                					</div><!-- End .col-md-4 -->
                				</div><!-- End .row -->
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h3>Datos del Cliente</h3>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <p><strong>Nombres :</strong></p>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <p><?php echo $filaCli['nombres'] ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <p><strong>Direcci&oacute;n :</strong></p>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <p><?php echo $filaCli['direccion'] ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <p><strong>Tel&eacute;fono :</strong></p>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <p><?php echo $filaCli['telefono'] ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <p><strong>Email :</strong></p>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <p><?php echo $filaCli['email'] ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <p><strong>Comentarios :</strong></p>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <textarea class="form-control" name="comentarios" cols="60" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="sm-margin"></div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <a class="btn btn-danger" href="cerrar-sesion.php">Cerrar Sesi&oacute;n</a>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <a class="btn btn-success" href="javascript:Enviar();">Enviar Pedido *</a>
                                    <br><span>* Se env&iacute;a un pedido para pagar despu&eacute;s en presencial</span>
                                    <?php
                                        }else{
                                    ?>
                                    <p>En estos momentos el carrito esta sin productos, por favor seleccione uno o mas productos desde el cat&aacute;logo para hacer su pedido en linea</p>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="md-margin2x"></div><!-- Space -->
                        </div>
                    </div>
    			</div><!-- End .container -->
            </section><!-- End #content -->
            <?php include("includes/footer.php"); ?>
        </div>
    </body>
</html>