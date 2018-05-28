<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php
$mensaje = "";
$cod_categoria = "";
$cod_sub_categoria = "";
if (isset($_REQUEST['proceso'])){
  $proceso = $_POST['proceso'];
} else {
  $proceso = "";
}
if($proceso == "Filtrar"){
  $cod_categoria      = $_POST['cod_categoria'];
  $cod_sub_categoria  = $_POST['cod_sub_categoria'];
}

if($proceso == "Registrar"){
  $cod_categoria          = $_POST['cod_categoria'];
  $cod_sub_categoria      = $_POST['cod_sub_categoria'];
  $nom_producto           = mysqli_real_escape_string($enlaces, $_POST['nom_producto']);
  $slug                   = $nom_producto;
  $slug                   = preg_replace('~[^\pL\d]+~u', '-', $slug);
  $slug                   = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);
  $slug                   = preg_replace('~[^-\w]+~', '', $slug);
  $slug                   = trim($slug, '-');
  $slug                   = preg_replace('~-+~', '-', $slug);
  $slug                   = strtolower($slug);
  if (empty($slug)){
      return 'n-a';
  }
  $descripcion            = mysqli_real_escape_string($enlaces, $_POST['descripcion']);
  $caracteristicas        = mysqli_real_escape_string($enlaces, $_POST['caracteristicas']);
  $info_adicional         = mysqli_real_escape_string($enlaces, $_POST['info_adicional']);
  $video                  = $_POST['video'];
  $stock                  = $_POST['stock'];
  $codigo                 = $_POST['codigo'];
  $precio_oferta          = substr(utf8_decode($_POST['precio_oferta']),0,20);
  $precio_normal          = substr(utf8_decode($_POST['precio_normal']),0,20);
  $descuento              = $_POST['descuento'];
  $promocion              = $_POST['promocion'];
  if(isset($_POST['fecha_ing'])){ $fecha_ing = $_POST['fecha_ing']; }else{ $fecha_ing = date("Y-m-d"); }
  $imagen                 = $_POST['imagen'];
  $hoverimagen            = $_POST['h_imagen'];
  $cod_carrusel           = $_POST['cod_carrusel'];
  if(isset($_POST['orden'])){$orden = $_POST['orden'];}else{$orden = 0;}
  if(isset($_POST['estado'])){$estado = $_POST['estado'];}else{$estado = 0;}
  
  $validarProductos = "SELECT * FROM productos WHERE nom_producto='$nom_producto'";
  $ejecutarValidar = mysqli_query($enlaces, $validarProductos);
  $numreg = mysqli_num_rows($ejecutarValidar);
  
  $insertarProductos = "INSERT INTO productos (cod_categoria, cod_sub_categoria, nom_producto, slug, descripcion, caracteristicas, info_adicional, video, stock, codigo, precio_oferta, precio_normal, descuento, promocion, fecha_ing, imagen, h_imagen, cod_carrusel, orden, estado) VALUE ('$cod_categoria', '$cod_sub_categoria', '$nom_producto', '$slug', '$descripcion', '$caracteristicas', '$info_adicional', '$video', '$stock', '$codigo', '$precio_oferta', '$precio_normal', '$descuento', '$promocion', '$fecha_ing', '$imagen', '$hoverimagen', '$cod_carrusel', '$orden', '$estado')";
  $resultadoInsertar = mysqli_query($enlaces, $insertarProductos);
  $mensaje = "<div class='alert alert-success' role='alert'>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
          <strong>Nota:</strong> Producto se registr&oacute; exitosamente. <a href='productos.php'>Ir a Productos</a>
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
        if(document.fcms.cod_categoria.value=="default"){
          alert("Elegir una categoría");
          return;
        }
        if(document.fcms.cod_sub_categoria.value=="default"){
          alert("Elegir una sub-categoría");
          return;
        }
        if(document.fcms.nom_producto.value==""){
          alert("Debe escribir un nombre");
          document.fcms.nom_producto.focus();
          return;
        }
        if(document.fcms.imagen.value==""){
          alert("Debe subir una imagen");
          document.fcms.imagen.focus();
          return;
        }
        if(document.fcms.cod_carrusel.value=="default"){
          alert("Debe asignarle una marca");
          return;
        }
        document.fcms.action = "productos-nuevo.php";
        document.fcms.proceso.value = "Registrar";
        document.fcms.submit();
      }
      function Filtrar(){
        document.fcms.action = "productos-nuevo.php";
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
        <?php $page="productos"; include("module/menu-productos.php"); ?>
      </header><!--/.header -->
      <div class="main-content">
        <div class="card">
          <h4 class="card-title"><strong>Producto Nuevo</strong></h4>
          <form class="fcms" name="fcms" method="post" action="" data-provide="validation" data-disable="false">
            <div class="card-body">
              <?php if(isset($mensaje)){ echo $mensaje; } else {}; ?>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="cod_categoria">Categor&iacute;a:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <select class="form-control" name="cod_categoria" id="cod_categoria" onChange="Filtrar();">
                    <option value="0">Sin categor&iacute;a</option>
                    <?php
                      if($cod_categoria == ""){
                        $consultaCat = "SELECT * FROM productos_categorias WHERE estado='1'";
                        $resultaCat = mysqli_query($enlaces, $consultaCat);
                        while($filaCat = mysqli_fetch_array($resultaCat)){
                          $xcodCat = $filaCat['cod_categoria'];
                          $xnomCat = $filaCat['categoria'];
                          echo '<option value='.$xcodCat.'>'.$xnomCat.'</option>';
                        }
                      }else{
                        $consultaCat = "SELECT * FROM productos_categorias WHERE cod_categoria='$cod_categoria'";
                        $resultaCat = mysqli_query($enlaces, $consultaCat);
                        while($filaCat = mysqli_fetch_array($resultaCat)){
                          $xcodCat = $filaCat['cod_categoria'];
                          $xnomCat = $filaCat['categoria'];
                          echo '<option value='.$xcodCat.' selected="selected">'.$xnomCat.'</option>';
                        }
                        $consultaCat = "SELECT * FROM productos_categorias WHERE cod_categoria!='$cod_categoria'";
                        $resultaCat = mysqli_query($enlaces, $consultaCat);
                        while($filaCat = mysqli_fetch_array($resultaCat)){
                          $xcodCat = $filaCat['cod_categoria'];
                          $xnomCat = $filaCat['categoria'];
                          echo '<option value='.$xcodCat.'>'.$xnomCat.'</option>';
                        }
                      }
                    ?>
                  </select>
                </div>
              </div>
              
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label required" for="cod_sub_categoria">Sub Categor&iacute;as:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <select class="form-control" name="cod_sub_categoria" id="cod_sub_categoria" required>
                    <?php 
                      if($cod_categoria==""){
                        echo '<option value="0">Seleccione una Categor&iacute;a</option>';
                      }else{
                        if(($cod_sub_categoria=="")or($cod_sub_categoria=="0")){
                          $consultaSubCat = "SELECT * FROM productos_sub_categorias WHERE estado='1' AND cod_categoria='$cod_categoria'";
                          $resulSubCat = mysqli_query($enlaces, $consultaSubCat);
                          echo '<option value="0">Seleccione una Sub-Categor&iacute;a</option>';
                          while($fsb=mysqli_fetch_array($resulSubCat)){
                            $xcodSubCat = $fsb['cod_sub_categoria'];
                            $xnomSubCat = $fsb['subcategoria'];
                            echo '<option value='.$xcodSubCat.'>'.$xnomSubCat.'</option>';
                          }
                        }else{
                          $consultaSubCat = "SELECT * FROM productos_sub_categorias WHERE estado='1' AND cod_categoria='$cod_categoria' AND cod_sub_categoria='$cod_sub_categoria'";
                          $resulSubCat = mysqli_query($enlaces, $consultaSubCat);
                          while($fsb=mysqli_fetch_array($resulSubCat)){
                            $xcodSubCat = $fsb['cod_sub_categoria'];
                            $xnomSubCat = $fsb['subcategoria'];
                            echo '<option value='.$xcodSubCat.' selected="selected">'.$xnomSubCat.'</option>';
                          }

                          $consultaSubCat = "SELECT * FROM productos_sub_categorias WHERE estado='1' AND cod_categoria='$cod_categoria' AND cod_sub_categoria!='$cod_sub_categoria'";
                          $resulSubCat = mysqli_query($enlaces, $consultaSubCat);
                          echo '<option value="0">Seleccione una Categor&iacute;a</option>';
                          while($fsb=mysqli_fetch_array($resulSubCat)){
                            $xcodSubCat = $fsb['cod_sub_categoria'];
                            $xnomSubCat = $fsb['subcategoria'];
                            echo '<option value='.$xcodSubCat.'>'.$xnomSubCat.'</option>';
                          }
                        }
                      }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="cod_carrusel">Marca:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <select class="form-control" name="cod_carrusel" id="cod_carrusel">
                    <option value="default">Sin Marca</option>
                    <?php
                      if($cod_carrusel == ""){
                        $consultaCar = "SELECT * FROM carrusel WHERE estado='1'";
                        $resultaCar = mysqli_query($enlaces, $consultaCar);
                        while($filaCar = mysqli_fetch_array($resultaCar)){
                          $xcodCar = $filaCar['cod_carrusel'];
                          $xnomCar = $filaCar['marca'];
                          echo '<option value='.$xcodCar.'>'.$xnomCar.'</option>';
                        }
                      }else{
                        $consultaCar = "SELECT * FROM carrusel WHERE cod_carrusel='$cod_carrusel'";
                        $resultaCar = mysqli_query($enlaces, $consultaCar);
                        while($filaCar = mysqli_fetch_array($resultaCar)){
                          $xcodCar = $filaCar['cod_carrusel'];
                          $xnomCar = $filaCar['marca'];
                          echo '<option value='.$xcodCar.' selected="selected">'.$xnomCar.'</option>';
                        }
                        $consultaCar = "SELECT * FROM carrusel WHERE cod_carrusel!='$cod_carrusel'";
                        $resultaCar = mysqli_query($enlaces, $consultaCar);
                        while($filaCar = mysqli_fetch_array($resultaCar)){
                          $xcodCar = $filaCar['cod_carrusel'];
                          $xnomCar = $filaCar['marca'];
                          echo '<option value='.$xcodCar.'>'.$xnomCar.'</option>';
                        }
                      }
                    ?>
                  </select>
                </div>
              </div>
              
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label required" for="nom_producto">Nombre de producto:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" id="nom_producto" name="nom_producto" type="text" required />
                  <div class="invalid-feedback"></div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="descripcion">Descripci&oacute;n:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <textarea class="form-control" name="descripcion" id="descripcion" data-toolbar="full" data-provide="summernote" data-min-height="150"></textarea>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="caracteristicas">Caracter&iacute;sticas:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <textarea class="form-control" name="caracteristicas" id="caracteristicas" data-toolbar="full" data-provide="summernote" data-min-height="150"></textarea>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="info_adicional">Informaci&oacute;n adicional:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <textarea class="form-control" name="info_adicional" id="info_adicional" data-toolbar="full" data-provide="summernote" data-min-height="150"></textarea>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="video">V&iacute;deo:</label>
                </div>
                <div class="col-8 col-lg-6">
                  <input class="form-control" id="video" name="video" type="text" />
                  <div class="invalid-feedback"></div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="stock">Stock:</label><br>
                  <small>(Ejemplo: En Stock)</small>
                </div>
                <div class="col-8 col-lg-3">
                  <input class="form-control" id="stock" name="stock" type="text" />
                  <div class="invalid-feedback"></div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="codigo">C&oacute;digo:</label>
                </div>
                <div class="col-8 col-lg-3">
                  <input class="form-control" id="codigo" name="codigo" type="text" />
                  <div class="invalid-feedback"></div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label">Precio Oferta:</label>
                </div>
                <div class="col-4 col-lg-3">
                  <input class="form-control" name="precio_oferta" type="text" id="precio_oferta" />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label">Precio Normal:</label>
                </div>
                <div class="col-4 col-lg-3">
                  <input class="form-control" name="precio_normal" type="text" id="precio_normal" />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="descuento">Descuento:</label><br>
                  <small>(Ejemplo: 25%)</small>
                </div>
                <div class="col-8 col-lg-3">
                  <input class="form-control" id="descuento" name="descuento" type="text" />
                  <div class="invalid-feedback"></div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label">Promoci&oacute;n:</label>
                </div>
                <div class="col-4 col-lg-3">
                  <label class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="promocion" value="0" checked>
                    <span class="custom-control-indicator"></span>
                    <span class="custom-control-description"> No</span>
                  </label>
                  <label class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="promocion" value="1">
                    <span class="custom-control-indicator"></span>
                    <span class="custom-control-description"> S&iacute;</span>
                  </label>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label">Fecha de Ingreso:</label>
                </div>
                <div class="col-4 col-lg-3">
                  <input class="form-control" id="fecha_ing" name="fecha_ing" type="date" />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label require" for="imagen">Imagen Principal:</label><br>
                  <small>(800px x 800px)</small>
                </div>
                <div class="col-4 col-lg-8">
                  <input class="form-control" id="imagen" name="imagen" type="text" required />
                  <div class="invalid-feedback"></div>
                </div>
                <div class="col-4 col-lg-2">
                  <button class="btn btn-bold btn-info" type="button" name="boton2" onClick="javascript:Imagen('IP');" /><i class="fa fa-save"></i> Examinar</button>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label require" for="h_imagen">Imagen (Hover):</label><br>
                  <small>(800px x 800px)</small>
                </div>
                <div class="col-4 col-lg-8">
                  <input class="form-control" id="h_imagen" name="h_imagen" type="text" required />
                  <div class="invalid-feedback"></div>
                </div>
                <div class="col-4 col-lg-2">
                  <button class="btn btn-bold btn-info" type="button" name="boton2" onClick="javascript:Imagen('IHP');" /><i class="fa fa-save"></i> Examinar</button>
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
              <a href="productos.php" class="btn btn-secondary"><i class="fa fa-times"></i> Cancelar</a>
              <button class="btn btn-bold btn-primary" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-chevron-circle-right"></i> Registrar Productos</button>
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