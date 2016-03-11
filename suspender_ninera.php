
<?php require_once('Connections/Conexionnany.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
// INHABILITAR USUARIO DE LA BD QUE ES SELECCIONADO POR EL ADMINISTRADOR - PARÁMETRO ENVIADO
if ((isset($_GET['recordID'])) && ($_GET['recordID'] != "")) {
  $UpdateSQL = sprintf("UPDATE us_ninera SET status_n=0 WHERE id_numn=%s",
                       GetSQLValueString($_GET['recordID'], "int"));

  mysql_select_db($database_Conexionnany, $database_Conexionnany);
  $Result1 = mysql_query($UpdateSQL, $Conexionnany) or die(mysql_error());

  $updateGoTo = "lista_nineras_adm.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}
?>

