<?php require_once('Connections/Conexionnany.php'); ?>
<?php
/*Conexión y consulta para insertar en la base de datos.*/
$Conexionnany = mysql_connect("localhost" , "root" , "utd");
mysql_select_db("gonanny",$Conexionnany);
$sql = "INSERT INTO ninera (nombre, ape1, ape2, direccion, cel, email, experiencia) VALUES ('$nombre','$ape1','$ape2', '$direccion', '$cel', '$email', '$experiencia')";
mysql_query($sql);

?>

