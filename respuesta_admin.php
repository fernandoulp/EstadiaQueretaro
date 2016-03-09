<?php

/*VARIABLES PARA ENVIAR POR EMAIL*/

$email = 'gonanny@gmail.com';
$mensaje = $_POST['mensaje'];
$para = $_POST['email'];
$titulo = 'RESPUESTA DE GONANNY';
$header = 'From: ' . $email;
$msjCorreo = "E-Mail: $email\n Mensaje:\n $mensaje";


/*Datos a enviar y mensajes al usuario.*/
if ($_POST['submit']) 
{

if (mail($para, $titulo, $msjCorreo, $header)) {
echo "<script language='javascript'>
alert('Mensaje enviado...Gracias!.');
window.location.href = 'http://www.gonanny.com/inicio_admin.html';
</script>";
} else {
echo 'Falló el envio, intenta de nuevo por favor.';
}
}


?>