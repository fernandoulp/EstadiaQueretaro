
<?php require_once('Connections/Conexionnany.php'); ?>
<?php // FUNCION PARA VALIDAR QUE EL VALOR SEA STRING
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
// SENTENCIA SQL PARA MOSTRAR LOS USUARIOS ACTIVOS REGISTRADOS
mysql_select_db($database_Conexionnany, $Conexionnany);
$query_consultaUsuarios = "SELECT * FROM us_ninera WHERE us_ninera.status_n = 0";
$consultaUsuarios = mysql_query($query_consultaUsuarios, $Conexionnany) or die(mysql_error());
$row_consultaUsuarios = mysql_fetch_assoc($consultaUsuarios);
$totalRows_consultaUsuarios = mysql_num_rows($consultaUsuarios);
 ?>
 
<?php  
$a = $row_consultaUsuarios['id_numn'];

?>
<!DOCTYPE HTML>
<!--
	Strongly Typed by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Lista de usuarios suspendidos</title>
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

						<!-- Logo -->
							
           <h1 id"logo"> <img src="images/nany.png"></h1>
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

</br>

<h1 align="center">Lista de niñeras</h1>
  <p>USUARIOS <ins><b>SUSPENDIDOS</b></ins></p>
   <table border="1" cellspacing="0" cellpadding="5" align="center">
     <tr bgcolor="#F7FA8E" align="center">
       <p><td>ID</td></p>
       <td>Nombre</td>
       <td>Apellido</td>
       <td>Email</td>
       <td>Teléfono</td>
       <td>Tipo de usuario</td>
       <td>Opciones</td>
     </tr>
     <?php do { ?>
       <tr class="brillo2">
         <td onclick="location='datos_nineras.php?recordID=<?php echo $row_consultaUsuarios['id_numn']; ?>'"><?php echo $row_consultaUsuarios['id_numn']; ?></td>
         <td onclick="location='datos_nineras.php?recordID=<?php echo $row_consultaUsuarios['id_numn']; ?>'"><?php echo $row_consultaUsuarios['name_n']; ?></td>
         <td onclick="location='datos_nineras.php?recordID=<?php echo $row_consultaUsuarios['id_numn']; ?>'"><?php echo $row_consultaUsuarios['last_namen']; ?> </td>
         <td onclick="location='datos_nineras.php?recordID=<?php echo $row_consultaUsuarios['id_numn']; ?>'"><?php echo $row_consultaUsuarios['email_n']; ?></td>
          <td onclick="location='datos_nineras.php?recordID=<?php echo $row_consultaUsuarios['id_numn']; ?>'"><?php echo $row_consultaUsuarios['tel_n']; ?></td>
         <td onclick="location='datos_nineras.php?recordID=<?php echo $row_consultaUsuarios['id_numn']; ?>'"><?php echo $row_consultaUsuarios['type_n']; ?></td>
   			<td><a href="reactivar_ninera.php?recordID=<?php echo $row_consultaUsuarios['id_numn']; ?>" onclick="pregunta_reactivar()"> Reactivar </a> -  <a href="eliminar_ninera.php?recordID=<?php echo $row_consultaUsuarios['id_numn']; ?>" onclick="pregunta_eliminar()">Eliminar</a></td>
       </tr>
       <?php } while ($row_consultaUsuarios = mysql_fetch_assoc($consultaUsuarios)); ?>
 </table>
</div>

					</div>
				</div>

		<!--SCRIPTS PARA VALIDAR PETICI�N DE USUARIO-->
  <script>
  function pregunta_reactivar()
{
if(confirm("Desea volver a activar el usuario seleccionado?"))
document.location.href="";
else
event.preventDefault();
}
</script>

<script>
  function pregunta_eliminar()
{
if(confirm("Desea eliminar permanentemente el usuario seleccionado?"))
document.location.href="";
else
event.preventDefault();
}
</script>


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