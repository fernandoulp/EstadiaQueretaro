<?php require_once('Connections/Conexionnany.php'); 

if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "premium_p";
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
?>
 

<!DOCTYPE HTML>
<!--
	Strongly Typed by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Inicio Familia</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->

<!-- Start WOWSlider.com HEAD section -->
<link rel="stylesheet" type="text/css" href="engine1/style.css" />
<script type="text/javascript" src="engine1/jquery.js"></script>
<!-- End WOWSlider.com HEAD section -->
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
						<!-- Logo -->
							<img src="images/logo_pagina.png" alt="" />

							<p><strong><font  color="#8181F7" size="4px">Los padres también merecen su tiempo!</strong></a></p>
						
						<!-- Nav -->
							<nav id="nav">
								<ul>
									<li><a href="index_familia.php"><i class="fa fa-home fa-2x"></i><span> INICIO</span></a></li>
									<li><a href="mis_datos_padres.php?recordID=<?php echo $_SESSION['MM_id_nump']; ?>"><i class="fa fa-users fa-2x"></i> </i><span> MI PERFIL</span></a></li>
									<li><a href="ver_nineras_premium.php"><i class="fa fa-female fa-2x"></i> <span>	NIÑERAS</span></a></li>
								
								</ul>
								
							</nav>

					</div>

				</div>
				 </div>
				 
  <!-- end .header --></div>



			<!-- Features -->
				<div id="features-wrapper">
					<section id="features" class="container">
						<header>
								<h2><b><font color="#FE2E64">Cómo funciona</font></b>&nbsp;<b><font color="#58D3F7">NanaFy</b>?</font></h2>
						
						<div class="row">
							<div class="4u 12u(mobile)">

								<!-- Feature -->
									<section>
										<p><img src="images/formulario.png" alt="Formulario" width="200" height="200" /></p>
										<header>
											<h3><font color="#FE2E64">Niñeras registran sus datos </font></h3>
										</header>
										<p><font color="black">Cualquier mujer tiene la posibilidad de postularse en <strong><font color="orange">Nanafy</font></strong>, donde para hacerlo, necesitan cubrir ciertos requisitos, donde proporcionarán datos relevantes.</font></p>
									</section>

							</div>
							<div class="4u 12u(mobile)">

								<!-- Feature -->
									<section>
										<p><img src="images/fam.png" alt="Familias" width="200" height="200"/></p>
										<header>
											<h3><font color="#FE2E64">Familias registran sus datos</font></h3>
										</header>
										<p><font color="black">Las familias tendran que registrar sus datos previo a visualizar las listas de las niñeras que prestan su servicios para el cuidado y atención a menores.</font></p>
									</section>

							</div>
							<div class="4u 12u(mobile)">

								<!-- Feature -->
									<section>
										<p><img src="images/seleccion.png" alt="Selección" width="410" height="200"/></p>
										<header>
											<h3><strong><font color="#FE2E64">¡Selección de niñera!</font></strong></h3>
										</header>
										<p><font color="black">Después de que la familia se registro, podrá visualizar la sección donde aparecen las niñeras y seleccionar a la que cumpla con los reuisitos o según la calificación que tenga.</font></p>
									</section>

							</div>
						</div>
                        
                        <!--  LO PONGO EN COMENTARIO PARA PODER QUITARLO POR EL MOMENTO, PARA NO TENER UN ACERCA
						<ul class="actions">
							<li><a href="acerca.html" class="button icon fa-file">Leer más</a></li>
						</ul>  
                        -->
                        
					</section>
				</div>

			<!-- Banner -->
				<div id="banner-wrapper">
					<div class="inner">
						<section id="banner" class="container">
							
						</section>
					</div>
				</div>

			<!-- Main -->

			<!-- Footer -->
				<div id="footer-wrapper">
					<div id="footer" class="container">
						<header>
							<h2><font color="#FE2E64">Preguntas o Comentarios?</font> <font color="#58D3F7">Contactános:</font></h2>
						</header>
						<div class="row">
							<div class="6u 12u(mobile)">

								<!--FORMULARIO COMENTARIOS -->
								<section>
									<form method="post" action="contac.php">
										<div class="row 50%">
											<div class="6u 12u(mobile)">
												<input id="nombre" type="text" name="nombre_coment" placeholder="Nombre" required />
											</div>
											<div class="6u 12u(mobile)">
												<input id="email" type="text" name="email_coment" placeholder="ejemplo@correo.com" required/>
											</div>
										</div>
										<div class="row 50%">
											<div class="12u">
												<textarea id="mensaje" name="coment" placeholder="Mensaje" style="width:570px;height:40px" required/></textarea>
											</div>
										</div>
										<div class="row 50%">
											<div class="12u">
											 <table align="center">
							                  <tr valign="baseline">
							                   <td><input id="submit" type="submit" name="submit" value="Enviar" style="width:200px;height:45px"/></td>
							                    </tr>
							                 </table>
											</div>
										</div>
									</form>
								</section>
								<!--FIN COMENTARIOS-->
							</div>
							<div class="6u 12u(mobile)">
								<section>
									<p><font color="black">Los hijos no solo son un valioso tesoro también son delicados frutos, es por ello que en Nanafy nuestra prioridad es responder a tus preguntas y saber tus comentarios, para brindarte el mejor servicio con la mejor calidad y el mejor precio para tu familia.</font></p>
									<div class="row">
										<div class="6u 12u(mobile)">
											<ul class="icons">
												
												<li class="icon fa-envelope">
													<a href="#">nanafy@gmail.com</a>
												</li>
												<li class="icon fa-twitter">
													<a href="#">@nanafy</a>
												</li>
												<li class="icon fa-facebook">
													<a href="#">facebook.com/nanafyOficial</a>
												</li>
											</ul>
										</div>
										
									</div>
								</section>
							</div>
						</div>
					</div>
					<div id="copyright" class="container">
						<ul class="links">
							<font color="black"><li> Nanafy Todos los derechos reservados &copy; Copyright 2016</li></font>
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