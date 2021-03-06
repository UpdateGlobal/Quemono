        <footer id="footer">
            <div id="inner-footer">
                
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-xs-12 widget">
                            <h3>MAPA DEL SITIO</h3>
                            <ul class="links">
                                <li><a href="/index.php">Inicio</a></li>
                                <li><a href="/productos.php">Productos</a></li>
                                <li><a href="/promociones.php">Promociones</a></li>
                                <li><a href="/contacto.php">Contacto</a></li>
                            </ul>
                        </div><!-- End .widget -->
                        
                        <div class="col-md-3 col-sm-4 col-xs-12 widget">
                            <h3>CATEGOR&Iacute;AS</h3>
                            <ul class="links">
                                <?php
                                    $consultarPrincipal = "SELECT * FROM productos_principal WHERE estado='1' ORDER BY orden LIMIT 4";
                                    $resultadoPrincipal = mysqli_query($enlaces,$consultarPrincipal) or die('Consulta fallida: ' . mysqli_error($enlaces));
                                    while($filaPri = mysqli_fetch_array($resultadoPrincipal)){
                                        $xCod_principal = $filaPri['cod_principal'];
                                        $xPrincipal     = $filaPri['principal'];
                                        $xSlugPf        = $filaPri['slug'];
                                ?>
                                <li><a href="/catalogos/<?php echo $xSlugPf; ?>"><?php echo $xPrincipal; ?></a></li>
                                <?php
                                    }
                                    mysqli_free_result($resultadoPrincipal);
                                ?>
                            </ul>
                        </div><!-- End .widget -->
                        
                        <div class="col-md-3 col-sm-4 col-xs-12 widget">
                            <h3>CONTACTO</h3>
                            <ul class="contact-list">
                                <?php
                                    $consultarCot = 'SELECT * FROM contacto';
                                    $resultadoCot = mysqli_query($enlaces,$consultarCot) or die('Consulta fallida: ' . mysqli_error($enlaces));
                                    $filaCot  = mysqli_fetch_array($resultadoCot);
                                        $xDirection   = utf8_encode($filaCot['direction']);
                                        $xPhone       = $filaCot['phone'];
                                        $xMobile      = $filaCot['mobile'];
                                        $xEmail       = $filaCot['email'];
                                ?>
                                <li><strong>QueMono</strong></li>
                                <li><i class="fa fa-home" aria-hidden="true"></i> <?php echo $xDirection; ?></li>
                                <li><i class="fa fa-phone" aria-hidden="true"></i> <?php echo $xPhone; ?></li>
                                <li><i class="fa fa-whatsapp" aria-hidden="true"></i> <?php echo $xMobile; ?></li>
                                <li><i class="fa fa-envelope" aria-hidden="true"></i> <?php echo $xEmail; ?></li>
                                <?php
                                    mysqli_free_result($resultadoCot);
                                ?>
                            </ul>
                        </div><!-- End .widget -->
                        
                        <div class="clearfix visible-sm"></div>
                        
                        <div class="col-md-3 col-sm-12 col-xs-12 widget">
                            <h3>S&Iacute;GUENOS EN</h3>
                            <div class="facebook-likebox">
                                <?php
                                    $consultarCot = 'SELECT * FROM contacto';
                                    $resultadoCot = mysqli_query($enlaces,$consultarCot) or die('Consulta fallida: ' . mysqli_error($enlaces));
                                    $filaCot  = mysqli_fetch_array($resultadoCot);
                                        $xFace    = $filaCot['face'];
                                ?>
                                <?php echo $xFace; ?>
                                <?php mysqli_free_result($resultadoCot); ?>
                            </div>
                        </div><!-- End .widget -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            
            </div><!-- End #inner-footer -->
            
            <div id="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 col-sm-7 col-xs-12 footer-social-links-container">
                            <ul class="social-links clearfix">
                                <?php
                                    $consultarSol = 'SELECT * FROM social WHERE estado=1 ORDER BY orden';
                                    $resultadoSol = mysqli_query($enlaces,$consultarSol) or die('Consulta fallida: ' . mysqli_error($enlaces));
                                    while($filaSol = mysqli_fetch_array($resultadoSol)){
                                        $xType      = $filaSol['type'];
                                        $xLinks     = $filaSol['links'];
                                        $xValor     = $filaSol['valor'];
                                ?>
                                <li><a href="<?php echo $xLinks; ?>" class="social-icon <?php echo $xValor; ?>"></a></li>
                                <?php
                                    }
                                    mysqli_free_result($resultadoSol);
                                ?>
                                
                            </ul>
                        </div><!-- End .col-md-7 -->
                        <div class="col-md-5 col-sm-5 col-xs-12 footer-text-container">
                            <p>&copy; 2018 QueMono. Todos los derechos reservados.</p>
                        </div><!-- End .col-md-5 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End #footer-bottom -->

        </footer>

        <a href="#" id="scroll-top" title="Scroll to Top"><i class="fa fa-angle-up"></i></a><!-- End #scroll-top -->
    
    <!-- END -->
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/smoothscroll.js"></script>
    <script src="/js/jquery.debouncedresize.js"></script>
    <script src="/js/retina.min.js"></script>
    <script src="/js/jquery.placeholder.js"></script>
    <script src="/js/jquery.hoverIntent.min.js"></script>
    <script src="/js/jquery.flexslider-min.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/jflickrfeed.min.js"></script>
    <script src="/js/jquery.prettyPhoto.js"></script>
    <script src="/js/jquery.themepunch.tools.min.js"></script>
    <script src="/js/jquery.themepunch.revolution.min.js"></script>
    <script src="/js/jquery.selectbox.min.js"></script>
    <script src="/js/jquery.fitvids.js"></script>
    <script src="/js/jquery.elastislide.js"></script>
    <script src="/js/jquery.elevateZoom.min.js"></script>

    <script src="/js/main.js"></script>
    
    <script>
        $(function() {
            // Slider Revolution
            jQuery('#slider-rev').revolution({
                delay:80000,
                startwidth:1170,
                startheight:600,
                onHoverStop:"true",
                hideThumbs:250,
                navigationHAlign:"center",
                navigationVAlign:"bottom",
                navigationHOffset:0,
                navigationVOffset:20,
                soloArrowLeftHalign:"left",
                soloArrowLeftValign:"center",
                soloArrowLeftHOffset:0,
                soloArrowLeftVOffset:0,
                soloArrowRightHalign:"right",
                soloArrowRightValign:"center",
                soloArrowRightHOffset:0,
                soloArrowRightVOffset:0,
                touchenabled:"on",
                stopAtSlide:-1,
                stopAfterLoops:-1,
                dottedOverlay:"none",
                fullWidth:"on",
                spinned:"spinner5",
                shadow:0,
                hideTimerBar: "on",
                // navigationStyle:"preview4"
            });
        });
    </script>