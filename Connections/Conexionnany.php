<?php 
if (!isset($_SESSION)) {
  session_start();
}?>
<?php
$hostname_Conexionnany = "localhost";
$database_Conexionnany = "gonanny";
$username_Conexionnany = "root";
$password_Conexionnany = "utd";
$Conexionnany = mysql_pconnect($hostname_Conexionnany, $username_Conexionnany, $password_Conexionnany) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
<?php 
/*Archivo funciones.*/
if (is_file("includes/funciones.php")) {
	include ("includes/funciones.php");
}
else 
{
	include ("../includes/funciones.php");
}
?>