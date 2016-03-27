<?php require_once('Connections/Conexionnany.php'); 

if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "normal";
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
									<li></li>
								
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
							<h2>Cómo funciona  <strong>NanaFy</strong>?</h2>
						</header>
						<div class="row">
							<div class="4u 12u(mobile)">

								<!-- Feature -->
									<section>
										<a href="#" class="image featured"><img src="images/solicitud.jpg" alt=""  /></a>
										<header>
											<h3>Niñeras suben su solicitud </h3>
										</header>
										<p>Cualquier niñera tiene la posibilidad de postularse en <strong>Nanafy</strong>, donde para hacerlo, necesitan registrarse, donde proporcionarán todos sus datos.</p>
									</section>

							</div>
							<div class="4u 12u(mobile)">

								<!-- Feature -->
									<section>
										<a href="#" class="image featured"><img src="images/familia.jpg" alt="" /></a>
										<header>
											<h3>Familias escogen a una niñera</h3>
										</header>
										<p>Las familias tendran acceso a la información de todas las niñeras que se registren. Aquí las familias estarán en contacto directo con ellas para llegar a un acuerdo si es que la niñera cumple con los requisitos de la familia.</p>
									</section>

							</div>
							<div class="4u 12u(mobile)">

								<!-- Feature -->
									<section>
										<a href="#" class="image featured"><img src="images/mujer.jpg" alt="" /></a>
										<header>
											<h3><strong>¡Manos a la obra!</strong></h3>
										</header>
										<p>Después de ponerse en contacto la familia con la niñera, el siguiente paso es que
                                        los papás puedan divertirse y la niñera empiece a cuidar :)</p>
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
							<p>Slogan <strong> o algo así</strong>.<br />
							</p>
						</section>
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