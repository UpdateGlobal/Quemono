<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php
$cod_categoria  = $_REQUEST['cod_categoria'];
if (isset($_REQUEST['proceso'])){
  $proceso = $_POST['proceso'];
} else {
  $proceso = "";
}
if($proceso == ""){
  $consultaCategoria = "SELECT * FROM noticias_categorias WHERE cod_categoria='$cod_categoria'";
  $ejecutarCategoria = mysqli_query($enlaces,$consultaCategoria) or die('Consulta fallida: ' . mysqli_error($enlaces));
  $filaCat = mysqli_fetch_array($ejecutarCategoria);
  $cod_categoria  = $filaCat['cod_categoria'];
  $categoria    = htmlspecialchars($filaCat['categoria']);
  $orden      = $filaCat['orden'];
  $estado     = $filaCat['estado'];
}

if($proceso=="Actualizar"){
  $cod_categoria    = $_POST['cod_categoria'];
  $categoria        = mysqli_real_escape_string($enlaces, $_POST['categoria']);
  $slug             = $categoria;
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
  $actualizarCategoria  = "UPDATE noticias_categorias SET cod_categoria='$cod_categoria', slug='$slug', categoria='$categoria', orden='$orden', estado='$estado' WHERE cod_categoria='$cod_categoria'";
  $resultadoActualizar = mysqli_query($enlaces,$actualizarCategoria) or die('Consulta fallida: ' . mysqli_error($enlaces));

  header("Location:noticias-categorias.php");
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include("module/head.php"); ?>
    <script type="text/javascript" src="assets/js/rutinas.js"></script>
    <script>
      function Validar(){
        if(document.fcms.categoria.value==""){
          alert("Debes ingresar un nombre a la categoria");
          document.fcms.categoria.focus();
          return;
        }
        document.fcms.action = "noticias-categorias-edit.php";
        document.fcms.proceso.value = "Actualizar";
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
    <?php $menu="noticias"; include("module/menu.php"); ?>
    <?php include("module/header.php"); ?>
    <!-- Main container -->
    <main>
      <header class="header bg-ui-general">
        <div class="header-info">
          <h1 class="header-title">
            <strong>Noticias</strong>
            <small></small>
          </h1>
        </div>
        <?php $page="noticiascategorias"; include("module/menu-noticias.php"); ?>
      </header><!--/.header -->
      <div class="main-content">
        <div class="card">
          <h4 class="card-title"><strong>Editar Categoría</strong></h4>
          <form class="fcms" name="fcms" method="post" action="" data-provide="validation" data-disable="false">
            <div class="card-body">
              <?php if(isset($mensaje)){ echo $mensaje; } else {}; ?>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label required" for="categoria">Categoría:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" name="categoria" type="text" id="categoria" value="<?php echo $categoria; ?>" required />
                  <div class="invalid-feedback"></div>
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
                  <input type="checkbox" name="estado" data-size="small" data-provide="switchery" value="1" <?php if($estado=="1"){echo "checked";} ?> >
                </div>
              </div>
            </div>

            <footer class="card-footer">
              <a href="noticias-categorias.php" class="btn btn-secondary"><i class="fa fa-times"></i> Cancelar</a>
              <button class="btn btn-bold btn-primary" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-refresh"></i> Publicar Categoría</button>
              <input type="hidden" name="proceso">
              <input type="hidden" name="cod_categoria" value="<?php echo $cod_categoria; ?>">
            </footer>

          </form>
        </div>
      </div><!--/.main-content -->
      <?php include("module/footer_int.php"); ?>
    </main>
    <!-- END Main container -->
  </body>
</html>