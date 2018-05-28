        <?php
            $consultarMet = 'SELECT * FROM metatags';
            $resultadoMet = mysqli_query($enlaces,$consultarMet) or die('Consulta fallida: ' . mysqli_error($enlaces));
            $filaMet = mysqli_fetch_array($resultadoMet);
                $xCodigo  = $filaMet['cod_meta'];
                $xTitulo  = utf8_encode($filaMet['titulo']);
                $xSlogan  = utf8_encode($filaMet['slogan']);
                $xDes     = utf8_encode($filaMet['description']);
                $xKey     = $filaMet['keywords'];
                $xUrl     = $filaMet['url'];
                $xFace1   = $filaMet['face1'];
                $xFace2   = $filaMet['face2'];
                $xIco     = $filaMet['ico'];
        ?>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $xTitulo; ?> <?php if($xSlogan!=""){ echo "| ".$xSlogan; } ?></title>
        <!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <![endif]-->
        <meta name="description" content="<?php echo $xDes; ?>" />
        <meta name="keywords" content="<?php echo $xKey; ?>" />
        <meta name="DC.title" content="<?php echo $xTitulo; ?>" />
        <meta name="DC.description" lang="es" content="<?php echo $xDes; ?>" />
        <meta name="geo.region" content="PE-LIM" />
        <meta name="robots" content="INDEX,FOLLOW" />
        <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />

        <meta property="og:title" content="<?php echo $xTitulo; ?>" />
        <meta property="og:type" content="shop.gift" />
        <meta property="og:description" content="<?php echo $xDes; ?>" />
        <meta property="og:url" content="<?php echo $xUrl; ?>" />
        <meta property="og:image" content="<?php echo $xUrl; ?>/cms/assets/img/meta/<?php echo $xFace1; ?>" />
        <meta property="og:image" content="<?php echo $xUrl; ?>/cms/assets/img/meta/<?php echo $xFace2; ?>" />
        <link rel="shortcut icon" href="cms/assets/img/meta/<?php echo $xIco; ?>" type="image/x-icon" />
        <?php
            mysqli_free_result($resultadoMet);
        ?>
        <link href='//fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic%7CPT+Gudea:400,700,400italic%7CPT+Oswald:400,700,300' rel='stylesheet' id="googlefont">
        
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/prettyPhoto.css">
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link rel="stylesheet" href="css/revslider.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/responsive.css">

        <link rel="stylesheet" href="css/custom.css">
        
        <!-- Favicon and Apple Icons -->
        <link rel="icon" type="image/png" href="images/icons/icon.png">
        <link rel="apple-touch-icon" sizes="57x57" href="images/icons/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="72x72" href="images/icons/apple-icon-72x72.png">
        
        <!--- jQuery -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/jquery-1.11.1.min.js"><\/script>')</script>

        <!--- Modernizr -->
        <script src="js/modernizr.custom.js"></script>

        <!--[if lt IE 9]>
            <script src="js/html5shiv.js"></script>
            <script src="js/respond.min.js"></script>
        <![endif]-->