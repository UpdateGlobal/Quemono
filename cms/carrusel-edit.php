<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php
$cod_carrusel = $_REQUEST['cod_carrusel'];
if (isset($_REQUEST['proceso'])) {
  $proceso  = $_POST['proceso'];
} else {
  $proceso  = "";
}
if($proceso == ""){
  $consultaCarrusel = "SELECT * FROM carrusel WHERE cod_carrusel='$cod_carrusel'";
  $ejecutarCarrusel = mysqli_query($enlaces,$consultaCarrusel) or die('Consulta fallida: ' . mysqli_error($enlaces));
  $filaCar = mysqli_fetch_array($ejecutarCarrusel);
  $cod_carrusel     = $filaCar['cod_carrusel'];
  $imagen           = $filaCar['imagen'];
  $marca            = $filaCar['marca'];
  $orden            = $filaCar['orden'];
  $estado           = $filaCar['estado'];
}
if($proceso=="Actualizar"){
  $cod_carrusel     = $_POST['cod_carrusel'];
  $imagen           = $_POST['imagen'];
  $marca            = mysqli_real_escape_string($enlaces, $_POST['marca']);
  $slug             = $marca;
  $slug             = preg_replace('~[^\pL\d]+~u', '-', $slug);
  $slug             = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);
  $slug             = preg_replace('~[^-\w]+~', '', $slug);
  $slug             = trim($slug, '-');
  $slug             = preg_replace('~-+~', '-', $slug);
  $slug             = strtolower($slug);
  if (empty($slug)){
      return 'n-a';
  }
  $orden            = $_POST['orden'];
  $estado           = $_POST['estado'];
  $actualizarCarrusel = "UPDATE carrusel SET cod_carrusel='$cod_carrusel', slug='$slug', imagen='$imagen', marca='$marca', orden='$orden', estado='$estado' WHERE cod_carrusel='$cod_carrusel'";
  $resultadoActualizar = mysqli_query($enlaces,$actualizarCarrusel) or die('Consulta fallida: ' . mysqli_error($enlaces));
  
  header("Location:carrusel.php");
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
          alert("Debe subir una imagen");
          return;
        }
        if(document.fcms.marca.value==""){
          alert("Debe escribir el nombre de la marca");
          return;
        }
        if(document.fcms.orden.value==""){
          alert("Debes especificar un número de orden");
          document.fcms.orden.focus();
          return;
        }
        document.fcms.action = "carrusel-edit.php";
        document.fcms.proceso.value="Actualizar";
        document.fcms.submit();
      } 
      function Imagen(codigo){
        url = "agregar-foto.php?id=" + codigo;
        AbrirCentro(url,'Agregar', 475, 180, 'no', 'no');
      }
      function soloNumeros(e){ 
        var key = window.Event ? e.which : e.keyCode 
        return ((key >= 48 && key <= 57) || (key==8)) 
      }
    </script>
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
            <strong>Marcas</strong>
            <small></small>
          </h1>
        </div>
        <?php $page="carrusel"; include("module/menu-inicio.php"); ?>
      </header><!--/.header -->
      <div class="main-content">
        <div class="card">
          <h4 class="card-title"><strong>Editar Marcas</strong></h4>
          <form class="fcms" name="fcms" method="post" action="" data-provide="validation" data-disable="false">
            <div class="card-body">

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label require" for="imagen">Imagen:</label><br>
                  <small>(210px x 105px)</small>
                </div>
                <div class="col-4 col-lg-8">
                  <?php if($xVisitante=="1"){ ?><p><?php echo $imagen; ?></p><?php } ?>
                  <input class="form-control" id="imagen" name="imagen" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" id="imagen" value="<?php echo $imagen; ?>" required>
                  <div class="invalid-feedback"></div>
                </div>
                <div class="col-4 col-lg-2">
                  <?php if($xVisitante=="0"){ ?>
                  <button class="btn btn-info" type="button" name="boton2" onClick="javascript:Imagen('CAR');" /><i class="fa fa-save"></i> Examinar</button>
                  <?php } ?>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label require" for="marca">Marca:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" id="marca" name="marca" type="text" value="<?php echo $marca; ?>" required>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="orden">Orden:</label>
                </div>
                <div class="col-2 col-lg-1">
                  <input class="form-control" name="orden" type="text" id="orden" value="<?php echo $orden; ?>" onKeyPress="return soloNumeros(event)" />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="estado">Estado:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input type="checkbox" name="estado" data-size="small" data-provide="switchery" value="1" <?php if($estado="1"){echo "checked";} ?>>
                </div>
              </div>

            </div>
            <footer class="card-footer">
              <a href="carrusel.php" class="btn btn-secondary"><i class="fa fa-times"></i> Cancelar</a>
              <button class="btn btn-bold btn-primary" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-refresh"></i> Editar Marca</button>
              <input type="hidden" name="proceso">
              <input type="hidden" name="cod_carrusel" value="<?php echo $cod_carrusel; ?>">
            </footer>

          </form>
        </div>
      </div><!--/.main-content -->
      <?php include("module/footer_int.php"); ?>
    </main>
    <!-- END Main container -->
  </body>
</html>