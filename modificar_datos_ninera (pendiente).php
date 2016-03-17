<?php require_once('Connections/Conexionnany.php'); ?>


<?php  // FUNCION PARA VALIDAR QUE EL VALOR SEA STRING
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
// SE DECLARA UNA VARIABLE CON EL VALOR DEL ID DEL USUARIO EN SESIÓN (CONSULTA SQL)
$varID_consultaMisdatos = "0";
if (isset($_SESSION['MM_id_usuario'])) {
  $varID_consultaMisdatos = $_SESSION['MM_id_usuario'];
}
mysql_select_db($database_Conexionnany, $Conexionnany);
$query_consultaMisdatos = sprintf("SELECT * FROM us_ninera WHERE us_ninera.id_numn = %s", GetSQLValueString($varID_consultaMisdatos, "int"));
$consultaMisdatos = mysql_query($query_consultaMisdatos, $Conexionnany) or die(mysql_error());
$row_consultaMisdatos = mysql_fetch_assoc($consultaMisdatos);
$totalRows_consultaMisdatos = mysql_num_rows($consultaMisdatos);
?>
<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
?>

<?php //FORMULARIO CON LOS DATOS CORREGIDOS , SENTENCIA UPDATE PARA ACTUALIZAR LA INFORMACION DEL REGISTRO
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE us_ninera SET nombre=%s, ape1=%s, ape2=%s, email=%s, sexo=%s, edad=%s, telefono=%s, celular=%s, direccion=%s, username=%s, contrasena=%s, cp=%s, pais=%s, estado=%s, rfc=%s, estado_us=%s, tipo_us=%s WHERE id_usuario=%s",
  // VALORES DEL FORMULARIO ENVIADOS POR EL METODO POST
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['ape1'], "text"),
                       GetSQLValueString($_POST['ape2'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['sexo'], "text"),
                       GetSQLValueString($_POST['edad'], "text"),
                       GetSQLValueString($_POST['telefono'], "text"),
                       GetSQLValueString($_POST['celular'], "text"),
                       GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['contrasena'], "text"),
                       GetSQLValueString($_POST['cp'], "int"),
                       GetSQLValueString($_POST['country'], "text"),
                       GetSQLValueString($_POST['city_state'], "text"),
                       GetSQLValueString($_POST['rfc'], "text"),
                       GetSQLValueString($_POST['Activo'], "int"),
                       GetSQLValueString($_POST['tipo'], "text"),
                       GetSQLValueString($_POST['id_usuario'], "int"));

  mysql_select_db($database_ConexionAserca, $ConexionAserca);
  $Result1 = mysql_query($updateSQL, $ConexionAserca) or die(mysql_error());
// REDICCIONAMIENTO AL INSERTAR
  $updateGoTo = "datos_usuario.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
              
              <h1 id="logo"><a>Niñeras</a></h1>
            
          </p>
        <!--FIN PHP-->


<br> 


      <!--FORMULARIO REGISTRO DE NIÑERAS-->
              <div>
                <section class="formulario">
                <form action="agregar_ninera.php"  method="post" id="form2">
                  <table align="center">
                    <tr valign="baseline">
                   <td>Nombre:</td>
                   <td><input value="<?php echo htmlentities($row_consultaMisdatos['name_n'], ENT_COMPAT, ''); ?>" style="width:240px;height:40px" requiered/></td>
                    </tr>

                    <tr valign="baseline">
                   <td>Apellido Paterno:</td>
                   <td><input style="width:240px;height:20px" requiered/></td>
                    </tr>

                    <tr valign="baseline">
                   <td>Apellido Materno:</td>
                   <td><input style="width:240px;height:20px" requiered/></td>
                    </tr>

                    <tr valign="baseline">
                   <td>Fecha de nacimiento:</td>
                   <td><input type="date" name="fecha" max="1999-01-01"requiered/></td>
                    </tr>

                    <tr valign="baseline">
                   <td>Dirección</td>
                   <td><input style="width:240px;height:20px" requiered/></td>
                    </tr>
                    <tr valign="baseline">
                   <td>Teléfono Celular:</td>
                   <td><input style="width:240px;height:20px" requiered/></td>
                    </tr>

                    <tr valign="baseline">
                   <td>Email:</td>
                   <td><input style="width:240px;height:20px" requiered/></td>
                    </tr>

                    <tr valign="baseline">
                   <td>Estudios:</td>
                   <td></td>
                    </tr>

                    <tr valign="baseline">
                   <td>Primeros Auxilios:</td>
                   <td></td>
                    </tr>

                    <tr valign="baseline">
                   <td>Experiencia (años):</td>
                   <td><input style="width:240px;height:20px" requiered/></td>
                    </tr>

                    </table>

                    <table>
                      <tr valign="baseline">
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                             <td><input id="submit" type="submit" name="submit" value="Continuar" style="width:200px;height:40px"/></td>
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
   
   