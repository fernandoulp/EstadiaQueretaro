<?php require_once('Connections/Conexionnany.php'); ?>
<?php

/*Variables para enviar email.*/
$nombre = $_POST['nombre_coment'];
$email = $_POST['email_coment'];
$mensaje = $_POST['coment'];
$para = 'diegocarrillo482@gmail.com';
$titulo = 'Mensaje enviado desde contáctanos en www.gonanny.com';
$header = 'From: ' . $email;
$msjCorreo = "Nombre: $nombre\n E-Mail: $email\n Mensaje:\n $mensaje";


/*Conexión y consulta para insertar en la base de datos.*/
$conexion = mysql_connect("localhost" , "root" , "utd");
mysql_select_db("gonanny",$Conexionnany);
$sql = "INSERT INTO contacto (nombre_coment, email_coment, coment) VALUES ('$nombre','$email','$mensaje')";
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
echo 'Falló el envio, intenta de nuevo porfavor.';
}
}


?>

