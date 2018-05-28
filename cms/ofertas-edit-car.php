<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php
$cod_ofertas  = $_REQUEST['cod_ofertas'];
if (isset($_REQUEST['proceso'])) {
  $proceso  = $_POST['proceso'];
} else {
  $proceso  = "";
}
if($proceso==""){
  $consultaCon = "SELECT * FROM ofertas WHERE cod_ofertas='$cod_ofertas'";
  $ejecutarCon = mysqli_query($enlaces,$consultaCon) or die('Consulta fallida: ' . mysqli_error($enlaces));
  $filaCon = mysqli_fetch_array($ejecutarCon);
  $cod_ofertas    = $filaCon['cod_ofertas'];
  $imagen         = $filaCon['imagen'];
  $cod_categoria  = $filaCon['cod_categoria'];
  $link           = $filaCon['link'];
  $estado         = $filaCon['estado'];
}

if($proceso == "Actualizar"){
  $cod_ofertas    = $_POST['cod_ofertas'];
  $imagen         = $_POST['imagen'];
  $cod_categoria  = $_POST['cod_categoria'];
  $link           = $_POST['link'];
  $estado         = $_POST['estado'];

  $ActualizarCon = "UPDATE ofertas SET cod_ofertas='$cod_ofertas', imagen='$imagen', cod_categoria='$cod_categoria', link='$link', estado='$estado' WHERE cod_ofertas='$cod_ofertas'";
  $resultadoActualizar = mysqli_query($enlaces,$ActualizarCon) or die('Consulta fallida: ' . mysqli_error($enlaces));
  header("Location:ofertas.php");
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include("module/head.php"); ?>
    <script type="text/javascript" src="assets/js/rutinas.js"></script>
    <script>
      function Validar(){
        if(document.fcms.imagen.value==""){
          alert("Debe subir una imagen.");
          document.fcms.imagen.focus();
          return;
        }
        
        document.fcms.action = "ofertas-edit-car.php";
        document.fcms.proceso.value="Actualizar";
        document.fcms.submit();
      }
      function Imagen(codigo){
        url = "agregar-foto.php?id=" + codigo;
        AbrirCentro(url,'Agregar', 475, 180, 'no', 'no');
      }
    </script>
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
        <div class="card">
          <h4 class="card-title"><strong>Editar Oferta</strong></h4>
          <form class="fcms" name="fcms" method="post" action="" data-provide="validation" data-disable="false">
            <div class="card-body">

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="imagen">Imagen:</label><br>
                  <small>(
                    <?php if($cod_ofertas=="1"){ ?>1920px x 449px<?php } ?>
                    <?php if($cod_ofertas=="2"){ ?>570px x 453px<?php } ?>
                    <?php if($cod_ofertas=="3"){ ?>570px x 453px<?php } ?>
                    <?php if($cod_ofertas=="4"){ ?>1170px x 350px<?php } ?>
                  )</small>
                </div>
                <div class="col-4 col-lg-8">
                  <?php if($xVisitante=="1"){ ?><p><?php echo $imagen; ?></p><?php } ?>
                  <input class="form-control" id="imagen" name="imagen" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" value="<?php echo $imagen; ?>" />
                  <div class="invalid-feedback"></div>
                </div>
                <div class="col-4 col-lg-2">
                  <?php if($xVisitante=="0"){ ?>
                  <button class="btn btn-bold btn-info" type="button" name="boton4" onClick="javascript:Imagen('OFE');" /><i class="fa fa-save"></i> Examinar</button>
                  <?php } ?>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="categoria">Categor&iacute;a:</label><br>
                  <small>Carrusel de productos(<?php if($cod_ofertas=="2"){ ?>Izquierdo<?php } ?><?php if($cod_ofertas=="3"){ ?>Derecho<?php } ?>)</small>
                </div>
                <div class="col-8 col-lg-10">
                  <select class="form-control" id="categoria" name="cod_categoria">
                    <?php
                      $consultaCat = "SELECT * FROM productos_categorias WHERE cod_categoria='$cod_categoria'";
                      $resultadoCat = mysqli_query($enlaces, $consultaCat);
                      while($filaCat = mysqli_fetch_array($resultadoCat)){
                        $xCodcate = $filaCat['cod_categoria'];
                        $xCategoria = utf8_encode($filaCat['categoria']);
                      ?>
                      <option value="<?php echo $xCodcate; ?>"><?php echo $xCategoria; ?> (Actual)</option>
                      <?php } ?>
                      <?php
                        $consultaCat = "SELECT * FROM productos_categorias WHERE cod_categoria!='$cod_categoria'";
                        $resultadoCat = mysqli_query($enlaces, $consultaCat);
                        while($filaCat = mysqli_fetch_array($resultadoCat)){
                          $xCodcate = $filaCat['cod_categoria'];
                          $xCategoria = utf8_encode($filaCat['categoria']);
                      ?>
                      <option value="<?php echo $xCodcate; ?>"><?php echo $xCategoria; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="link">Enlace:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <?php if($xVisitante=="1"){ ?><p><?php echo $link; ?></p><?php } ?>
                  <input class="form-control" type="text" id="link" name="link" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" value="<?php echo $link; ?>">
                </div>
              </div>
              
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="estado">Estado:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <?php if($xVisitante=="1"){ ?><p><?php if($estado=="1"){ echo "[Activo]";}else{ echo "[Inactivo]"; } ?></p><?php }else{ ?>
                  <input type="checkbox" id="estado" name="estado" data-size="small" data-provide="switchery" value="1" <?php if($estado=="1"){echo "checked";} ?>>
                  <?php } ?>
                </div>
              </div>

            </div>
            <footer class="card-footer">
              <a href="ofertas.php" class="btn btn-secondary"><i class="fa fa-times"></i> Cancelar</a>
              <button class="btn btn-bold btn-primary" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-refresh"></i> Editar Ofertas</button>
              <input type="hidden" name="proceso">
              <input type="hidden" name="cod_ofertas" value="<?php echo $cod_ofertas; ?>">
            </footer>
          </form>
        </div>
      </div><!--/.main-content -->
      <?php include("module/footer_int.php"); ?>
    </main>
    <!-- END Main container -->
  </body>
</html>