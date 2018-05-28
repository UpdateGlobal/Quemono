<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include("module/head.php"); ?>
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
    <?php $menu="contacto"; include("module/menu.php"); ?>
    <?php include("module/header.php"); ?>
    <!-- Main container -->
    <main>
      <header class="header bg-ui-general">
        <div class="header-info">
          <h1 class="header-title">
            <strong>Contacto</strong>
            <small>Datos de contacto de su empresa</small>
          </h1>
        </div>
      </header><!--/.header -->
      <div class="main-content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-bordered">
              <h4 class="card-title"><strong>Contacto</strong></h4>
              <div class="media-list">
                <?php
                  $consultarCot = 'SELECT * FROM contacto';
                  $resultadoCot = mysqli_query($enlaces,$consultarCot) or die('Consulta fallida: ' . mysqli_error($enlaces));
                  while($filaCot  = mysqli_fetch_array($resultadoCot)){
                    $xCodigo      = $filaCot['cod_contact'];
                    $xDirection   = utf8_encode($filaCot['direction']);
                    $xPhone       = utf8_encode($filaCot['phone']);
                    $xEmail       = utf8_encode($filaCot['email']);
                    $xDayA        = utf8_encode($filaCot['diaa']);
                    $xHorarioA    = utf8_encode($filaCot['horarioa']);
                    $xDayB        = utf8_encode($filaCot['diab']);
                    $xHorarioB    = utf8_encode($filaCot['horariob']);
                    $xDayC        = utf8_encode($filaCot['diac']);
                    $xHorarioC    = utf8_encode($filaCot['horarioc']);
                    $xMap         = $filaCot['map'];
                    $xFace        = $filaCot['face'];
                    $xFormem      = utf8_encode($filaCot['form_mail']);
                ?>
                <ul class="list-group">
                  <li class="list-group-item">
                    <strong>Dirección:</strong><br>
                    <?php echo $xDirection; ?>
                  </li>
                  <li class="list-group-item">
                    <strong>Central de pedidos:</strong><br>
                    <?php echo $xPhone; ?>
                  </li>
                  <li class="list-group-item">
                    <strong>Horarios:</strong><br>
                    <u><?php echo $xDayA; ?></u> <?php echo $xHorarioA; ?><br>
                    <u><?php echo $xDayB; ?></u> <?php echo $xHorarioB; ?><br>
                    <u><?php echo $xDayC; ?></u> <?php echo $xHorarioC; ?>
                  </li>
                  <li class="list-group-item">
                    <strong>Emails:</strong><br>
                    <?php echo $xEmail; ?>
                  </li>
                  <?php if($xMap!=""){ ?>
                  <li class="list-group-item">
                    <strong>Mapa:</strong>
                    <div style="clear: both;"></div>
                    <?php echo $xMap; ?>
                  </li>
                  <?php }else{ ?>
                  <?php } ?>
                  <?php if($xFace!=""){ ?>
                  <li class="list-group-item">
                    <strong>Page Plugin Facebook:</strong>
                    <div style="clear: both;"></div>
                    <?php echo $xFace; ?>
                  </li>
                  <?php }else{ ?>
                  <?php } ?>
                  <li class="list-group-item">
                    <strong>Correo que recibe los mensajes del formulario:</strong><br>
                    <?php echo $xFormem; ?>
                  </li>
                </ul>
                <?php
                  }
                  mysqli_free_result($resultadoCot);
                ?>
              </div>
              <div class="publisher bt-1 border-light">
                <a href="contacto-edit.php?cod_contact=<?php echo $xCodigo; ?>" class="btn btn-bold btn-primary"><i class="fa fa-refresh"></i> Editar Contacto</a>
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
