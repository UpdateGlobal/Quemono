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
                                </table>
        					</div><!-- End .col-md-12 -->
        					
        				</div><!-- End .row -->
        				<div class="lg-margin"></div><!-- End .space -->
        				
        				<div class="row">
        					<div class="col-md-8 col-sm-12 col-xs-12 lg-margin">
        						
        						<div class="tab-container left clearfix">
        								<ul class="nav-tabs">
										  <li class="active"><a href="#shipping" data-toggle="tab">Shipping &amp; Taxes</a></li>
										  <li><a href="#discount" data-toggle="tab">Discount Code</a></li>
										  <li><a href="#gift" data-toggle="tab">Gift voucher </a></li>
										  
										</ul>
        								<div class="tab-content clearfix">
        									<div class="tab-pane active" id="shipping">
        										
        										<form action="#" id="shipping-form">
        											<p class="shipping-desc">Enter your destination to get a shipping estimate.</p>
													<div class="form-group">
														<label for="select-country" class="control-label">Country&#42;</label>
														<div class="input-container normal-selectbox">
                                                            <select id="select-country" name="select-country" class="selectbox">
                                                                <option  value="Japan">Japan</option>
                                                                <option  value="Brazil">Brazil</option>
                                                                <option  value="France">France</option>
                                                                <option  value="Italy">Italy</option>
                                                                <option  value="Spain">Spain</option>
                                                            </select>
                                                        </div><!-- End .select-container -->
													</div><!-- End .form-group -->
													<div class="xss-margin"></div>
													<div class="form-group">
                                                        <label for="select-state" class="control-label">Regison/State&#42;</label>
                                                        <div class="input-container normal-selectbox">
                                                            <select id="select-state" name="select-state" class="selectbox">
                                                            <option  value="California">California</option>
                                                            <option  value="Texas">Texas</option>
                                                            <option  value="NewYork">NewYork</option>
                                                            <option  value="Narnia">Narnia</option>
                                                            <option  value="Jumanji">Jumanji</option>
                                                        </select>
                                                        </div><!-- End .select-container -->
                                                    </div><!-- End .form-group -->
        										  <div class="xss-margin"></div>
        										<div class="form-group">
													<label for="select-country" class="control-label"  >Post Code&#42;</label>
													<div class="input-container">
                                                        <input type="text" required class="form-control" placeholder="Your fax">
                                                    </div>
												</div><!-- End .form-group -->
        										<div class="xss-margin"></div>
        										<p class="text-right">
        											<input type="submit" class="btn btn-custom-2" value="GET QUOTES">
        										</p>
        										</form>
        										
        									</div><!-- End .tab-pane -->
        									
        									<div class="tab-pane" id="discount">
        										<p>Enter your discount coupon code here.</p>
        										<form action="#">
        											<div class="input-group">
														<input type="text" required class="form-control" placeholder="Coupon code">
														
													</div><!-- End .input-group -->	
        										<input type="submit" class="btn btn-custom-2" value="APPLY COUPON">
        										</form>
        									</div><!-- End .tab-pane -->
        									
        									<div class="tab-pane" id="gift">
        										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi dignissimos nostrum debitis optio molestiae in quam dicta labore obcaecati ullam necessitatibus animi deleniti minima dolor suscipit nobis est excepturi inventore.</p>
        									</div><!-- End .tab-pane -->
        									
        								</div><!-- End .tab-content -->
        						</div><!-- End .tab-container -->
        						
        					</div><!-- End .col-md-8 -->

        					<div class="col-md-4 col-sm-12 col-xs-12">
        						
        						<table class="table total-table">
        							<tbody>
        								<tr>
        									<td class="total-table-title">Subtotal:</td>
        									<td>$434.50</td>
        								</tr>
        								<tr>
        									<td class="total-table-title">Shipping:</td>
        									<td>$6.00</td>
        								</tr>
        								<tr>
        									<td class="total-table-title">TAX (0%):</td>
        									<td>$0.00</td>
        								</tr>
        							</tbody>
        							<tfoot>
        								<tr>
											<td>Total:</td>
											<td>$440.50</td>
        								</tr>
        							</tfoot>
        						</table>
        						<div class="md-margin"></div><!-- End .space -->
        						<a href="#" class="btn btn-custom-2">CONTINUE SHOPPING</a>
        						<a href="#" class="btn btn-custom">CHECKOUT</a>
        					</div><!-- End .col-md-4 -->
        				</div><!-- End .row -->
        				<div class="md-margin2x"></div><!-- Space -->
        				
        				</div><!-- End .purchased-items-container -->
        				
        			</div><!-- End .col-md-12 -->
        		</div><!-- End .row -->
			</div><!-- End .container -->
        
        </section><!-- End #content -->
        
        <?php include("includes/footer.php"); ?>
    </div>

	

    </body>
</html>