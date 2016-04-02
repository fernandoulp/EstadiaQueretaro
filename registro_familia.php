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
  $loginUsername = $_POST['email_p'];
  $LoginRS__query = sprintf("SELECT email_p FROM us_padres WHERE email_p=%s", GetSQLValueString($loginUsername, "text"));
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
  $insertSQL = sprintf("INSERT INTO us_padres (name_p, last_namep, address_p, email_p, password_p) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name_p'], "text"),
                       GetSQLValueString($_POST['last_namep'], "text"),
                       GetSQLValueString($_POST['address_p'], "text"),
                       GetSQLValueString($_POST['email_p'], "text"),
                       GetSQLValueString($_POST['password_p'], "text"));

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

				<!--PHP PARA RECONOCER USUARIO-->
					<p>
							
							<h1 id="logo">Registro familia</h1>
						
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
									 <td><input  name="name_p" required/></td>
									 	</tr>

									 	<tr valign="baseline">
									 <td>Apellido:</td>
									 <td><input name="last_namep" required/></td>
									 	</tr>

									 	<tr valign="baseline">
									 <td>Dirección:</td>
									 <td><input name="address_p"  required/></td>
									 	</tr>

									 	<tr valign="baseline">
									 <td>Email:</td>
									 <td><input name="email_p" required/></td>
									 	</tr>

									 	<tr valign="baseline">
									 <td>Contraseña:</td>
									 <td><input name="password_p" required/></td>
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
						<h3>
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
</h3>
					</div>
				</div>
			</head>
			<!-- Footer -->
				
					<div id="copyright" class="container">
						<ul class="links">
							<li><font color="black"> Nanafy Todos los derechos reservados &copy; Copyright 2016</font></li>
						</ul>
					</div>
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
</html>

