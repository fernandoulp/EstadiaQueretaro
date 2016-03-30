<?php require_once('Connections/Conexionnany.php'); ?>
<?php
// *** RESTRINGIR ACCESO A PÁGINA SI EL USUARIO EN SESIÓN NO ES PADRE
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "premium";
$MM_donotCheckaccess = "false";

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

mysql_select_db($database_Conexionnany, $Conexionnany);
$query_consultaUsuarios = sprintf("SELECT * FROM us_ninera WHERE us_ninera.status_n = 1 AND us_ninera.type_n = 'premium'");
$consultaUsuarios = mysql_query($query_consultaUsuarios, $Conexionnany) or die(mysql_error());
$row_consultaUsuarios = mysql_fetch_assoc($consultaUsuarios);
$totalRows_consultaUsuarios = mysql_num_rows($consultaUsuarios);


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

<!--FIN DE LAS CONSULTAS Y PHP-->

<!--INICIO DEL CONTENIDO-->
<!DOCTYPE HTML>

<html>
	<head>
		<title>Niñeras</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
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

						
							
	<div class="datos">
	<i class="fa fa-user fa-2x"></i> 
	</i> <?php echo $row_consulta_datos_padres['name_p']; ?> 
	<?php echo $row_consulta_datos_padres['last_namep']; ?> </br>
	<a href="cerrar_sesion_padres.php">Cerrar sesion</a>
	</div>
						<!-- Nav -->
							<nav id="nav">
								<ul>
									<li><a href="index_familia.php"><i class="fa fa-home fa-2x"></i><span> INICIO</span></a></li>
									<li><a href="mis_datos_padres.php?recordID=<?php echo $_SESSION['MM_id_nump']; ?>"><i class="fa fa-users fa-2x"></i> </i><span> MI PERFIL</span></a></li>
									<li><a href="ver_nineras_premium.php"><i class="fa fa-female fa-2x"></i> <span>	NIÑERAS</span></a></li>
								</ul>
								
							</nav>

					
				
   		
        
      		<div class="datosninera">
            
               <?php if ($totalRows_consultaUsuarios > 0) { // Show if recordset not empty ?>
               <?php do { ?>  
             	<div class="bordeninera">

                  <section>
                       <a href="#"><img src="images/nany.png" alt="" /></a><h3><span><?php echo $row_consultaUsuarios['name_n']; ?> <?php echo $row_consultaUsuarios['last_namen']; ?></span></h3>
                        <p>Email: <?php echo $row_consultaUsuarios['email_n']; ?></p>          
                        <p>Dirección: <?php echo $row_consultaUsuarios['address_n']; ?></p>
                         <p>Movil: <?php echo $row_consultaUsuarios['tel_n']; ?></p>
                         </br>
                         <a href="contactar_ninera.php?recordID=<?php echo $row_consultaUsuarios['id_numn']; ?>"><input id="submit" type="submit" name="submit" value="Contactar" style="width:200px;height:45px"/></a>
                  </section>
   	            </div>
         		   
                <?php } while ($row_consultaUsuarios = mysql_fetch_assoc ($consultaUsuarios));?>
                <?php } // Show if recordset not empty ?>
             
                  <?php if ($totalRows_consultaUsuarios == 0) { // Show if recordset empty ?>
                   <p>No hay niñeras disponibles en esta sección</p>
                  <?php } // Show if recordset empty ?> 
              
       		</div>
  		  </div>
	
    
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