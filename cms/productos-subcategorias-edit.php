<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php
$cod_sub_categoria = $_REQUEST['cod_sub_categoria'];
if (isset($_REQUEST['proceso'])) {
  $proceso = $_POST['proceso'];
} else {
  $proceso = "";
}
if($proceso == ""){
  $consultaSubCat = "SELECT * FROM productos_sub_categorias WHERE cod_sub_categoria='$cod_sub_categoria'";
  $resultadoSubCat = mysqli_query($enlaces, $consultaSubCat);
  $filaSC = mysqli_fetch_array($resultadoSubCat);
  $cod_principal        = $filaSC['cod_principal'];
  $cod_categoria        = $filaSC['cod_categoria'];
  $cod_sub_categoria    = $filaSC['cod_sub_categoria'];
  $subcategoria         = htmlspecialchars($filaSC['subcategoria']);
  $orden                = $filaSC['orden'];
  $estado               = $filaSC['estado'];
}
if($proceso == "Filtrar"){
  $cod_principal          = $_POST['cod_principal'];
  $cod_categoria          = $_POST['cod_categoria'];
  $subcategoria           = $_POST['subcategoria'];
  if(isset($_POST['orden'])){$orden = $_POST['orden'];}else{$orden = 0;}
  if(isset($_POST['estado'])){$estado = $_POST['estado'];}else{$estado = 0;}
}
if($proceso == "Actualizar"){
  $cod_principal        = $_POST['cod_principal'];
  $cod_categoria        = $_POST['cod_categoria'];
  $cod_sub_categoria    = $_POST['cod_sub_categoria'];
  $subcategoria         = mysqli_real_escape_string($enlaces, $_POST['subcategoria']);
  $slug                 = $subcategoria;
  $slug                 = preg_replace('~[^\pL\d]+~u', '-', $slug);
  $slug                 = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);
  $slug                 = preg_replace('~[^-\w]+~', '', $slug);
  $slug                 = trim($slug, '-');
  $slug                 = preg_replace('~-+~', '-', $slug);
  $slug                 = strtolower($slug);
  if (empty($slug)){
      return 'n-a';
  }
  $orden                = $_POST['orden'];
  $estado               = $_POST['estado'];
  
  $actualizarSubCategoria = "UPDATE productos_sub_categorias SET cod_principal='$cod_principal', cod_sub_categoria='$cod_sub_categoria', cod_categoria='$cod_categoria', slug='$slug', subcategoria='$subcategoria', orden='$orden', estado='$estado' WHERE cod_sub_categoria='$cod_sub_categoria'";
  $resultadoActualizar = mysqli_query($enlaces, $actualizarSubCategoria);
  
  header("Location: productos-subcategorias.php");
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
          alert("Debe escribir un nombre para la Categoria");
          document.fcms.subcategoria.focus();
          return;
        }
        document.fcms.action = "productos-subcategorias-edit.php";
        document.fcms.proceso.value="Actualizar";
        document.fcms.submit();
      }
      function Filtrar(){
        document.fcms.action = "productos-subcategorias-edit.php";
        document.fcms.proceso.value = "Filtrar";
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
          <h4 class="card-title"><strong>Editar Sub-Categor&iacute;a</strong></h4>
          <form class="fcms" name="fcms" method="post" action="" data-provide="validation" data-disable="false">
            <div class="card-body">
              <?php if(isset($mensaje)){ echo $mensaje; } else {}; ?>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="principal">Categor&iacute;a Principal:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <select class="form-control" id="principal" name="cod_principal" onChange="Filtrar();">
                    <?php 
                      if($cod_principal == ""){
                        $consultaPri = "SELECT * FROM productos_principal WHERE estado='1'";
                        $resultaPri = mysqli_query($enlaces, $consultaPri);
                        while($filaPri = mysqli_fetch_array($resultaPri)){
                          $xcodPri = $filaPri['cod_principal'];
                          $xnomPri = $filaPri['principal'];
                          echo '<option value='.$xcodPri.'>'.$xnomPri.'</option>';
                        }
                      }else{
                        $consultaPri = "SELECT * FROM productos_principal WHERE cod_principal='$cod_principal'";
                        $resultaPri = mysqli_query($enlaces, $consultaPri);
                        while($filaPri = mysqli_fetch_array($resultaPri)){
                          $xcodPri = $filaPri['cod_principal'];
                          $xnomPri = $filaPri['principal'];
                          echo '<option value='.$xcodPri.' selected="selected">'.$xnomPri.'</option>';
                        }
                        $consultaPri = "SELECT * FROM productos_principal WHERE cod_principal!='$cod_principal'";
                        $resultaPri = mysqli_query($enlaces, $consultaPri);
                        while($filaPri = mysqli_fetch_array($resultaPri)){
                          $xcodPri = $filaPri['cod_principal'];
                          $xnomPri = $filaPri['principal'];
                          echo '<option value='.$xcodPri.'>'.$xnomPri.'</option>';
                        }
                      }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="categoria">Categor&iacute;a:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <select class="form-control" id="categoria" name="cod_categoria">
                    <?php 
                      if($cod_principal==""){
                        echo '<option value="0">Sin Categor&iacute;a</option>';
                      }else{
                        if(($cod_categoria=="")or($cod_categoria=="0")){
                          $consultaCat = "SELECT * FROM productos_categorias WHERE estado='1' AND cod_principal='$cod_principal'";
                          $resulCat = mysqli_query($enlaces, $consultaCat);
                          while($fb=mysqli_fetch_array($resulCat)){
                            $xcodCat = $fb['cod_sub_categoria'];
                            $xnomCat = $fb['categoria'];
                            echo '<option value='.$xcodCat.'>'.$xnomCat.'</option>';
                          }
                        }else{
                          $consultaCat = "SELECT * FROM productos_categorias WHERE estado='1' AND cod_principal='$cod_principal' AND cod_categoria='$cod_categoria'";
                          $resulCat = mysqli_query($enlaces, $consultaCat);
                          while($fb=mysqli_fetch_array($resulCat)){
                            $xcodCat = $fb['cod_categoria'];
                            $xnomCat = $fb['categoria'];
                            echo '<option value='.$xcodCat.'>'.$xnomCat.'</option>';
                          }

                          $consultaCat = "SELECT * FROM productos_categorias WHERE estado='1' AND cod_principal='$cod_principal' AND cod_categoria!='$cod_categoria'";
                          $resulCat = mysqli_query($enlaces, $consultaCat);
                          while($fb=mysqli_fetch_array($resulCat)){
                            $xcodCat = $fb['cod_categoria'];
                            $xnomCat = $fb['categoria'];
                            echo '<option value='.$xcodCat.'>'.$xnomCat.'</option>';
                          }
                        }
                      }
                    ?>
                    <option value="0">Sin Categor&iacute;a</option>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="subcetegoria">Sub-Categor&iacute;a:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" name="subcategoria" type="text" id="subcategoria" value="<?php echo $subcategoria; ?>" />
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
                  <input type="checkbox" name="estado" data-size="small" data-provide="switchery" value="1" <?php if($estado=="1"){echo "checked";} ?> />
                </div>
              </div>
            </div>

            <footer class="card-footer">
              <a href="productos-subcategorias.php" class="btn btn-secondary"><i class="fa fa-times"></i> Cancelar</a>
              <button class="btn btn-bold btn-primary" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-refresh"></i> Editar SubCategor&iacute;a</button>
              <input type="hidden" name="proceso">
              <input type="hidden" name="cod_sub_categoria" value="<?php echo $cod_sub_categoria; ?>">
            </footer>

          </form>
        </div>
      </div><!--/.main-content -->
      <?php include("module/footer_int.php"); ?>
    </main>
    <!-- END Main container -->
  </body>
</html>