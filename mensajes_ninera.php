
<?php require_once('Connections/Conexionnany.php'); ?>
<?php


//RESTRICCION DE ACCESO A USUARIO NO LOGEADO
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "premium";
$MM_donotCheckaccess = "false";

// *** RESTRINGIR ACCESO A PÁGINA SI EL USUARIO EN SESIÓN NO ESTA LOGEADO
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // VALOR FALSO EN VARIABLE SI EL USUARIO NO ES ADMITIDO
  $isValid = False; 
	// CUANDO UN VISITANTE INICIA SESION, LA VARIABLE SESSION: MM_USERNAME TOMA EL VALOR DEL USERNAME
  
  // DE OTRA FORMA, CUANDO EL USUARIO NO ES ADMITIDO LA VARIABLE ESTARÁ EN BLANCO
  if (!empty($UserName)) { 

    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}
$MM_restrictGoTo = "login_nineras.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}

//STRINGS FUNCIONES
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

$varUsuario_consulta_datosUsuario = 0;
if (isset($_GET['recordID'])) {
  $varUsuario_consulta_datosUsuario = $_GET['recordID'];
}
//CONSULTA SQL LOS MENSAJES DEL USUARIO
mysql_select_db($database_Conexionnany, $Conexionnany);
$query_consulta_mensajes = sprintf("SELECT * FROM mensajes WHERE mensajes.id_ninera = %s", GetSQLValueString($varUsuario_consulta_datosUsuario, "int"));
$consulta_mensajes = mysql_query($query_consulta_mensajes, $Conexionnany) or die(mysql_error());
$row_consulta_mensajes = mysql_fetch_assoc($consulta_mensajes);
$totalRows_consulta_mensajes = mysql_num_rows($consulta_mensajes);


// SENTENCIA SQL PARA MOSTRAR LOS DATOS DEL USUARIO EN SESION
$varUS_consulta_datos_ninera = "0";
if (isset($_SESSION['MM_id_numn'])) {
  $varUS_consulta_datos_ninera = $_SESSION['MM_id_numn'];
}
mysql_select_db($database_Conexionnany, $Conexionnany);
// CONSULTA SQL PARA TABLA USUARIOS
$query_consulta_datos_ninera = sprintf("SELECT * FROM us_ninera WHERE us_ninera.id_numn = %s", GetSQLValueString($varUS_consulta_datos_ninera, "int"));
$consulta_datos_ninera = mysql_query($query_consulta_datos_ninera, $Conexionnany) or die(mysql_error());
$row_consulta_datos_ninera = mysql_fetch_assoc($consulta_datos_ninera);
$totalRows_consulta_datos_ninera = mysql_num_rows($consulta_datos_ninera);




?>



<!DOCTYPE HTML>
<!--
	Strongly Typed by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Mensajes</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	</head>
	<body class="homepage">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header-wrapper">

					<div id="header" class="container">

		<div class="datos">
	<i class="fa fa-female fa-2x"></i> 
	</i> <?php echo $row_consulta_datos_ninera['name_n']; ?> 
	<?php echo $row_consulta_datos_ninera['last_namen']; ?> </br>
	<a href="cerrar_sesion_ninera.php">Cerrar sesion</a>
	</div>

						
						<!-- Nav -->
							<nav id="nav">
								<ul>
								<li><a href="index_nineras.php"><i class="fa fa-home fa-2x"></i><span> INICIO</span></a></li>
                  <li><a href="mis_datos_ninera.php?recordID=<?php echo $_SESSION['MM_id_numn']; ?>"><i class="fa fa-users fa-2x"></i> </i><span> MI PERFIL</span></a></li>
                  <li><a href="mensajes_ninera.php?recordID=<?php echo $_SESSION['MM_id_numn']; ?>"><i class="fa fa-envelope fa-2x"></i> <span>MENSAJES (<?php echo $totalRows_consulta_mensajes?>)</span></a></li>
								</ul>
								
							</nav>




 <div class="datosninera">
            
               <?php if ($totalRows_consulta_mensajes > 0) { // Show if recordset not empty ?>
               <?php do { ?>
              <div class="bordeninera">

                  <section>
                        <p>Tienes un nuevo mensaje de <?php echo $row_consulta_mensajes['mensaje_de']; ?></p>  
                        </br>
                         <a href="ver_mensaje.php?recordID=<?php echo $row_consulta_mensajes['id_mensaje']; ?>"><input id="submit" type="submit" name="submit" value="Ver" style="width:200px;height:45px"/></a>                
                  </section>

               </div>
       
                   
                <?php } while ($row_consulta_mensajes = mysql_fetch_assoc ($consulta_mensajes));?>
                <?php } // Show if recordset not empty ?>
             
                  <?php if ($totalRows_consulta_mensajes == 0) { // Show if recordset empty ?>
                   <p>No tienes mensajes nuevos</p> 
                  <?php } // Show if recordset empty ?> 
              </div>

 <a href="lista_mensajes.php?recordID=<?php echo $_SESSION['MM_id_numn']; ?>"><p>Ver todos los mensajes</p></a>

					</div>
				</div>

		

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/skel-viewport.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
	<?php
mysql_free_result($consulta_mensajes);
?>
</html>