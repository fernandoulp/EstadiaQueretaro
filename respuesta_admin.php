<?php

/*Variables para enviar email.*/

$email = 'diegocarrillo482@gmail.com';
$mensaje = $_POST['coment'];
$para = $_POST['email_coment'];
$titulo = 'Respuesta de empresa consultic';
$header = 'From: ' . $email;
$msjCorreo = "E-Mail: $email\n Mensaje:\n $mensaje";
/*Datos a enviar y mensajes al usuario.*/
if ($_POST['submit']) 
{

if (mail($para, $titulo, $msjCorreo, $header)) {
echo "<script language='javascript'>
alert('Mensaje enviado...Gracias!.');
window.location.href = 'http://www.consultic.bravoutd.com/inicio_admin.php';
</script>";
} else {
echo 'Falló el envio, intenta de nuevo porfavor.';
}
}


?>