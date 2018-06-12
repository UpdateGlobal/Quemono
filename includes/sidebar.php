							<aside class="col-md-3 col-sm-4 col-xs-12 sidebar">
        						<div class="widget">
        							<div class="panel-group custom-accordion sm-accordion" id="category-filter">
										<div class="panel">
											<div class="accordion-header">
												<div class="accordion-title"><span>Categor&iacute;as</span></div><!-- End .accordion-title -->
												<a class="accordion-btn opened" data-toggle="collapse" data-target="#category-list-1"></a>
											</div><!-- End .accordion-header -->
											<div id="category-list-1" class="collapse in">
												<div class="panel-body">
													<?php
							                            $consultarPri = "SELECT * FROM productos_principal WHERE estado='1' ORDER BY orden";
							                            $resultadoPri = mysqli_query($enlaces, $consultarPri);
							                            while($filaP = mysqli_fetch_array($resultadoPri)){
							                                $xCod_principal = $filaP['cod_principal'];
							                                $xSlugPri 		= $filaP['slug'];
							                                $xPrincipal 	= $filaP['principal'];
							                        ?>
													<h5><?php echo $xPrincipal; ?></h5>
													<ul class="category-filter-list jscrollpane">
														<?php
							                                $consultarCat = "SELECT * FROM productos_categorias WHERE estado='1' AND cod_principal='$xCod_principal' ORDER BY orden";
							                                $resultadoCat = mysqli_query($enlaces, $consultarCat);
							                                while($filaC = mysqli_fetch_array($resultadoCat)){
							                                    $xCod_categoria = $filaC['cod_categoria'];
							                                    $xSlugCat 		= $filaC['slug'];
							                                    $xCategoria 	= $filaC['categoria'];
							                            ?>
														<li><a href="/categorias/<?php echo $xSlugCat; ?>"><?php echo $xCategoria; ?></a>
															<ul class="subcat">
																<?php
						                                            $consultarSubCat = "SELECT * FROM productos_sub_categorias WHERE cod_categoria='$xCod_categoria' AND estado='1' ORDER BY orden";
						                                            $resultadoSubCat = mysqli_query($enlaces, $consultarSubCat);
						                                            while($filaSC = mysqli_fetch_array($resultadoSubCat)){
						                                                $xCod_categoria 	= $filaSC['cod_categoria'];
						                                                $xCod_SCategoria	= $filaSC['cod_sub_categoria'];
						                                                $xSlugSCat 			= $filaSC['slug'];
						                                                $xSCategoria 		= $filaSC['subcategoria'];
						                                        ?>
																<li><a href="/subcategorias/<?php echo $xSlugSCat; ?>"><?php echo $xSCategoria; ?></a></li>
																<?php
																	}
																	mysqli_free_result($resultadoSubCat); 
																?>
															</ul>
														</li>
														<?php 
															}
															mysqli_free_result($resultadoCat);
														?>
													</ul>
													<div style="height: 30px;"></div>
													<?php 
														}
														mysqli_free_result($resultadoPri); 
													?>
												</div><!-- End .panel-body -->
											</div><!-- #collapse -->
										</div><!-- End .panel -->

        								<div class="panel">
											<div class="accordion-header">
												<div class="accordion-title"><span>Marcas</span></div><!-- End .accordion-title -->
												<a class="accordion-btn opened"  data-toggle="collapse" data-target="#category-list-2"></a>
											</div><!-- End .accordion-header -->
											<div id="category-list-2" class="collapse in">
												<div class="panel-body">
													<ul class="category-filter-list jscrollpane">
														<?php
				                                            $consultarCar = "SELECT * FROM carrusel WHERE estado=1 ORDER BY orden";
				                                            $resultadoCar = mysqli_query($enlaces, $consultarCar);
				                                            while($filaC = mysqli_fetch_array($resultadoCar)){
				                                                $xCodigoMar   = $filaC['cod_carrusel'];
				                                                $xSlugMar     = $filaC['slug'];
				                                                $xMarcas      = $filaC['marca'];
				                                        ?>
														<li><a href="/marcas/<?php echo $xSlugMar; ?>"><?php echo $xMarcas; ?></a></li>
														<?php
				                                            }
				                                            mysqli_free_result($resultadoCar);
				                                        ?>
													</ul>
												</div><!-- End .panel-body -->
											</div><!-- #collapse -->
										</div><!-- End .panel -->
        							</div><!-- .panel-group -->
        						</div><!-- End .widget -->
        					</aside><!-- End .col-md-3 -->