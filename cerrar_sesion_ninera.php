 <?php require_once('Connections/Conexionnany.php'); ?>
<?php
// ***  CIERRE DE SESION
$logoutGoTo = "index.html";
if (!isset($_SESSION)) {
  session_start();
}
// *** LIMPIAR VARIABLES
$_SESSION['MM_Username'] = NULL;
$_SESSION['MM_UserGroup'] = NULL;
$_SESSION['MM_id_numn'] = ""; 
unset($_SESSION['MM_Username']);
unset($_SESSION['MM_UserGroup']);
if ($logoutGoTo != "") {header("Location: $logoutGoTo");
exit;
}
?>

	