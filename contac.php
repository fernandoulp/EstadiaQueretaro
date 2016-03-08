
<?php

/*Variables para enviar email.*/
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$mensaje = $_POST['mensaje'];
$para = 'consultic9@gmail.com';
$titulo = 'Mensaje enviado desde contáctanos en www.gonanny.com';
$header = 'From: ' . $email;
$msjCorreo = "Nombre: $nombre\n E-Mail: $email\n Mensaje:\n $mensaje";


/*Conexión y consulta para insertar en la base de datos.*/
$conexion = mysql_connect("localhost" , "" , "");
mysql_select_db("nanny",$conexion);
$sql = "INSERT INTO contacto (nombre, email, mensaje) VALUES ('$nombre','$email','$mensaje')";
mysql_query($sql);


/*Datos a enviar y mensajes al usuario.*/
if ($_POST['submit']) 
{

if (mail($para, $titulo, $msjCorreo, $header)) {
echo "<script language='javascript'>
alert('Mensaje enviado, responderemos a la brevedad...Gracias!.');
window.location.href = 'localhost/EstadiaQueretaro/index.html';
</script>";
} else {
echo 'Falló el envio, intenta de nuevo porfavor.';
}
}


?>

