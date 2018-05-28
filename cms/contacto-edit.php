<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php
$cod_contact  = $_REQUEST['cod_contact'];
if (isset($_REQUEST['proceso'])){
  $proceso  = $_POST['proceso'];
} else {
  $proceso  = "";
}
if($proceso==""){
  $consultaContact = "SELECT * FROM contacto WHERE cod_contact='$cod_contact'";
  $ejecutarContact = mysqli_query($enlaces,$consultaContact) or die('Consulta fallida: ' . mysqli_error($enlaces));
  $filaCot = mysqli_fetch_array($ejecutarContact);
  $xCodigo    = $filaCot['cod_contact'];
  $xDirection = htmlspecialchars(utf8_encode($filaCot['direction']));
  $xPhone     = htmlspecialchars(utf8_encode($filaCot['phone']));
  $xEmail     = htmlspecialchars(utf8_encode($filaCot['email']));
  $xDayA      = htmlspecialchars(utf8_encode($filaCot['diaa']));
  $xHorarioA  = htmlspecialchars(utf8_encode($filaCot['horarioa']));
  $xDayB      = htmlspecialchars(utf8_encode($filaCot['diab']));
  $xHorarioB  = htmlspecialchars(utf8_encode($filaCot['horariob']));
  $xDayC      = htmlspecialchars(utf8_encode($filaCot['diac']));
  $xHorarioC  = htmlspecialchars(utf8_encode($filaCot['horarioc']));
  $xMap       = htmlspecialchars($filaCot['map']);
  $xMapS      = $filaCot['map'];
  $xFace      = htmlspecialchars($filaCot['face']);
  $xFaceS     = $filaCot['face'];
  $xFormem    = htmlspecialchars(utf8_encode($filaCot['form_mail']));
}

