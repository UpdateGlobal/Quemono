<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php
$mensaje = "";
if (isset($_REQUEST['proceso'])) {
  $proceso = $_POST['proceso'];
} else {
  $proceso = "";
}
if($proceso == "Registrar"){
  $cod_principal  = $_POST['cod_principal'];
  $cod_categoria  = $_POST['cod_categoria'];
  $subcategoria   = mysqli_real_escape_string($enlaces, $_POST['subcategoria']);
  $slug         = $subcategoria;
  $slug         = preg_replace('~[^\pL\d]+~u', '-', $slug);
  $slug         = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);
  $slug         = preg_replace('~[^-\w]+~', '', $slug);
  $slug         = trim($slug, '-');
  $slug         = preg_replace('~-+~', '-', $slug);
  $slug         = strtolower($slug);
  if (empty($slug)){
      return 'n-a';
  }
  $orden          = $_POST['orden'];
  $estado         = $_POST['estado'];

  $insertarSubCategoria = "INSERT INTO productos_sub_categorias(cod_principal, cod_categoria, slug, subcategoria, orden, estado)VALUE('$cod_principal', '$cod_categoria', '$slug', '$subcategoria', '$orden', '$estado')";
  $resultadoInsertar = mysqli_query($enlaces, $insertarSubCategoria);
  $mensaje = "<div class='alert alert-success' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            <strong>Nota:</strong> La categor&iacute;a se registr&oacute; con exitosamente. <a href='productos-subcategorias.php'>Ir a Sub-Categorias de Productos</a>
          </div>";
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include("module/head.php"); ?>
    <script type="text/javascript" src="assets/js/rutinas.js"></script>
    <script>
      function Validar(){
        if(document.fcms.cod_principal.value=="default"){
          alert("Debe elegir una categoría principal");
          return;
        }
        if(document.fcms.cod_categoria.value=="default"){
          alert("Debe elegir una categoría principal");
          return;
        }
        if(document.fcms.subcategoria.value==""){
          alert("Debe escribir un nombre para la Sub-Categoria");
          document.fcms.subcategoria.focus();
          return; 
        }
        document.fcms.action = "productos-subcategorias-nuevo.php";
        document.fcms.proceso.value="Registrar";
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
    <?php $menu="productos"; include("module/menu.php"); ?>
    <?php include("module/header.php"); ?>
    <!-- Main container -->
    <main>
      <header class="header bg-ui-general">
        <div class="header-info">
          <h1 class="header-title">
            <strong>Productos</strong>
            <small></small>
          </h1>
        </div>
        <?php $page="productossubcategorias"; include("module/menu-productos.php"); ?>
      </header><!--/.header -->
      <div class="main-content">
        <div class="card">
          <h4 class="card-title"><strong>Nueva Categor&iacute;a</strong></h4>
          <form class="fcms" name="fcms" method="post" action="" data-provide="validation" data-disable="false">
            <div class="card-body">
              <?php if(isset($mensaje)){ echo $mensaje; } else {}; ?>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label required" for="categoria">Categor&iacute;a:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <select class="form-control" id="categoria" name="cod_categoria">
                    <option value="0">Sin Categor&iacute;a Principal</option>
                    <?php
                      $consultaCat = "SELECT * FROM productos_categorias ORDER BY categoria ASC";
                      $resultadoCat = mysqli_query($enlaces, $consultaCat);
                      while($filaCat = mysqli_fetch_array($resultadoCat)){
                        $xCodcate = $filaCat['cod_categoria'];
                        $xCategoria = $filaCat['categoria'];
                    ?>
                    <option value="<?php echo $xCodcate; ?>"><?php echo $xCategoria; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label>Sub-Categor&iacute;a:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" name="subcategoria" type="text" id="subcategoria" />
                  <div class="invalid-feedback"></div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="orden">Orden:</label>
                </div>
                <div class="col-2 col-lg-1">
                  <input class="form-control" name="orden" type="text" id="orden" onKeyPress="return soloNumeros(event)" />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="estado">Estado:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input type="checkbox" name="estado" data-size="small" data-provide="switchery" value="1" checked>
                </div>
              </div>
            </div>

            <footer class="card-footer">
              <a href="productos-subcategorias.php" class="btn btn-secondary"><i class="fa fa-times"></i> Cancelar</a>
              <button class="btn btn-bold btn-primary" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-chevron-circle-right"></i> Publicar Categor&iacute;a</button>
              <input type="hidden" name="proceso">
            </footer>

          </form>
        </div>
      </div><!--/.main-content -->
      <?php include("module/footer_int.php"); ?>
    </main>
    <!-- END Main container -->
  </body>
</html>