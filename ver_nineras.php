
<!--PAGINA PENDIENTE NO MOVER ( ATTE SAID ) -->
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

mysql_select_db($database_Conexionnany, $Conexionnany);
$query_consultaUsuarios = sprintf("SELECT * FROM us_ninera WHERE us_ninera.status_n = 1 AND us_ninera.type_n = 'premium'");
$consultaUsuarios = mysql_query($query_consultaUsuarios, $Conexionnany) or die(mysql_error());
$row_consultaUsuarios = mysql_fetch_assoc($consultaUsuarios);
$totalRows_consultaUsuarios = mysql_num_rows($consultaUsuarios);
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

						<!-- Logo -->
							

						<!-- Nav -->
							<nav id="nav">
								<ul>
									<li><a href="index.html"><i class="fa fa-home fa-2x"></i><span> INICIO</span></a></li>
									<li><a href="ver_nineras.php"><i class="fa fa-female fa-2x"></i> <span>	NIÑERAS</span></a></li>
								</ul>
								
							</nav>


    <div class="container">
        
      <div class="datosninera">
            
               <?php if ($totalRows_consultaUsuarios > 0) { // Show if recordset not empty ?>
               <?php do { ?>
              <div class="bordeninera">

                  <section>
                       <a href="#"><img src="images/nany.png" alt="" /></a><h3><?php echo $row_consultaUsuarios['name_n']; ?> <?php echo $row_consultaUsuarios['last_namen']; ?></h3>
                        <p><?php echo $row_consultaUsuarios['email_n']; ?></p>                  
                  </section>

               </div>
       
                   
                <?php } while ($row_consultaUsuarios = mysql_fetch_assoc ($consultaUsuarios));?>
                <?php } // Show if recordset not empty ?>
             
                  <?php if ($totalRows_consultaUsuarios == 0) { // Show if recordset empty ?>
                   <p>No hay niñeras disponibles en esta sección</p>
                  <?php } // Show if recordset empty ?> 
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