if($proceso == "Actualizar"){
  $cod_contact  = $_POST['cod_contact'];
  $direction    = mysqli_real_escape_string($enlaces, utf8_decode($_POST['direction']));
  $phone      = mysqli_real_escape_string($enlaces, utf8_decode($_POST['phone']));
  $email      = mysqli_real_escape_string($enlaces, utf8_decode($_POST['email']));
  $diaa       = mysqli_real_escape_string($enlaces, utf8_decode($_POST['diaa']));
  $horarioa   = mysqli_real_escape_string($enlaces, utf8_decode($_POST['horarioa']));
  $diab       = mysqli_real_escape_string($enlaces, utf8_decode($_POST['diab']));
  $horariob   = mysqli_real_escape_string($enlaces, utf8_decode($_POST['horariob']));
  $diac       = mysqli_real_escape_string($enlaces, utf8_decode($_POST['diac']));
  $horarioc   = mysqli_real_escape_string($enlaces, utf8_decode($_POST['horarioc']));
  $map        = mysqli_real_escape_string($enlaces, $_POST['map']);
  $face       = mysqli_real_escape_string($enlaces, $_POST['face']);
  $formem     = mysqli_real_escape_string($enlaces, utf8_decode($_POST['form_mail']));

  $ActualizarContact = "UPDATE contacto SET cod_contact='$cod_contact', direction='$direction', phone='$phone', email='$email', diaa='$diaa', horarioa='$horarioa', diab='$diab', horariob='$horariob', diac='$diac', horarioc='$horarioc', map='$map', face='$face', form_mail='$formem' WHERE cod_contact='$cod_contact'";
  $resultadoActualizar = mysqli_query($enlaces,$ActualizarContact);
  header("Location:contacto.php");
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include("module/head.php"); ?>
    <script type="text/javascript" src="assets/js/rutinas.js"></script>
    <script>
      function Validar(){
        if(document.fcms.form_mail.value==""){
          alert("¡El correo para los mensajes del formulario es obligatorio!");
          document.fcms.form_mail.focus();
          return; 
        }
        if (document.fcms.form_mail.value.indexOf('@') == -1){
          alert ("La \"dirección de email\" no es correcta");
          document.fcms.form_mail.focus();
          return;
        }
        document.fcms.action = "contacto-edit.php";
        document.fcms.proceso.value="Actualizar";
        document.fcms.submit();
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
        <div class="card">
          <h4 class="card-title"><strong>Editar Contacto</strong></h4>
          <form class="fcms" name="fcms" method="post" action="" data-provide="validation" data-disable="false">
            <div class="card-body">
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="direccion">Dirección:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <?php if($xVisitante=="1"){ ?><p><?php echo $xDirection; ?></p><?php } ?>
                  <input class="form-control" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" id="direccion" name="direction" value="<?php echo $xDirection; ?>" />
                </div>
              </div>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="email">Email:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <?php if($xVisitante=="1"){ ?><p><?php echo $xEmail; ?></p><?php } ?>
                  <input class="form-control" id="email" name="email" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" value="<?php echo $xEmail; ?>">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="phone">Central de pedidos:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <?php if($xVisitante=="1"){ ?><p><?php echo $xPhone; ?></p><?php } ?>
                  <input class="form-control" id="phone" name="phone" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" value="<?php echo $xPhone; ?>">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label">Horario:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <div class="row">
                    <div class="col-6 col-lg-12">
                      <?php if($xVisitante=="1"){ ?><p><?php echo $xDayA; ?></p><?php } ?>
                      <input class="form-control" id="diaa" name="diaa" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" value="<?php echo $xDayA; ?>" placeholder="Ejem: Lunes a Viernes">
                    </div>
                    <div class="col-6 col-lg-12">
                      <?php if($xVisitante=="1"){ ?><p><?php echo $xHorarioA; ?></p><?php } ?>
                      <input class="form-control" id="horarioa" name="horarioa" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" value="<?php echo $xHorarioA; ?>" placeholder="Ejem: 9:00 - 22:00">
                    </div>
                  </div>
                  <div class="separador-10"></div>
                  <div class="row">
                    <div class="col-6 col-lg-12">
                      <?php if($xVisitante=="1"){ ?><p><?php echo $xDayB; ?></p><?php } ?>
                      <input class="form-control" id="diab" name="diab" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" value="<?php echo $xDayB; ?>" placeholder="Ejem: Sábado">
                    </div>
                    <div class="col-6 col-lg-12">
                      <?php if($xVisitante=="1"){ ?><p><?php echo $xHorarioB; ?></p><?php } ?>
                      <input class="form-control" id="horariob" name="horariob" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" value="<?php echo $xHorarioB; ?>" placeholder="Ejem: 10:00 - 24:00">
                    </div>
                  </div>
                  <div class="separador-10"></div>
                  <div class="row">
                    <div class="col-6 col-lg-12">
                      <?php if($xVisitante=="1"){ ?><p><?php echo $xDayC; ?></p><?php } ?>
                      <input class="form-control" id="diac" name="diac" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" value="<?php echo $xDayC; ?>" placeholder="Ejem: Domingo">
                    </div>
                    <div class="col-6 col-lg-12">
                      <?php if($xVisitante=="1"){ ?><p><?php echo $xHorarioC; ?></p><?php } ?>
                      <input class="form-control" id="horarioc" name="horarioc" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" value="<?php echo $xHorarioC; ?>" placeholder="Ejem: 12:00 - 24:00">
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="map">Mapa de Contacto:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <?php if($xVisitante=="1"){ ?><p><?php echo $xMap; ?></p><?php } ?>
                  <input class="form-control" id="map" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" name="map" value="<?php echo $xMap; ?>" />
                  <div class="separador-10"></div>
                  <?php if($xMap!=""){ ?>
                  <?php echo $xMapS; ?>
                  <?php }else{ ?>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="face">Page Plugin (Facebook):</label>
                </div>
                <div class="col-8 col-lg-10">
                  <?php if($xVisitante=="1"){ ?><p><?php echo $xFace; ?></p><?php } ?>
                  <textarea class="form-control" id="face" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" name="face"><?php echo $xFace; ?></textarea>
                  <div class="separador-10"></div>
                  <?php if($xFace!=""){ ?>
                  <?php echo $xFaceS; ?>
                  <?php }else{ ?>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label require" for="form_mail">Correo que recibe los mensajes del Formulario:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <?php if($xVisitante=="1"){ ?><p><?php echo $xFormem; ?></p><?php } ?>
                  <input class="form-control" id="form_mail" type="<?php if($xVisitante=="1"){ ?>hidden<?php }else{ ?>text<?php } ?>" name="form_mail" value="<?php echo $xFormem; ?>" />
                </div>
              </div>
            </div>
            <footer class="card-footer">
              <a href="metatags.php" class="btn btn-secondary"><i class="fa fa-times"></i> Cancelar</a>
              <button class="btn btn-bold btn-primary" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-refresh"></i> Editar Contacto</button>
              <input type="hidden" name="proceso">
              <input type="hidden" name="cod_contact" value="<?php echo $xCodigo; ?>">
            </footer>
          </form>
        </div>
      </div><!--/.main-content -->
      <?php include("module/footer_int.php"); ?>
    </main>
    <!-- END Main container -->
  </body>
</html>
