<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include("module/head.php"); ?>
    <script src="assets/js/visitante-alert.js"></script>
  </head>
  <body>
    <!-- Preloader -->
    <div class="preloader">
      <div class="spinner-dots">
        <span class="dot1"></span>
        <span class="dot2"></span>
        <span class="dot3"></span>
      </div>
    </div>
    <?php $menu="inicio"; include("module/menu.php"); ?>
    <?php include("module/header.php"); ?>
    <!-- Main container -->
    <main>
      <header class="header bg-ui-general">
        <div class="header-info">
          <h1 class="header-title">
            <strong>Ofertas</strong>
            <small></small>
          </h1>
        </div>
        <?php $page="ofertas"; include("module/menu-inicio.php"); ?>
      </header><!--/.header -->
      <div class="main-content">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="card card-bordered">
              <h4 class="card-title"><strong>Oferta/Banner 1</strong></h4>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php
                      $consultarCon = "SELECT * FROM ofertas WHERE cod_ofertas='1'";
                      $resultadoCon = mysqli_query($enlaces,$consultarCon) or die('Consulta fallida: ' . mysqli_error($enlaces));
                      $filaCon = mysqli_fetch_array($resultadoCon);
                        $xCodigo     = $filaCon['cod_ofertas'];
                        $xImagen     = $filaCon['imagen'];
                        $xEstado     = $filaCon['estado'];
                    ?>
                    <img class="d-block b-1 border-light hover-shadow-2 p-1" src="assets/img/ofertas/<?php echo $xImagen; ?>" />
                    <p><strong>Estado: <?php if($xEstado=="1"){echo "[Activo]";}else{ echo "[Inactivo]"; } ?> </strong></p>
                    <?php
                      mysqli_free_result($resultadoCon);
                    ?>
                  </div>
                </div>
              </div>
              <div class="publisher bt-1 border-light">
                <a href="ofertas-edit.php?cod_ofertas=<?php echo $xCodigo; ?>" class="btn btn-bold btn-primary"><i class="fa fa-refresh"></i> Editar Oferta</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="card card-bordered">
              <h4 class="card-title"><strong>Oferta/Banner 2</strong></h4>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php
                      $consultarCon = "SELECT * FROM ofertas WHERE cod_ofertas='2'";
                      $resultadoCon = mysqli_query($enlaces,$consultarCon) or die('Consulta fallida: ' . mysqli_error($enlaces));
                      $filaCon = mysqli_fetch_array($resultadoCon);
                        $xCodigo     = $filaCon['cod_ofertas'];
                        $xImagen     = $filaCon['imagen'];
                        $xEstado     = $filaCon['estado'];
                    ?>
                    <img class="d-block b-1 border-light hover-shadow-2 p-1" src="assets/img/ofertas/<?php echo $xImagen; ?>" />
                    <p><strong>Estado: <?php if($xEstado=="1"){echo "[Activo]";}else{ echo "[Inactivo]"; } ?> </strong></p>
                    <?php
                      mysqli_free_result($resultadoCon);
                    ?>
                  </div>
                </div>
              </div>
              <div class="publisher bt-1 border-light">
                <a href="ofertas-edit.php?cod_ofertas=<?php echo $xCodigo; ?>" class="btn btn-bold btn-primary"><i class="fa fa-refresh"></i> Editar Oferta</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="card card-bordered">
              <h4 class="card-title"><strong>Oferta/Banner 3</strong></h4>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php
                      $consultarCon = "SELECT * FROM ofertas WHERE cod_ofertas='3'";
                      $resultadoCon = mysqli_query($enlaces,$consultarCon) or die('Consulta fallida: ' . mysqli_error($enlaces));
                      $filaCon = mysqli_fetch_array($resultadoCon);
                        $xCodigo     = $filaCon['cod_ofertas'];
                        $xImagen     = $filaCon['imagen'];
                        $xEstado     = $filaCon['estado'];
                    ?>
                    <img class="d-block b-1 border-light hover-shadow-2 p-1" src="assets/img/ofertas/<?php echo $xImagen; ?>" />
                    <p><strong>Estado: <?php if($xEstado=="1"){echo "[Activo]";}else{ echo "[Inactivo]"; } ?> </strong></p>
                    <?php
                      mysqli_free_result($resultadoCon);
                    ?>
                  </div>
                </div>
              </div>
              <div class="publisher bt-1 border-light">
                <a href="ofertas-edit.php?cod_ofertas=<?php echo $xCodigo; ?>" class="btn btn-bold btn-primary"><i class="fa fa-refresh"></i> Editar Oferta</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include("module/footer_int.php"); ?>
    </main>
    <!-- END Main container -->
</body>
</html>