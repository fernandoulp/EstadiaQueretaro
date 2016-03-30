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
?>
<?php
// *** VALIDAR SOLICITUD PARA LOGIN DENTRO DEL SITIO.
if (!isset($_SESSION)) {
  session_start();
}
$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) { //VALIDAR EL ACCESO AL USUARIO
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['email_n'])) { //SE DECLARAN VARIABLES QUE TENDRAN EL VALOR DE LOS CAMPOS DEL FORMULARIO
  $loginUsername=$_POST['email_n'];
  $password=$_POST['password_n']; //VARIABLE CONTRASEÑA
  $MM_fldUserAuthorization = "type_n";
  $MM_redirectLoginSuccess = "index_nineras.php"; //ENLACE SI LA CONEXIÓN ES ÉXITOSA
  $MM_redirectLoginFailed = "error_nineras.php"; //ENLACE SI FALLA LA CONEXIÓN
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_Conexionnany, $Conexionnany);
  
  // CONSULTA SQL PARA VERIFICAR QUE EL USUARIO ESTE EN REGISTRADO EN LA BD
  $LoginRS__query=sprintf("SELECT id_numn, email_n, password_n, type_n FROM us_ninera WHERE email_n=%s AND password_n=%s AND status_n=1",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
  $LoginRS = mysql_query($LoginRS__query, $Conexionnany) or die(mysql_error());
   $row_LoginRS = mysql_fetch_assoc($LoginRS);
  $loginFoundUser = mysql_num_rows($LoginRS);
  
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'type_n');    
  if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}

  //SE DECLARAN VARIABLES DE SESION QUE TOMARAN LOS VALORES DEL USUARIO EN SESION
  $_SESSION['MM_id_numn'] = $row_LoginRS["id_numn"]; 
  $_SESSION['MM_Username'] = $loginUsername;
  $_SESSION['MM_UserGroup'] = $loginStrGroup;       

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];  
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!--FIN DE LAS CONSULTAS Y PHP-->

<!--INICIO DEL CONTENIDO-->
<!DOCTYPE HTML>

<html>
	<head>
		<title>Iniciar Sesión</title>
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

						<!-- Logo -->
							

						<!-- Nav -->
						<nav id="nav">
                <ul>
                  <li><a href="index.html"><i class="fa fa-home fa-2x"></i><span> INICIO</span></a></li>
                  <li><a href="#"><i class="fa fa-users fa-2x"></i> </i><span> FAMILIA</span></a></li>
                  <li><a href="#"><i class="fa fa-female fa-2x"></i> </i><span> NIÑERA</span></a></li>
                  <li><a href="acerca.html"><i class="fa fa-info-circle fa-2x"></i> </i><span> ACERCA DE</span></a></li>
                  <li><a href="recomendaciones.html"><i class="fa fa-file-text-o fa-2x"></i><span>  RECOMENDACIONES</span></a></li>   
                </ul>
                
              </nav>


<div class="container">
<p>
              <h1 id="logo">Iniciar Sesión</h1>
            </p>
<!-- Formulario -->
                <section class="formulario">
                <form  id="form1" name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
                  <table align="center">

                    <tr valign="baseline">
                   <td>Email:</td>
                   <td><input type="email" name="email_n" placeholder="ejemplo@correo.com" style="width:240px;height:px" required /></td>
                    </tr>

                    <tr valign="baseline">
                   <td>Password:</td>
                   <td><input type="password" name="password_n" placeholder="password" style="width:240px;height:40px" required/></td>
                    </tr>

                    

                 </table>
                 <table align="center">
                  <tr valign="baseline">
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                   <td><input id="submit" type="submit" name="submit" value="Iniciar" style="width:200px;height:40px"/></td>
                    </tr>
                 </table>
                  </form>
                  </section>

                  <!-- Fin del formulario -->
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/login.png" WIDTH=162 HEIGHT=164 ALT="Login"/>
				</div>

		<div id="copyright" class="container">
            <ul class="links">
              <li>Nanafy</li><li>Todos los derechos reservados &copy; Copyright 2016</li>
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