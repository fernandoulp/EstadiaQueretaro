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

// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="alta_emailrepetido.php";
  $loginUsername = $_POST['email_n'];
  $LoginRS__query = sprintf("SELECT email_n FROM us_nineras WHERE email_n=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_Conexionnany, $Conexionnany);
  $LoginRS=mysql_query($LoginRS__query, $Conexionnany) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO us_ninera (name_n, last_namen, password_n, cumple_n, address_n, tel_n, email_n, estudios_n, auxilios_n, experiencia_n) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %S)",
                       GetSQLValueString($_POST['nom_usuario'], "text"),
                       GetSQLValueString($_POST['apell_usuario'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['carrera_usuario'], "text"),
                       GetSQLValueString($_POST['tel_usuario'], "text"),
                       GetSQLValueString($_POST['imagen'], "text"),
                       GetSQLValueString($_POST['correo_usuario'], "text"),
                       GetSQLValueString($_POST['Activo'], "int"));

  mysql_select_db($database_Conexionnany, $Conexionnany);
  $Result1 = mysql_query($insertSQL, $Conexionnany) or die(mysql_error());

  $insertGoTo = "index.html";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/platilla_admin.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Documento sin título</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->

<!-- InstanceEndEditable -->
<link href="menu_source/styles.css" rel="stylesheet" type="text/css" />
<link href="paginaprincipal.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="container">
  <div class="header"><img src="logo2.png" alt="Insertar logotipo aquí" name="Insert_logo" width="985" height="116" id="Insert_logo"  display:block;" /><!-- end .header --></div>
  <div class="sidebar1">
    <ul class="nav">
      <li><a href="usuarios_lista.php">Lista de usuarios</a><!-- end .sidebar1 --></li>
    </ul>
  </div>
  <div class="content"><!-- InstanceBeginEditable name="EditRegion3" -->
    
<script>
  function subirimagen ()
  {
	 self.name = 'opener';
	 remote = open('gestionimagen2.php','remote',
	 'width=400,height=150,location=no,scrollbars=yes,menubars=no,toolbars=no,resizable=yes,fullscreen=no, status=yes');
	 remote.focus();
	  }
  
  </script>
    <script type="text/javascript">
//nuevo script para el mensaje 
       window.onload = function(){
		   //método llamado function
          var formulario = document.getElementById('formulario');
		  //variable para los campos
          var boton = document.getElementById('enviar');
		  //variable para el botón de agregar
          enviar_usu.onclick = function(){
			  //onclick es una función para que al presionar el botón enviar realice la acción del método function
             if(form1.checkValidity()){
				 //si el formulario esta validado mandara una alerta y se podrá agregar la actividad
                alert('El usuario se ha dado de alta exitosamente');
				//mensaje
             }
          }
       }
    </script>
  
  
  
    <h1>Agregar usuario Agenda PTC</h1>
    <p>&nbsp;</p>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <table align="center">
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Nombre:</td>
          <td>
            <input type="text" name="nom_usuario" value="" size="32" required/>
            </td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Apellido:</td>
          <td>
            <input type="text" name="apell_usuario" value="" size="32" required/>
         </td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Contraseña:</td>
          <td>
            <input type="password" name="password" value="" size="32" required/>
          </td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Carrera:</td>
          <td><select name="carrera_usuario">
            <option value="TICS" <?php if (!(strcmp("TICS", ""))) {echo "SELECTED";} ?>>TICS</option>
            <option value="ENRE" <?php if (!(strcmp("ENRE", ""))) {echo "SELECTED";} ?>>ENRE</option>
            <option value="MECA" <?php if (!(strcmp("MECA", ""))) {echo "SELECTED";} ?>>MECA</option>
            <option value="OCI" <?php if (!(strcmp("OCI", ""))) {echo "SELECTED";} ?>>OCI</option>
            <option value="DENE" <?php if (!(strcmp("DENE", ""))) {echo "SELECTED";} ?>>DENE</option>
          </select></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Teléfono:</td>
          <td><input type="text" name="tel_usuario" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Imagen:</td>
          <td><input type="text" name="imagen" value="" size="32" readonly="readonly" readonly="readonly" />
          <input type="button" name="button" id="button" value="Subir imagen" onclick="javascript:subirimagen();"/></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Correo electrónico:</td>
          <td>
          <input type="email" name="correo_usuario" value="" size="32" required/>
          </td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Estado:</td>
          <td><select name="Activo">
            <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>Activo</option>
            <option value="0" <?php if (!(strcmp(0, ""))) {echo "SELECTED";} ?>>Inactivo</option>
          </select></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input type="submit" id="enviar_usu" value="Dar de alta" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form1" />
    </form>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  
  <!-- InstanceEndEditable --><!-- end .content --></div>
  <div class="footer">
    <p><a href="index.php">Página Agenda PTC</a></p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
