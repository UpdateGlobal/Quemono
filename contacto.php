<?php include("cms/module/conexion.php"); ?>
<?php include("modules/session-core.php"); ?>
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
    						<li class="active">Contacto</li>
    					</ul>
            		</div>
            	</div>
            	<div class="container">
            		<div class="row">
            			<div class="col-md-12">
    						<header class="content-title">
    							<h1 class="title">Contacto</h1>
    							<p class="title-desc">Cras id urna tincidunt, blandit mauris vel, posuere dolor.</p>
    						</header>
            				<div class="xs-margin"></div><!-- space -->
                            <?php
                                $consultarCot = 'SELECT * FROM contacto';
                                $resultadoCot = mysqli_query($enlaces,$consultarCot) or die('Consulta fallida: ' . mysqli_error($enlaces));
                                $filaCot  = mysqli_fetch_array($resultadoCot);
                                     $xMap    = utf8_encode($filaCot['map']);
                            ?>
            				<div class="row">
            					<div class="col-md-12">
                                    <?php echo $xMap; ?>
            					<div class="lg-margin"></div><!-- space -->
                                </div><!-- End .col-md-12 -->
    						<?php mysqli_free_result($resultadoCot); ?>
            					<div class="col-md-8 col-sm-8 col-xs-12">
            						<h2 class="sub-title">Cont&aacute;ctenos</h2>
            						<div class="row">
            							<form action="" id="contact-form">
            								<div class="col-md-6 col-sm-12 col-xs-12">
    											<div class="input-group">
    												<span class="input-group-addon"><span class="input-icon input-icon-user"></span><span class="input-text">Nombre&#42;</span></span><input type="text" name="nombre" id="nombre" required class="form-control input-lg" placeholder="Su Nombre">
    											</div><!-- End .input-group -->
            									<div class="input-group">
    												<span class="input-group-addon"><span class="input-icon input-icon-email"></span><span class="input-text">Email&#42;</span></span><input type="email" name="email" id="email" required class="form-control input-lg" placeholder="Su Email">
    											</div><!-- End .input-group -->
            									<div class="input-group">
    												<span class="input-group-addon"><span class="input-icon input-icon-phone"></span><span class="input-text">Tel&eacute;fono</span></span><input type="text" name="telefono" id="telefono" required class="form-control input-lg" placeholder="Su Teléfono">
    											</div><!-- End .input-group -->
            									<p class="item-desc">Su direcci&oacute;n de email no ser&aacute; Publicada.</p>
            								</div><!-- End .col-md-6 -->
            								
            								<div class="col-md-6 col-sm-12 col-xs-12">
    											<div class="input-group textarea-container">
    												<span class="input-group-addon"><span class="input-icon input-icon-message"></span><span class="input-text">Su Mensaje</span></span>
    												<textarea name="contact-message" id="contact-message" class="form-control" cols="30" rows="6" placeholder="Su Mensaje"></textarea>
    											</div><!-- End .input-group -->
            								    <input type="submit" value="Enviar" class="btn btn-custom-2 md-margin">
            								</div><!-- End .col-md-6 -->
            							</form>
            						</div><!-- End .row -->		
            					</div><!-- End .col-md-8 -->
            					
            					<div class="col-md-4 col-sm-4 col-xs-12">
            						<h2 class="sub-title">DATOS DE CONTACTO</h2>
            						<ul class="contact-details-list">
                                        <?php
                                            $consultarCot = 'SELECT * FROM contacto';
                                            $resultadoCot = mysqli_query($enlaces,$consultarCot) or die('Consulta fallida: ' . mysqli_error($enlaces));
                                            $filaCot  = mysqli_fetch_array($resultadoCot);
                                                $xDirection   = utf8_encode($filaCot['direction']);
                                                $xPhone       = utf8_encode($filaCot['phone']);
                                                $xMobile      = utf8_encode($filaCot['mobile']);
                                                $xEmail       = utf8_encode($filaCot['email']);
                                                $xDayA        = utf8_encode($filaCot['diaa']);
                                                $xHorarioA    = utf8_encode($filaCot['horarioa']);
                                                $xDayB        = utf8_encode($filaCot['diab']);
                                                $xHorarioB    = utf8_encode($filaCot['horariob']);
                                                $xDayC        = utf8_encode($filaCot['diac']);
                                                $xHorarioC    = utf8_encode($filaCot['horarioc']);
                                        ?>
                                        <li><i class="fa fa-home" aria-hidden="true"></i> <?php echo $xDirection; ?></li>
                                        <li><i class="fa fa-phone" aria-hidden="true"></i> <?php echo $xPhone; ?></li>
                                        <li><i class="fa fa-whatsapp" aria-hidden="true"></i> <?php echo $xMobile; ?></li>
                                        <li><i class="fa fa-envelope" aria-hidden="true"></i> <?php echo $xEmail; ?></li>
                                        <li>
                                            <span class="contact-icon contact-icon-phone"></span>
                                            <span><i class="fa fa-clock" aria-hidden="true"></i></span>
                                            <ul>
                                                <li><?php echo $xDayA; ?> : <?php echo $xHorarioA; ?></li>
                                                <li><?php echo $xDayB; ?> : <?php echo $xHorarioB; ?></li>
                                                <li><?php echo $xDayC; ?> : <?php echo $xHorarioC; ?></li>
                                            </ul>
                                        </li>
                                    </ul>
            					</div><!-- End .col-md-4 -->
            				</div><!-- End .row -->
            				
            			</div><!-- End .col-md-12 -->
            		</div><!-- End .row -->
    			</div><!-- End .container -->
            
            </section><!-- End #content -->
        
            <?php include("includes/footer.php"); ?>
        </div><!-- End #wrapper -->
    </body>
</html>