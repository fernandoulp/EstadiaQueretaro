<?php

class conexion{
	function conectar(){
		return mysqli_connect("localhost","root","utd");
	}
}
$cnn = new conexion();
if ($cnn->conectar()) {
	echo "conectado";
}else {
	echo "desconectado";
}
?>