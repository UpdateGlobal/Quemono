<?php
session_start();
if (isset($_SESSION['xAlias_c'])) {
	$xAlias		= $_SESSION['xAlias_c'];
}else{
	$xAlias		= "";
}
if (isset($_SESSION['xEmail_c'])) {
	$xEmail		= $_SESSION['xEmail_c'];
}else{
	$xEmail 	= "";
}

?>