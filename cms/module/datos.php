<div class="row">
          <div class="col-4 col-lg-4">
            <div class="col-md-12">
              <div class="card card-bordered">
                <h4 class="card-title"><strong>Misión</strong></h4>
                <div class="card-body">
                  <div class="row">
                    <div class="col-12 col-lg-12">
                      <?php
                        $consultarCon = "SELECT * FROM contenidos WHERE cod_contenido='2'";
                        $resultadoCon = mysqli_query($enlaces,$consultarCon) or die('Consulta fallida: ' . mysqli_error($enlaces));
                        while($filaCon = mysqli_fetch_array($resultadoCon)){
                          $xCodigo      = $filaCon['cod_contenido'];
                          $xTitulo      = utf8_encode($filaCon['titulo_contenido']);
                          $xImagen      = $filaCon['img_contenido'];
                          $xContenido   = utf8_encode($filaCon['contenido']);
                          $xEstado      = $filaCon['estado'];
                      ?>
                      <img class="d-block b-1 border-light hover-shadow-2 p-1" src="assets/img/nosotros/<?php echo $xImagen; ?>" />
                      <h5><?php echo $xTitulo; ?></h5>
                      <p><?php 
                          $strCut = substr($xContenido,0,200);
                          $xContenido = substr($strCut,0,strrpos($strCut, ' ')).'...';
                          echo strip_tags($xContenido);
                        ?></p>
                      <hr>
                      <p><strong>Estado: <?php if($xEstado=="1"){echo "[Activo]";}else{ echo "[Inactivo]"; } ?> </strong></p>
                      <?php
                        }
                        mysqli_free_result($resultadoCon);
                      ?>
                    </div>
                  </div>
                </div>
                <div class="publisher bt-1 border-light">
                  <a href="nosotros-edit.php?cod_contenido=<?php echo $xCodigo; ?>" class="btn btn-bold btn-primary"><i class="fa fa-refresh"></i> Editar Misión</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-4 col-lg-4">
            <div class="col-md-12">
              <div class="card card-bordered">
                <h4 class="card-title"><strong>Visión</strong></h4>
                <div class="card-body">
                  <div class="row">
                    <div class="col-12 col-lg-12">
                      <?php
                        $consultarCon = "SELECT * FROM contenidos WHERE cod_contenido='3'";
                        $resultadoCon = mysqli_query($enlaces,$consultarCon) or die('Consulta fallida: ' . mysqli_error($enlaces));
                        while($filaCon = mysqli_fetch_array($resultadoCon)){
                          $xCodigo      = $filaCon['cod_contenido'];
                          $xTitulo      = utf8_encode($filaCon['titulo_contenido']);
                          $xImagen      = $filaCon['img_contenido'];
                          $xContenido   = utf8_encode($filaCon['contenido']);
                          $xEstado      = $filaCon['estado'];
                      ?>
                      <img class="d-block b-1 border-light hover-shadow-2 p-1" src="assets/img/nosotros/<?php echo $xImagen; ?>" />
                      <h5><?php echo $xTitulo; ?></h5>
                      <p><?php 
                          $strCut = substr($xContenido,0,200);
                          $xContenido = substr($strCut,0,strrpos($strCut, ' ')).'...';
                          echo strip_tags($xContenido);
                        ?></p>
                      <hr>
                      <p><strong>Estado: <?php if($xEstado=="1"){echo "[Activo]";}else{ echo "[Inactivo]"; } ?> </strong></p>
                      <?php
                        }
                        mysqli_free_result($resultadoCon);
                      ?>
                    </div>
                  </div>
                </div>
                <div class="publisher bt-1 border-light">
                  <a href="nosotros-edit.php?cod_contenido=<?php echo $xCodigo; ?>" class="btn btn-bold btn-primary"><i class="fa fa-refresh"></i> Editar Visión</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-4 col-lg-4">
            <div class="col-md-12">
              <div class="card card-bordered">
                <h4 class="card-title"><strong>Objetivos</strong></h4>
                <div class="card-body">
                  <div class="row">
                    <div class="col-12 col-lg-12">
                      <?php
                        $consultarCon = "SELECT * FROM contenidos WHERE cod_contenido='4'";
                        $resultadoCon = mysqli_query($enlaces,$consultarCon) or die('Consulta fallida: ' . mysqli_error($enlaces));
                        while($filaCon = mysqli_fetch_array($resultadoCon)){
                          $xCodigo      = $filaCon['cod_contenido'];
                          $xTitulo      = utf8_encode($filaCon['titulo_contenido']);
                          $xImagen      = $filaCon['img_contenido'];
                          $xContenido   = utf8_encode($filaCon['contenido']);
                          $xEstado      = $filaCon['estado'];
                      ?>
                      <img class="d-block b-1 border-light hover-shadow-2 p-1" src="assets/img/nosotros/<?php echo $xImagen; ?>" />
                      <h5><?php echo $xTitulo; ?></h5>
                      <p><?php 
                          $strCut = substr($xContenido,0,200);
                          $xContenido = substr($strCut,0,strrpos($strCut, ' ')).'...';
                          echo strip_tags($xContenido);
                        ?></p>
                      <hr>
                      <p><strong>Estado: <?php if($xEstado=="1"){echo "[Activo]";}else{ echo "[Inactivo]"; } ?> </strong></p>
                      <?php
                        }
                        mysqli_free_result($resultadoCon);
                      ?>
                    </div>
                  </div>
                </div>
                <div class="publisher bt-1 border-light">
                  <a href="nosotros-edit.php?cod_contenido=<?php echo $xCodigo; ?>" class="btn btn-bold btn-primary"><i class="fa fa-refresh"></i> Editar Objetivos</a>
                </div>
              </div>
            </div>
          </div>
        </div>