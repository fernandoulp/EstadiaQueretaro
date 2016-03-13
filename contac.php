<?php require_once('Connections/Conexionnany.php'); ?>
<?php

/*Variables para enviar email.*/
$nombre_coment = $_POST['nombre_coment'];
$email_coment = $_POST['email_coment'];
$coment = $_POST['coment'];
$para = 'diegocarrillo482@gmail.com';
$titulo = 'Mensaje enviado desde administración en https://www.GoNanny.com.mx';
$header = 'From: ' . $email_coment;
$msjCorreo = "Nombre: $nombre_coment\n E-Mail: $email_coment\n Mensaje:\n $coment";


/*Conexión y consulta para insertar en la base de datos.*/
$Conexionnany = mysql_connect("localhost" , "root" , "utd");
mysql_select_db("gonanny",$Conexionnany);
$sql = "INSERT INTO contacto (nombre_coment, email_coment, coment) VALUES ('$nombre_coment','$email_coment','$coment')";
mysql_query($sql);

/*Datos a enviar y mensajes al usuario.*/
if ($_POST['submit']) 
{

if (mail($para, $titulo, $msjCorreo, $header)) {
echo "<script language='javascript'>
alert('Mensaje enviado, responderemos a la brevedad...Gracias!.');
window.location.href = 'index.html';
</script>";
} else {
echo 'Falló el envio, intenta de nuevo por favor.';
}
}


?>

