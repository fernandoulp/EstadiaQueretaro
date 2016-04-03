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
  $MM_dupKeyRedirect="falla_email_nineras.php";
  $loginUsername = $_POST['email_n'];
  $LoginRS__query = sprintf("SELECT email_n FROM us_ninera WHERE email_n=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_Conexionnany, $Conexionnany);
  $LoginRS=mysql_query($LoginRS__query, $Conexionnany) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //Si ya existe un usuario con el mismo email en la BD, no se podrá registrar.
  if($loginFoundUser){
    $MM_qsChar = "?";
  
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
  $insertSQL = sprintf("INSERT INTO us_ninera (name_n, last_namen, cumple_n, address_n, tel_n, email_n, password_n, estudios_n, auxilios_n, experiencia_n) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nombre_ninera'], "text"),
                       GetSQLValueString($_POST['apell_ninera'], "text"),
                       GetSQLValueString($_POST['cumple_n'], "text"),
                       GetSQLValueString($_POST['direccion_n'], "text"),
                       GetSQLValueString($_POST['tel_n'], "text"),
                       GetSQLValueString($_POST['email_n'], "text"),
                       GetSQLValueString($_POST['pass_n'], "text"),
                       GetSQLValueString($_POST['estudios_n'], "text"),
                       GetSQLValueString($_POST['auxilios_n'], "text"),
                       GetSQLValueString($_POST['experiencia_n'], "text"));

  mysql_select_db($database_Conexionnany, $Conexionnany);
  $Result1 = mysql_query($insertSQL, $Conexionnany) or die(mysql_error());

  $insertGoTo = "index.html";
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
		<title>Registro - Niñera</title>
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
							
							<h1 id="logo"><a>Niñeras</a></h1>
						
					</p>
				<!--FIN PHP-->


<br> 


			<!--FORMULARIO REGISTRO DE NIÑERAS-->
							<div>
								<section class="formulario">
								<form action="<?php echo $editFormAction; ?>"  method="post" name="form1" id="form1">
									<table align="center">
										<tr valign="baseline">
									 <td>Nombre:</td>
									 <td><input style="width:240px;height:40px" name="nombre_ninera" maxlength="20" required/></td>
									 	</tr>

									 	<tr valign="baseline">
									 <td>Apellidos:</td>
									 <td><input style="width:240px;height:20px" name="apell_ninera" maxlength="30" required/></td>
									 	</tr>

									 	<tr valign="baseline">
									 <td>Fecha de nacimiento:</td>
									 <td><input type="date" name="cumple_n" max="1999-01-01" required/></td>
									 	</tr>

										<tr valign="baseline">
									 <td>Dirección</td>
									 <td><input style="width:240px;height:20px" name="direccion_n" maxlength="50" required/></td>
									 	</tr>
									 	<tr valign="baseline">
									 <td>Teléfono Celular:</td>
									 <td><input type="tel" style="width:240px;height:20px" name="tel_n" required/></td>
									 	</tr>

									 	<tr valign="baseline">
									 <td>Email:</td>
									 <td><input style="width:240px;height:20px" name="email_n" required/></td>
									 	</tr>

									 	<tr valign="baseline">
									 <td>Contraseña:</td>
									 <td><input type="password" style="width:240px;height:20px" name="pass_n" required/></td>
									 	</tr>


									 	<tr valign="baseline">
									 <td>Estudios:</td>
									 <td><input style="width:240px;height:20px" name="estudios_n" required/></td></td>
									 	</tr>

									 	<tr valign="baseline">
									 <td>Primeros Auxilios:</td>
									 <td><input style="width:240px;height:20px" name="auxilios_n" required/></td></td>
									 	</tr>

									 	<tr valign="baseline">
									 <td>Experiencia (años):</td>	
									 <td><input type="number" min="1" style="width:240px;height:20px" name="experiencia_n" required/></td>
									 	</tr>

  								<tr valign="baseline">
         							 <td nowrap="nowrap" align="right">&nbsp;</td>
         								 <td><input type="submit" id="enviar_usu" value="Dar de alta" /></td>
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
									<li><a href="#"><i class="fa fa-users fa-2x"></i> </i><span> FAMILIA</span></a></li>
									<li><a href="#"><i class="fa fa-female fa-2x"></i> </i><span> NIÑERA</span></a></li>
									<li><a href="acerca.html"><i class="fa fa-info-circle fa-2x"></i> </i><span> ACERCA DE</span></a></li>
									<li><a href="recomendaciones.html"><i class="fa fa-file-text-o fa-2x"></i><span>  RECOMENDACIONES</span></a></li>
									<li><a href="iniciar_como.php"><input id="submit" type="submit" name="submit" value="Iniciar sesión" style="width:200px;height:45px"/></a></li>
								</ul>
								
							</nav>

					</div>
				</div>
			</head>
			<!-- Features -->
			
			<div id="copyright" class="container">
						<ul >
							<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
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

