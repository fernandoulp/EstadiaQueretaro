<?php require_once('Connections/Conexionnany.php'); ?>

<!--CONEXIÓN A LA BASE DE DATOS Y CONSULTAS PARA ADMINISTRACIÓN DE LOS COMENTARIOS-->
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

$maxRows_Recordset1 = 20;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_Conexionnany, $Conexionnany);
$query_Recordset1 = "SELECT * FROM contacto ORDER BY contacto.nombre_coment ASC";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $Conexionnany) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
?>
<!--FIN DE LAS CONSULTAS-->


<!DOCTYPE HTML>

<html>
	<head>
		<title>Lista de comentarios</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->

		<script>
function enlaces(dir) {
window.location.replace(dir)
}
</script>
	</head>
	<head class="homepage">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header-wrapper">
					<div id="header" class="container">
							<img src="images/coment1.png" alt="" width="125" height="125"/>
					<p>
							<h1 id="logo">LISTA DE COMENTARIOS</h1>
						</p>
						<P>Comentarios <u><b>Actuales</b></u></P>
<br>
<div align="left"><a href="inicio_admin.php"><strong>Menú<strong></a></div>


			<!--FORMULARIO RESPUESTA DE COMENTARIOS-->
							<p>

								 <table border="1">
							    <tr class="brillo1">
							      <td align="center" >Id</td>
							      <td align="center" >Nombre</td>
							      <td align="center">Email</td>
							      <td align="center">Mensaje</td>
							      <td align="center">Opciones</td>
							    </tr>
							    <tr>
							     
							    </tr>
							    <?php do { ?>
							  <tr class="brillo">
							  	<td align="center" width="150"><?php echo $row_Recordset1['id_coment']; ?></td>
							    <td align="center" width="150"><?php echo $row_Recordset1['nombre_coment']; ?></td>
							    <td align="center" width="290"><?php echo $row_Recordset1['email_coment']; ?></td>
							    <td align="center" width="590"><?php echo $row_Recordset1['coment']; ?></td>
							    <td align="center" width="170" class="special" id="main"><a href="eliminar_comentario.php?recordID=<?php echo $row_Recordset1['id_coment']; ?>"onclick="pregunta_eliminar();">Eliminar</a>- <a href="formulario_respuesta.php?recordID=<?php echo $row_Recordset1['id_coment']; ?>">Responder</a></td>

							  
							  </tr>
							  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
							  </table>
							  <?php echo $totalRows_Recordset1 ?> Total de mensajes

								
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