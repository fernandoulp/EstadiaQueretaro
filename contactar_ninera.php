<?php require_once('Connections/Conexionnany.php'); ?>
<?php
// *** RESTRINGIR ACCESO A PÁGINA SI EL USUARIO EN SESIÓN NO ES PADRE
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "premium";
$MM_donotCheckaccess = "false";

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
$MM_restrictGoTo = "login_familias.php";
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
date_default_timezone_set('Mexico/General');
$fecha = date("d-F-Y");

$varUsuario_consulta_datosUsuario = 0;
if (isset($_GET['recordID'])) {
  $varUsuario_consulta_datosUsuario = $_GET['recordID'];
}
//CONSULTA SQL PARA DATOS DE USUARIO
mysql_select_db($database_Conexionnany, $Conexionnany);
$query_consulta_datosUsuario = sprintf("SELECT * FROM us_ninera  WHERE us_ninera.id_numn = %s", GetSQLValueString($varUsuario_consulta_datosUsuario, "int"));
$consulta_datosUsuario = mysql_query($query_consulta_datosUsuario, $Conexionnany) or die(mysql_error());
$row_consulta_datosUsuario = mysql_fetch_assoc($consulta_datosUsuario);
$totalRows_consulta_datosUsuario = mysql_num_rows($consulta_datosUsuario);


// SENTENCIA SQL PARA MOSTRAR LOS DATOS DEL USUARIO EN SESION
$varUS_consulta_datos_padres = "0";
if (isset($_SESSION['MM_id_nump'])) {
  $varUS_consulta_datos_padres = $_SESSION['MM_id_nump'];
}
mysql_select_db($database_Conexionnany, $Conexionnany);
// CONSULTA SQL PARA TABLA USUARIOS
$query_consulta_datos_padres = sprintf("SELECT * FROM us_padres WHERE us_padres.id_nump = %s", GetSQLValueString($varUS_consulta_datos_padres, "int"));
$consulta_datos_padres = mysql_query($query_consulta_datos_padres, $Conexionnany) or die(mysql_error());
$row_consulta_datos_padres = mysql_fetch_assoc($consulta_datos_padres);
$totalRows_consulta_datos_padres = mysql_num_rows($consulta_datos_padres);


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO mensajes (id_padre, id_ninera, mensaje_de, mensaje_para, mensaje_txt, status_mensaje, fecha_mensaje) VALUES (%s, %s, %s, %s, %s, 'Enviado','$fecha')",
                       GetSQLValueString($_POST['id_padre'], "text"),
                       GetSQLValueString($_POST['id_ninera'], "text"),
                       GetSQLValueString($_POST['mensaje_de'], "text"),
                       GetSQLValueString($_POST['mensaje_para'], "text"),
                       GetSQLValueString($_POST['mensaje_txt'], "text"));

  mysql_select_db($database_Conexionnany, $Conexionnany);
  $Result1 = mysql_query($insertSQL, $Conexionnany) or die(mysql_error());

  $insertGoTo = "mensaje_enviado.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
     
?>


<!DOCTYPE HTML>

<html>
	<head>
		<title>Solicitud</title>
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
	<i class="fa fa-user fa-2x"></i> 
	</i> <?php echo $row_consulta_datos_padres['name_p']; ?> 
	<?php echo $row_consulta_datos_padres['last_namep']; ?> </br>
	<a href="cerrar_sesion_padres.php">Cerrar sesion</a>
	</div>
						
						<!-- Nav -->
							<nav id="nav">
								<ul>
								<li><a href="index_familia.php"><i class="fa fa-home fa-2x"></i><span> INICIO</span></a></li>
                  <li><a href="mis_datos_padres.php?recordID=<?php echo $_SESSION['MM_id_nump']; ?>"><i class="fa fa-users fa-2x"></i> </i><span> MI PERFIL</span></a></li>
                  <li><a href="ver_nineras_premium.php"><i class="fa fa-female fa-2x"></i> <span> NIÑERAS</span></a></li>
								</ul>
							</nav>

   <h3>Enviar mensaje a <?php echo $row_consulta_datosUsuario['name_n']; ?> <?php echo $row_consulta_datosUsuario['last_namen']; ?> </h3>
               <form action="<?php echo $editFormAction; ?>"  method="post" name="form1" id="form1">
                <div align="center">
                    <p>Deja tu mensaje:</p>
                    
                    <textarea style="width:700px;height:200px" name="mensaje_txt" maxlength="255" placeholder="Hola <?php echo $row_consulta_datosUsuario['name_n']; ?> me gustaría poder comunicarnos" required></textarea>
		                

                                                  <!--CAMPOS OCULTOS  -->
                     <input type="hidden" name="mensaje_de" style="width:240px;height:20px" value="<?php echo $row_consulta_datos_padres['name_p']; ?> <?php echo $row_consulta_datos_padres['last_namep']; ?>">             
                     <input type="hidden" name="mensaje_para" style="width:240px;height:20px" value="<?php echo $row_consulta_datosUsuario['name_n']; ?> <?php echo $row_consulta_datosUsuario['last_namen']; ?>">
                   
                     <input type="hidden" name="id_padre" style="width:240px;height:20px" value="<?php echo $row_consulta_datos_padres['id_nump']; ?>">
                     <input type="hidden" name="id_ninera" style="width:240px;height:20px" value="<?php echo $row_consulta_datosUsuario['id_numn']; ?>">
                     </br>
                     <input type="submit" id="enviar_mensaje" style="width:240px;height:50px" value="Enviar mensaje" />
                     <input type="hidden" name="MM_insert" value="form1" />
          </div>
      </form> 
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
mysql_free_result($consulta_datosUsuario);
?>
</html>