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
							
							<h1 id="logo"><a>Familia</a></h1>
						
					</p>
				<!--FIN PHP-->


<br> 


			<!--FORMULARIO REGISTRO DE NIÑERAS-->
							<div>
								<section class="formulario">
								<form action="respuesta_admin.php"  method="post" id="form2">
									<table align="center">
										<tr valign="baseline">
									 <td>Nombre:</td>
									 <td><input style="width:200px;height:20px"></td>
									 	</tr>

									 	<tr valign="baseline">
									 <td>Apellido Paterno:</td>
									 <td><input style="width:200px;height:20px"></td>
									 	</tr>

									 	<tr valign="baseline">
									 <td>Apellido Materno:</td>
									 <td><input style="width:200px;height:20px"></td>
									 	</tr>

									 	<tr valign="baseline">
									 <td>Dirección:</td>
									 <td><input style="width:200px;height:20px"></td>
									 	</tr>

									 	<tr valign="baseline">
									 <td>Teléfono Celular:</td>
									 <td><input style="width:200px;height:20px"></td>
									 	</tr>

									 	<tr valign="baseline">
									 <td>Email:</td>
									 <td><input style="width:200px;height:20px"></td>
									 	</tr>

									 	<tr valign="baseline">
									 <td>Sexo:</td>
									 <td></td>
									 	</tr>

									 	<tr valign="baseline">
									 <td>Edad:</td>
									 <td></td>
									 	</tr>

									 	


  									</table>
                                </form>
							    </section>
							</div>

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