<?php include("cms/module/conexion.php"); ?>
<?php include("modules/session-core.php"); ?>
<?php 
?>
<!DOCTYPE html>
<!--[if IE 8]> <html class="ie8"> <![endif]-->
<!--[if IE 9]> <html class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html> <!--<![endif]-->
  <head>
    <?php include("includes/head.php"); ?>
    <style id="custom-style">
    </style>
    <script>
      function ValidarIngreso(){
        if(document.flogin.email.value==""){
          alert("Debes ingresar tu email");
          document.flogin.email.focus();
          return;
        }
        if(document.flogin.clave.value==""){
          alert("Debes ingresar tu clave");
          document.flogin.clave.focus();
          return;
        }
        document.flogin.proceso.value="iniciar";
        document.flogin.action="/validar.php";
        document.flogin.submit();
      }
    </script>
  </head>
    <body>
    <div id="wrapper">
        <?php include("includes/header.php"); ?>
        <section id="content">
        	<div id="breadcrumb-container">
        		<div class="container">
    					<ul class="breadcrumb">
    						<li><a href="/index.php">Inicio</a></li>
    						<li class="active">Delete</li>
    					</ul>
        		</div>
        	</div>
        	<div class="container">
        		<div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <h2>&iquest;Eliminar cuenta?</h2>
                <p></p>
                <div class="md-margin"></div><!-- space -->
                <a href="/registrarse.php" class="btn btn-custom-2">Crear una Cuenta</a>
                <div class="lg-margin"></div><!-- space -->
              </div><!-- End .col-md-6 -->
              <div class="col-md-6 col-sm-6 col-xs-12">
                <h2>Login de usuario</h2>
                <p>Si tiene una cuenta con nosotros, por favor ingrese.</p>
                <div class="xs-margin"></div>
                <form id="flogin" name="flogin" method="post" action="">
                  <div class="input-group">
                    <span class="input-group-addon"><span class="input-icon input-icon-email"></span><span class="input-text">Email</span></span>
                    <input type="text" class="form-control input-lg" name="email" id="email" placeholder="Su Email" required />
                  </div><!-- End .input-group -->
                  <div class="input-group xs-margin">
                    <span class="input-group-addon"><span class="input-icon input-icon-password"></span><span class="input-text">Clave</span></span>
                    <input type="password" name="clave" id="clave" class="form-control input-lg" placeholder="Su Clave" required />
                  </div><!-- End .input-group 
                  <span class="help-block text-right"><a href="#">Forgot your password?</a></span> -->
                  <input type="hidden" name="proceso" id="proceso" />
                  <input type="button" class="btn btn-custom-2" name="boton1" value="Ingresar" onClick="javascript:ValidarIngreso();" />
                </form>
                <div class="sm-margin"></div><!-- space -->
              </div><!-- End .col-md-6 -->      
            </div><!-- End.row -->
          </div><!-- End .container -->
        
        </section><!-- End #content -->
        
      <?php include("includes/footer.php"); ?>
    </div><!-- End #wrapper -->
  </body>
</html>