<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php
$mensaje = "";
if (isset($_REQUEST['proceso'])) {
  $proceso  = $_POST['proceso'];
} else {
  $proceso  = "";
}
if($proceso == "Registrar"){
  $type       = $_POST['type'];
  $links      = mysqli_real_escape_string($enlaces, $_POST['links']);
  if($type=="fa-facebook"){
    $valor = "icon-facebook";
  }
  if($type=="fa-twitter"){
    $valor = "icon-twitter";
  }
  if($type=="fa-rss"){
    $valor = "icon-rss";
  }
  if($type=="fa-delicious"){
    $valor = "icon-delicious";
  }
  if($type=="fa-linkedin"){
    $valor = "icon-linkedin";
  }
  if($type=="fa-flickr"){
    $valor = "icon-flickr";
  }
  if($type=="fa-skype"){
    $valor = "icon-skype";
  }
  if($type=="fa-youtube"){
    $valor = "icon-email";
  }
  if(isset($_POST['orden'])){$orden = $_POST['orden'];}else{$orden = 0;}
  if(isset($_POST['estado'])){$estado = $_POST['estado'];}else{$estado = 0;}
  $insertarBanner = "INSERT INTO social (type, links, valor, orden, estado)VALUE('$type', '$links', '$valor', '$orden', '$estado')";
  $resultadoInsertar = mysqli_query($enlaces,$insertarBanner);
  $mensaje = "<div class='alert alert-success' role='alert'>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
          <strong>Nota:</strong> El enlace se registr&oacute; con exitosamente. <a href='sociales.php'>Ir a Redes Sociales</a>
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
        if(document.fcms.links.value==""){
          alert("Debe colocar el enlace de su cuenta");
          document.fcms.links.focus();
          return; 
        }
        document.fcms.action = "social-nuevo.php";
        document.fcms.proceso.value="Registrar";
        document.fcms.submit();
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
    <?php $menu="social"; include("module/menu.php"); ?>
    <?php include("module/header.php"); ?>
    <!-- Main container -->
    <main>
      <header class="header bg-ui-general">
        <div class="header-info">
          <h1 class="header-title">
            <strong>Redes Sociales</strong>
            <small></small>
          </h1>
        </div>
      </header><!--/.header -->
      <div class="main-content">
        <div class="card">
          <h4 class="card-title"><strong>Registrar red social</strong></h4>
          <form class="fcms" name="fcms" method="post" action="" data-provide="validation" data-disable="false">
            <div class="card-body">
              <?php if(isset($mensaje)){ echo $mensaje; } else {}; ?>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label require" for="social">Bot&oacute;n de Red Social:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <select name="type" id="type" class="form-control">
                    <option value="fa-facebook">Facebook</option>
                    <option value="fa-twitter">Twitter</option>
                    <option value="fa-rss">RSS</option>
                    <option value="fa-delicious">Delicious</option>
                    <option value="fa-linkedin">Linkedin</option>
                    <option value="fa-flickr">Flickr</option>
                    <option value="fa-skype">Skype</option>
                    <option value="fa-youtube">Youtube</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="links">Enlace:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" name="links" type="text" id="links" />
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
              <a href="carrusel.php" class="btn btn-secondary"><i class="fa fa-times"></i> Cancelar</a>
              <button class="btn btn-bold btn-primary" type="button" name="boton" onClick="javascript:Validar();"><i class="fa fa-chevron-circle-right"></i> Registrar red social</button>
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