<?php require_once('Connections/Conexionnany.php'); 

if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "premium_n";
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
$MM_restrictGoTo = "login_nineras.php";
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
$varUS_consulta_datos_ninera = "0";
if (isset($_SESSION['MM_id_numn'])) {
  $varUS_consulta_datos_ninera = $_SESSION['MM_id_numn'];
}
mysql_select_db($database_Conexionnany, $Conexionnany);
// CONSULTA SQL PARA TABLA USUARIOS
$query_consulta_datos_ninera = sprintf("SELECT * FROM us_ninera WHERE us_ninera.id_numn = %s", GetSQLValueString($varUS_consulta_datos_ninera, "int"));
$consulta_datos_ninera = mysql_query($query_consulta_datos_ninera, $Conexionnany) or die(mysql_error());
$row_consulta_datos_ninera = mysql_fetch_assoc($consulta_datos_ninera);
$totalRows_consulta_datos_ninera = mysql_num_rows($consulta_datos_ninera);


//CONSULTA SQL LOS MENSAJES DEL USUARIO
mysql_select_db($database_Conexionnany, $Conexionnany);
$query_consulta_mensajes = sprintf("SELECT * FROM mensajes WHERE mensajes.id_ninera = %s", GetSQLValueString($varUS_consulta_datos_ninera, "int"));
$consulta_mensajes = mysql_query($query_consulta_mensajes, $Conexionnany) or die(mysql_error());
$row_consulta_mensajes = mysql_fetch_assoc($consulta_mensajes);
$totalRows_consulta_mensajes = mysql_num_rows($consulta_mensajes);
?>
 

<!DOCTYPE HTML>
<!--
	Strongly Typed by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Inicio Niñeras</title>
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
	<i class="fa fa-female fa-2x"></i> 
	</i> <?php echo $row_consulta_datos_ninera['name_n']; ?> 
	<?php echo $row_consulta_datos_ninera['last_namen']; ?> </br>
	<a href="cerrar_sesion_ninera.php">Cerrar sesion</a>
	</div>
						<!-- Logo -->
							<img src="images/logo_pagina.png" alt="" />

							<p>Los padres tambien merecen su tiempo</p>
						
						<!-- Nav -->
							<nav id="nav">
								<ul>
									<li><a href="index_nineras.php"><i class="fa fa-home fa-2x"></i><span> INICIO</span></a></li>
									<li><a href="mis_datos_ninera.php?recordID=<?php echo $_SESSION['MM_id_numn']; ?>"><i class="fa fa-users fa-2x"></i> </i><span> MI PERFIL</span></a></li>
									<li><a href="mensajes_ninera.php?recordID=<?php echo $_SESSION['MM_id_numn']; ?>"><i class="fa fa-envelope fa-2x"></i> <span>MENSAJES (<?php echo $totalRows_consulta_mensajes?>)</span></a></li>
								
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
					<div><div id="banner-wrapper">
					<div class="inner">
						


<!-- Start WOWSlider.com BODY section -->
<div id="wowslider-container1">
<div class="ws_images"><ul>
		<li><a href="http://wowslider.com"><img src="data1/images/nios.jpg" alt="http://wowslider.com/" title="niños" id="wows1_0"/></a></li>
		<li><img src="data1/images/nios4.jpg" alt="niños4" title="niños4" id="wows1_1"/></li>
	</ul></div>
	<div class="ws_bullets"><div>
		<a href="#" title="niños"><span><img src="data1/tooltips/nios.jpg" alt="niños"/>1</span></a>
		<a href="#" title="niños4"><span><img src="data1/tooltips/nios4.jpg" alt="niños4"/>2</span></a>
	</div></div><div class="ws_script" style="position:absolute;left:-99%"><a href="http://wowslider.com">http://wowslider.com/</a> by WOWSlider.com v8.7</div>
<div class="ws_shadow"></div>
</div>	
<script type="text/javascript" src="engine1/wowslider.js"></script>
<script type="text/javascript" src="engine1/script.js"></script>
<!-- End WOWSlider.com BODY section -->


					</div>
				</div>
				</div>

			<!-- Main -->

			<!-- Footer -->
				<div id="footer-wrapper">
					<div id="footer" class="container">
						<header>
							<h2>Preguntas o Comentarios? <strong>Contactános:</strong></h2>
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
									<p>Los hijos no solo son un valioso tesoro también son delicados frutos, es por ello que en Nanafy nuestra prioridad es responder a tus preguntas y saber tus comentarios, para brindarte el mejor servicio con la mejor calidad y el mejor precio para tu familia.</p>
									<div class="row">
										<div class="6u 12u(mobile)">
											<ul class="icons">
												<li class="icon fa-home">
													1234 Somewhere Road<br />
													Nashville, TN 00000<br />
													USA
												</li>
												<li class="icon fa-phone">
													(044) 618-815-94-99
												</li>
												<li class="icon fa-envelope">
													<a href="#">nanafy@gmail.com</a>
												</li>
											</ul>
										</div>
										<div class="6u 12u(mobile)">
											<ul class="icons">
												<li class="icon fa-twitter">
													<a href="#">@nanafy</a>
												</li>
												<li class="icon fa-instagram">
													<a href="#">instagram.com/nanafy</a>
												</li>
												<li class="icon fa-dribbble">
													<a href="#">dribbble.com/nanafy</a>
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
							<li> Nanafy Todos los derechos reservados &copy; Copyright 2016</li><li><a href="login_nanny.php">Administración</a></li>
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