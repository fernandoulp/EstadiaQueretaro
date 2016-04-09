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

// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="alta_emailrepetido.php";
  $loginUsername = $_POST['email_adm'];
  $LoginRS__query = sprintf("SELECT email_adm FROM administradores WHERE email_adm=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_Conexionnany, $Conexionnany);
  $LoginRS=mysql_query($LoginRS__query, $Conexionnany) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO administradores (name_adm, ape1_adm, ape2_adm, email_adm, cel_adm, password) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name_adm'], "text"),
                       GetSQLValueString($_POST['ape1_adm'], "text"),
                       GetSQLValueString($_POST['ape2_adm'], "text"),
                       GetSQLValueString($_POST['email_adm'], "text"),
                       GetSQLValueString($_POST['cel_adm'], "text"),
                       GetSQLValueString($_POST['password'], "text"));

  mysql_select_db($database_Conexionnany, $Conexionnany);
  $Result1 = mysql_query($insertSQL, $Conexionnany) or die(mysql_error());

  $insertGoTo = "inicio_admin.php";
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
		<title>Registro - Familia</title>
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
<img src="images/add_adm.jpg" alt="" width="125" height="125"/>
				<!--PHP PARA RECONOCER USUARIO-->
					<p>
							
							<h1 id="logo">Agregar admin</h1>
						
					</p>
					<div align="left"><a href="inicio_admin.php"><strong>Menú<strong></a></div> 
				<!--FIN PHP-->

<div align="right">Campos obligatorios '*'</div>
<br> 


			<!--FORMULARIO REGISTRO DE NIÑERAS-->
							<div>
								<section class="formulario">
								<form action="<?php echo $editFormAction; ?>"  method="post" name="form1" id="form1">
									<table align="center">
										<tr valign="baseline">
									 <td>Nombre:</td>
									 <td><input  name="name_adm" required/></td>
									 <td><font size="5">*</font></td>
									 	</tr>

									 	<tr valign="baseline">
									 <td>Apellido Paterno:</td>
									 <td><input name="ape1_adm" required/></td>
									 <td><font size="5">*</font></td>
									 	</tr>

									 	<tr valign="baseline">
									 <td>Apellido Materno:</td>
									 <td><input name="ape2_adm"  required/></td>
									 <td><font size="5">*</font></td>
									 	</tr>

									<tr valign="baseline">
									 <td>Celular:</td>
									 <td><input name="cel_adm" required/></td>
									 	</tr>

									 	<tr valign="baseline">
									 <td>Email:</td>
									 <td><input name="email_adm" required/></td>
									 <td><font size="5">*</font></td>
									 	</tr>

									 	<tr valign="baseline">
									 <td>Contraseña:</td>
									 <td><input name="password" required/></td>
									 <td><font size="5">*</font></td>
									 	</tr>

  								<tr valign="baseline">
         							 <td nowrap="nowrap" align="right">&nbsp;</td>
         								 <td><input type="submit" id="enviar_usu" value="Registrar" /></td>
      										  </tr>

  									</table>
 										<input type="hidden" name="MM_insert" value="form1" />
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
											<li><a href="login_familias.php">Inicia sesión</a></li>
											<li><a href="registro_familia.php">Registrate</a></li>
										</ul>
									</li>
									<li><a href="left-sidebar.html"><i class="fa fa-female fa-2x"></i><span> NIÑERA</span></a>
									<ul>
											<li><a href="login_nineras.php">Inicia sesión</a></li>
											<li><a href="registro_ninera.php">Registrate</a></li>
										</ul>
									</li>
									<li><a href="acerca_de.html"><i class="fa fa-info-circle fa-2x"></i> </i><span> ACERCA DE</span></a></li>
									<li><a href="requisitos.html"><i class="fa fa-file-text-o fa-2x"></i><span>  RECOMENDACIONES</span></a></li>
								</ul>
							</nav>

					</div>
				</div>
			</head>
			<!-- Features -->
			
			<!-- Footer -->
				
					<div id="copyright" class="container">
						<ul class="links">
							<li><font color="black"> Nanafy Todos los derechos reservados &copy; Copyright 2016</li><li><a href="cerrar_sesion_admin.php">Cerrar sesión</a></font></li>
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

