<?php

/*VARIABLES PARA ENVIAR POR EMAIL*/
$email = 'consultic9@gmail.com';
$coment = $_POST['coment'];
$para = $_POST['email_coment'];
$titulo = 'Respuesta de empresa consultic';
$header = 'From: ' . $email;
$msjCorreo = "E-Mail: $email\n Mensaje:\n $coment";
/*Datos a enviar y mensajes al usuario.*/
if ($_POST['submit']) 
{

if (mail($para, $titulo, $msjCorreo, $header)) {
echo "<script language='javascript'>
alert('Mensaje enviado...Gracias!.');
window.location.href = 'coment_admin.php';
</script>";
} else {
echo 'Falló el envio, intenta de nuevo por favor.';
}
}


?>