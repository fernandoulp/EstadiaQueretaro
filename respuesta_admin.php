<?php require_once('Connections/Conexionnany.php'); ?>
<?php

/*Variables para enviar email.*/
$nombre = $_POST['nombre_coment'];
$email = $_POST['email_coment'];
$coment = $_POST['coment'];
$para = 'diegocarrillo482@gmail.com';
$titulo = 'Mensaje enviado desde administración en https://www.GoNanny.com.mx';
$header = 'From: ' . $email;
$msjCorreo = "Nombre: $nombre\n E-Mail: $email\n Mensaje:\n $coment";

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