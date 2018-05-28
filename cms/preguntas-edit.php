<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php
$cod_pregunta = $_REQUEST['cod_pregunta'];
if (isset($_REQUEST['proceso'])) {
  $proceso  = $_POST['proceso'];
} else {
  $proceso  = "";
}
if($proceso == ""){
  $consultaPreguntas = "SELECT * FROM preguntas WHERE cod_pregunta='$cod_pregunta'";
  $ejecutarPreguntas = mysqli_query($enlaces,$consultaPreguntas) or die('Consulta fallida: ' . mysqli_error($enlaces));
  $filaPre = mysqli_fetch_array($ejecutarPreguntas);
  $cod_pregunta     = $filaPre['cod_pregunta'];
  $pregunta         = htmlspecialchars($filaPre['pregunta']);
  $respuesta        = htmlspecialchars($filaPre['respuesta']);
  $orden            = $filaPre['orden'];
  $estado           = $filaPre['estado'];
}

if($proceso=="Actualizar"){
  $cod_pregunta     = $_POST['cod_pregunta'];
  $pregunta         = mysqli_real_escape_string($enlaces, $_POST['pregunta']);
  $respuesta        = mysqli_real_escape_string($enlaces, $_POST['respuesta']);
  $orden            = $_POST['orden'];
  $estado           = $_POST['estado'];
  $actualizarPregunta = "UPDATE preguntas SET cod_pregunta='$cod_pregunta', pregunta='$pregunta', respuesta='$respuesta', orden='$orden', estado='$estado' WHERE cod_pregunta='$cod_pregunta'";
  $resultadoActualizar = mysqli_query($enlaces,$actualizarPregunta) or die('Consulta fallida: ' . mysqli_error($enlaces));
  
  header("Location:preguntas.php");
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include("module/head.php"); ?>
    <script type="text/javascript" src="assets/js/rutinas.js"></script>
    <script>
      function Validar(){
        if(document.fcms.pregunta.value==""){
          alert("Debe escribir una pregunta");
          document.fcms.pregunta.focus();
          return;
        }
        if(document.fcms.respuesta.value==""){
          alert("Debe escribir una respuesta");
          document.fcms.respuesta.focus();
          return; 
        }
        if(document.fcms.orden.value==""){
          alert("Debes especificar un número de orden");
          document.fcms.orden.focus();
          return; 
        }
        document.fcms.action = "preguntas-edit.php";
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
    <?php $menu="preguntas"; include("module/menu.php"); ?>
    <?php include("module/header.php"); ?>
    <!-- Main container -->
    <main>
      <header class="header bg-ui-general">
        <div class="header-info">
          <h1 class="header-title">
            <strong>Preguntas</strong>
            <small></small>
          </h1>
        </div>
      </header><!--/.header -->
      <div class="main-content">
        <div class="card">
          <h4 class="card-title"><strong>Editar Preguntas</strong></h4>
          <form class="fcms" name="fcms" method="post" action="" data-provide="validation" data-disable="false">
            
            <div class="card-body">
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label require" for="pregunta">Pregunta:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" id="pregunta" name="pregunta" value="<?php echo $pregunta; ?>" required>
                  <div class="invalid-feedback"></div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label require" for="respuesta">Respuesta:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <textarea class="form-control" id="respuesta" name="respuesta" data-toolbar="full" data-provide="summernote" data-min-height="150" required><?php echo $respuesta; ?></textarea>
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
                  <input type="checkbox" name="estado" data-size="small" data-provide="switchery" value="1" <?php if($estado="1"){echo "checked";} ?>>
                </div>
              </div>
            </div>

            <footer class="card-footer">
              <a href="preguntas.php" class="btn btn-secondary"><i class="fa fa-times"></i> Cancelar</a>
              <button class="btn btn-bold btn-primary" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-refresh"></i> Editar Pregunta</button>
              <input type="hidden" name="proceso">
              <input type="hidden" name="cod_pregunta" value="<?php echo $cod_pregunta; ?>">
            </footer>

          </form>
        </div>
      </div><!--/.main-content -->
      <?php include("module/footer_int.php"); ?>
    </main>
    <!-- END Main container -->
  </body>
</html>