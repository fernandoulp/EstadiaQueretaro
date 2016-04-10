 <?php require_once('Connections/Conexionnany.php'); ?>
<?php
$logoutGoTo = "index.html";// ***  CIERRE DE SESION
if (!isset($_SESSION)) {
  session_start();
}
// *** LIMPIAR VARIABLES
$_SESSION['MM_Username'] = NULL;
$_SESSION['MM_UserGroup'] = NULL;
$_SESSION['MM_id_nump'] = ""; 
unset($_SESSION['MM_Username']);
unset($_SESSION['MM_UserGroup']);
if ($logoutGoTo != "") {header("Location: $logoutGoTo");
exit;
}
?>

	