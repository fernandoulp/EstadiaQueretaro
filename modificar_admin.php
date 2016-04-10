<?php require_once('Connections/Conexionnany.php'); ?>

<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "premium";
$MM_donotCheckaccess = "false";

// *** RESTRINGIR ACCESO A PÁGINA SI EL USUARIO EN SESIÓN NO ES ADMINISTRADOR
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 

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
// PAGINA A LA QUE SE REDICCIONARÁ SI NO SE AUTORIZA EL ACCESO 
$MM_restrictGoTo = "login_nanny.php";
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
?>
<?php  // FUNCION PARA VALIDAR QUE EL VALOR SEA STRING
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
?>
<?php
// SE DECLARA UNA VARIABLE CON EL VALOR DEL ID DEL USUARIO EN SESIÓN (CONSULTA SQL)
$varID_consultaMisdatos = "0";
if (isset($_SESSION['MM_id_user'])) {
  $varID_consultaMisdatos = $_SESSION['MM_id_user'];
}
mysql_select_db($database_Conexionnany, $Conexionnany);
$query_consultaMisdatos = sprintf("SELECT * FROM administradores WHERE administradores.id_user = %s", GetSQLValueString($varID_consultaMisdatos, "bigint"));
$consultaMisdatos = mysql_query($query_consultaMisdatos, $Conexionnany) or die(mysql_error());
$row_consultaMisdatos = mysql_fetch_assoc($consultaMisdatos);
$totalRows_consultaMisdatos = mysql_num_rows($consultaMisdatos);
?>
<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
?>

<?php //FORMULARIO CON LOS DATOS CORREGIDOS , SENTENCIA UPDATE PARA ACTUALIZAR LA INFORMACION DEL REGISTRO
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE administradores SET name_adm=%s, ape1_adm=%s, ape2_adm=%s, email_adm=%s, cel_adm=%s, password=%s, status_us=%s WHERE id_user=%s",
  // VALORES DEL FORMULARIO ENVIADOS POR EL METODO POST
                       GetSQLValueString($_POST['name_adm'], "text"),
                       GetSQLValueString($_POST['ape1_adm'], "text"),
                       GetSQLValueString($_POST['ape2_adm'], "text"),
                       GetSQLValueString($_POST['email_adm'], "text"),
                       GetSQLValueString($_POST['cel_adm'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['status_us'], "int"),
                       GetSQLValueString($_POST['id_user'], "bigint"));

  mysql_select_db($database_Conexionnany, $Conexionnany);
  $Result1 = mysql_query($updateSQL, $Conexionnany) or die(mysql_error());
// REDICCIONAMIENTO AL INSERTAR
  $updateGoTo = "lista_admin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}
?>
<!--FIN DE LAS CONSULTAS-->


<!DOCTYPE HTML>

<html>
	<head>
		<title>Responder - Gonanny</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<head class="homepage">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header-wrapper">
					<div id="header" class="container">

				<!--PHP PARA RECONOCER USUARIO-->
					<p>
							
							<h1 id="logo">Actualización de datos</h1>
						
					</p>
				<!--FIN PHP-->


<br> 
<div align="left"><a href="lista_admin.php"><strong>Regresar<strong></a></div>
			<!--FORMULARIO RESPUESTA DE COMENTARIOS-->
							<br>
								<div>
								<section class="formulario" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" onsubmit="return valida()">
								<form >
									<table align="center">
										<tr valign="baseline">
									 <td>Nombre:</td>
									 <td><input style="width:240px;height:50px" name="name_adm" value="<?php echo htmlentities($row_consultaMisdatos['name_adm'], ENT_COMPAT, ''); ?>" size="32" maxlength="60"   required/></td> 
									 	</tr>

									 	<tr valign="baseline">
									 <td>Apellido Paterno:</td>
									 <td><input style="width:240px;height:50px" name="ape1_adm" value="<?php echo htmlentities($row_consultaMisdatos['ape1_adm'], ENT_COMPAT, ''); ?>" size="32" maxlength="60"   required/></td>
									 	</tr>

									 	<tr valign="baseline">
									 <td>Apellido Materno:</td>
									 <td><input style="width:240px;height:50px" name="ape2_adm" value="<?php echo htmlentities($row_consultaMisdatos['ape2_adm'], ENT_COMPAT, ''); ?>" size="32" maxlength="60"   required/></td>
									 	</tr>

									 	<tr valign="baseline">
									 <td>Email:</td>
									 <td><input style="width:240px;height:50px" name="email_adm" value="<?php echo htmlentities($row_consultaMisdatos['email_adm'], ENT_COMPAT, ''); ?>" size="32" maxlength="60"   required/></td>
									 	</tr>

									 	<tr valign="baseline">
									 <td>Teléfono Celular:</td>
									 <td><input style="width:240px;height:50px" name="ape1_adm" value="<?php echo htmlentities($row_consultaMisdatos['cel_adm'], ENT_COMPAT, ''); ?>" size="32" maxlength="60"   required/></td>
									 	</tr>

									 	<tr valign="baseline">
									 <td>Email:</td>
									 <td><input style="width:240px;height:50px" name="password" value="<?php echo htmlentities($row_consultaMisdatos['password'], ENT_COMPAT, ''); ?>" size="32" maxlength="60"   required/></td>
									 	</tr>

  									</table>

  									<table>
  										<tr valign="baseline">
									 		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                  					 <td><input id="submit" type="submit" name="submit" value="Actualizar" style="width:200px;height:40px"/></td>
                   					    </tr>

  									</table>
                                </form>
							    </section>
							</div>


						<!-- Nav -->
							<nav id="nav">
								<ul>
									<li><a href="index.html"><i class="fa fa-home fa-2x"></i><span> INICIO</span></a></li>
									<li>
										<a href="#"><i class="fa fa-users fa-2x"></i><span> FAMILIA</span></a>
										<ul>
											<li><a href="#">Inicia sesión</a></li>
											<li><a href="#">Registrate</a></li>
										</ul>
									</li>
									<li><a href="left-sidebar.html"><i class="fa fa-female fa-2x"></i><span> NIÑERA</span></a>
									<ul>
											<li><a href="#">Inicia sesión</a></li>
											<li><a href="#">Registrate</a></li>
										</ul>
									</li>
									<li><a href="right-sidebar.html"><i class="fa fa-info-circle fa-2x"></i> </i><span> ACERCA DE</span></a></li>
									<li><a href="requisitos.html"><i class="fa fa-file-text-o fa-2x"></i><span>  RECOMENDACIONES</span></a></li>
								</ul>
							</nav>

					</div>
				</div>
			</head>
			<!-- Features -->
			
			<div id="copyright" class="container">
            <ul class="links">
              <li>GoNanny Todos los derechos reservados &copy; Copyright 2016</li><li><a href="login_nanny.php">Administración</a></li>
            </ul>
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
</html>

<?php
mysql_free_result($consultaMisdatos);
?>