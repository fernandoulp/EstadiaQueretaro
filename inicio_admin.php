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
// SENTENCIA SQL PARA MOSTRAR LOS DATOS DEL USUARIO EN SESION
$varUS_consulta_datos_administradores = "0";
if (isset($_SESSION['MM_id_user'])) {
  $varUS_consulta_datos_administradores = $_SESSION['MM_id_user'];
}
mysql_select_db($database_Conexionnany, $Conexionnany);
// CONSULTA SQL PARA TABLA USUARIOS
$query_consulta_datos_administradores = sprintf("SELECT * FROM administradores WHERE administradores.id_user = %s", GetSQLValueString($varUS_consulta_datos_administradores, "int"));
$consulta_datos_administradores = mysql_query($query_consulta_datos_administradores, $Conexionnany) or die(mysql_error());
$row_consulta_datos_administradores = mysql_fetch_assoc($consulta_datos_administradores);
$totalRows_consulta_datos_administradores = mysql_num_rows($consulta_datos_administradores);
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Administración</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
<script Language="JavaScript">
if(window.history.forward(1) != null) window.history.forward(1);
</script> 
		
	</head>
	<body >
	<head class="homepage">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header-wrapper">
					<div id="header" class="container">

					<p>
							


							<h1>Bienvenido                         <?php echo $row_consulta_datos_administradores['name_adm']; ?></h1>
						</p>


							<div class="row">
							<div class="4u 12u(mobile)">

								<!-- Feature -->
									<section>
										<a href="coment_admin.php" ><img src="images/coment1.png" alt="" width="125" height="125"/></a>
										<header>
											<h3>Comentarios</h3>
										</header>
										
									</section>

							</div>
							<div class="4u 12u(mobile)">

								<!-- Feature -->
									<section>
											<a href="registro_admin.php"><img src="images/add_adm.jpg" alt="" width="125" height="125"/></a>
										<header>
											<h3><strong>Agregar Administradores</strong></h3>
										</header>
										
									</section>

							</div>
							<div class="4u 12u(mobile)">

								<!-- Feature -->
									<section>
										<a href="lista_admin.php"><img src="images/admin2.png" alt="" width="125" height="125" /></a>
										<header>
											<h3>Lista Administradores </h3>
										</header>
					
									</section>

							</div>
						</div>


<div class="row">
							<div class="4u 12u(mobile)">

								<!-- Feature -->
									<section>
										<a href="lista_nineras_adm.php" ><img src="images/nany.png" alt="" width="125" height="125"/></a>
										<header>
											<h3>Lista Niñeras</h3>
										</header>
										
									</section>

							</div>
							<div class="4u 12u(mobile)">

								<!-- Feature -->
									<section>
										<a href="lista_padres_adm.php"><img src="images/padres.png" alt="" width="125" height="125"/></a>
										<header>
											<h3><strong>Lista Familias</strong></h3>
										</header>
										
									</section>

							</div>
							<div class="4u 12u(mobile)">

								<!-- Feature -->
									

							</div>
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