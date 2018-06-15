<?php
$result = mysqli_query($enlaces,"SELECT logo FROM metatags") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "assets/img/meta/".$row['logo'];
}

$result = mysqli_query($enlaces,"SELECT face1 FROM metatags") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "assets/img/meta/".$row['face1'];
}

$result = mysqli_query($enlaces,"SELECT face2 FROM metatags") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "assets/img/meta/".$row['face2'];
}

$result = mysqli_query($enlaces,"SELECT ico FROM metatags") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "assets/img/meta/".$row['ico'];
}

$directory = "assets/img/meta/";
$Meta = glob($directory."*");
foreach($Meta as $filename) {
    if (!in_array($filename, $do_not_delete)){
		if (strpos($filename,".")){
			unlink($filename);
		}
	}
}

$result = mysqli_query($enlaces,"SELECT imagen FROM banners") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "assets/img/banner/".$row['imagen'];
}

$directory = "assets/img/banner/";
$Banners = glob($directory."*");
foreach($Banners as $filename) {
    if (!in_array($filename, $do_not_delete)){
		if (strpos($filename,".")){
			unlink($filename);
		}
	}
}

$result = mysqli_query($enlaces,"SELECT imagen FROM carrusel") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "assets/img/carrusel/".$row['imagen'];
}

$directory = "assets/img/carrusel/";
$Carrusel = glob($directory."*");
foreach($Carrusel as $filename) {
    if (!in_array($filename, $do_not_delete)){
		if (strpos($filename,".")){
			unlink($filename);
		}
	}
}

$result = mysqli_query($enlaces,"SELECT img_contenido FROM contenidos") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "assets/img/nosotros/".$row['img_contenido'];
}

$directory = "assets/img/nosotros/";
$Nosotros = glob($directory."*");
foreach($Nosotros as $filename) {
    if (!in_array($filename, $do_not_delete)){
		if (strpos($filename,".")){
			unlink($filename);
		}
	}
}

$result = mysqli_query($enlaces,"SELECT imagen FROM noticias") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "assets/img/noticias/".$row['imagen'];
}

$directory = "assets/img/noticias/";
$Noticias = glob($directory."*");
foreach($Noticias as $filename) {
    if (!in_array($filename, $do_not_delete)){
		if (strpos($filename,".")){
			unlink($filename);
		}
	}
}

$result = mysqli_query($enlaces,"SELECT imagen FROM ofertas") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "assets/img/ofertas/".$row['imagen'];
}

$directory = "assets/img/ofertas/";
$Ofertas = glob($directory."*");
foreach($Ofertas as $filename) {
    if (!in_array($filename, $do_not_delete)){
		if (strpos($filename,".")){
			unlink($filename);
		}
	}
}

$result = mysqli_query($enlaces,"SELECT imagen FROM productos") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "assets/img/productos/".$row['imagen'];
}

$directory = "assets/img/productos/";
$Productos = glob($directory."*");
foreach($Productos as $filename) {
    if (!in_array($filename, $do_not_delete)){
		if (strpos($filename,".")){
			unlink($filename);
		}
	}
}

$result = mysqli_query($enlaces,"SELECT h_imagen FROM productos") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "assets/img/productos/hover/".$row['h_imagen'];
}

$directory = "assets/img/productos/hover/";
$ProductosCategorias = glob($directory."*");
foreach($ProductosCategorias as $filename) {
    if (!in_array($filename, $do_not_delete)){
		if (strpos($filename,".")){
			unlink($filename);
		}
	}
}

$result = mysqli_query($enlaces,"SELECT imagen FROM usuarios") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "assets/img/avatar/".$row['imagen'];
}

$directory = "assets/img/avatar/";
$Usuarios = glob($directory."*");
foreach($Usuarios as $filename) {
    if (!in_array($filename, $do_not_delete)){
		if (strpos($filename,".")){
			unlink($filename);
		}
	}
}

?>