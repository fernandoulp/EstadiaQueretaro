<?php require_once('Connections/Conexionnany.php'); 

if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "premium";
$MM_donotCheckaccess = "false";

// *** RESTRINGIR ACCESO A PÁGINA SI EL USUARIO EN SESIÓN NO ES ADMINISTRADOR
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

$maxRows_Recordset1 = 20;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_Conexionnany, $Conexionnany);
$query_Recordset1 = "SELECT * FROM administradores ORDER BY administradores.name_adm ASC";
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
		<title>Lista de administradores</title>
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
							<img src="images/admin2.png" alt="" width="125" height="125"/>
					<p>
							<h1 id="logo">LISTA DE ADMINISTRADORES</h1>
						</p>
						<P>ADMINISTRDORES <u><b>ACTUALES</b></u></P>
<br>
<div align="left"><a href="inicio_admin.php"><strong>Menú<strong></a></div>


			<!--FORMULARIO RESPUESTA DE COMENTARIOS-->
							<p>

								 <table border="1">
							    <tr class="brillo1">
							    	<td align="center" >ID</td>
							      <td align="center" >Nombre</td>
							      <td align="center">Apellido Paterno</td>
							      <td align="center">Apellido Materno</td>
							      <td align="center">Email</td>
							      <td align="center">Opciones</td>
							    </tr>
							    <tr>
							     
							    </tr>
							    <?php do { ?>
							  <tr class="brillo">

							    <td align="center" width="35"><?php echo $row_Recordset1['id_user']; ?></td>
							    <td align="center" width="150"><?php echo $row_Recordset1['name_adm']; ?></td>
							    <td align="center" width="150"><?php echo $row_Recordset1['ape1_adm']; ?></td>
							    <td align="center" width="150"><?php echo $row_Recordset1['ape2_adm']; ?></td>
							    <td align="center" width="150"><?php echo $row_Recordset1['email_adm']; ?></td>
							   <td align="center" width="170" class="special" id="main"><a href="eliminar_admin.php?recordID=<?php echo $row_Recordset1['id_user']; ?>"onclick="pregunta_eliminar();">Eliminar</a>- <a href="modificar_admin.php?recordID=<?php echo $row_Recordset1['id_user']; ?>">Modificar</a></td>

							  
							  </tr>
							  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
							  </table>
							  <?php echo $totalRows_Recordset1 ?> Total de mensajes

								<!--SCRIPT PARA  PREGUNTA/ELIMINAR-->
											<script>
								  function pregunta_eliminar()
								{
								if(confirm("Desea eliminar el administrador seleccionado ?"))
								document.location.href="";
								else
								event.preventDefault();
								}
								</script>
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
			
	<!-- Footer -->
				
					<div id="copyright" class="container">
						<ul class="links">
							<li><font color="black"> Nanafy Todos los derechos reservados &copy; Copyright 2016</li><li><a href="login_nanny.php">Administración</a></font></li>
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