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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE contacto SET email=%s WHERE id=%s",
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_Conexionnany, $Conexionnany);
  $Result1 = mysql_query($updateSQL, $Conexionnany) or die(mysql_error());

  $updateGoTo = "coment_admin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}


/*CONFIGURACIONES DEL SEGUNDO JUEGO DE CONSULTA (RECORDSET2).*/
$varCategoria_Recordset2 = "0";
if (isset($_GET["recordID"])) {
  $varCategoria_Recordset2 = $_GET["recordID"];
}
mysql_select_db($database_Conexionnany, $Conexionnany);
$query_Recordset2 = sprintf("SELECT * FROM contacto WHERE contacto.id = %s", GetSQLValueString($varCategoria_Recordset2, "int"));
$Recordset2 = mysql_query($query_Recordset2, $Conexionnany) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
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
							<h1>Responder Comentarios</h1>
					</p>
				<!--FIN PHP-->


<br>
			<!--FORMULARIO RESPUESTA DE COMENTARIOS-->
							
								<section class="formulario">
								<form action="respuesta_admin.php"  method="post" id="form2">

									 <label for="email">Email:</label>
									 <input id="email" type="email" value="<?php echo htmlentities($row_Recordset2['email'], ENT_COMPAT, 'iso-8859-1'); ?>" name="email" placeholder="ejemplo@correo.com" required/>

									 <label for="mensaje">Mensaje:</label>
									 <textarea id="mensaje" name="mensaje" placeholder="Mensaje" required/></textarea>

									 <input id="submit" type="submit" name="submit" value="Enviar"class="btn btn-link"/>
									 <input type="hidden" name="MM_update" value="form2" />
  									<input type="hidden" name="id" value="<?php echo $row_Recordset2['id']; ?>" />
                                </form>
							    </section>


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

<?php


mysql_free_result($Recordset2);
?>