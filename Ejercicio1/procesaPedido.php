<?php

//Recogemos los datos personales del formulario 
$name = $_POST["nom"];
$telefono = $_POST["tel"];
$email = $_POST["mail"];
$Direccion = $_POST["dir"];

//Recogemos los datos del pedido
$primerPlato = $_POST["primero"];
$segundoPlato = $_POST["segundo"];
$postre = $_POST ["cafeote"];

//Recogemos las observaciones
$observaciones = $_POST["obs"];

//Obtenemos el valor del checkbox acepta los terminos
if( isset($_POST["condi"])){

	$terminos = $_POST["condi"];
}
else{
	$terminos = null;
}


//Mostramos los datos personales
echo "<h2> Datos Personales </h2>";
echo "<p>Nombre :" .$name;
echo "<p>Telefono :" .$telefono;
echo "<p>Email :" .$email;
echo "<p>Dirección :" .$Direccion;

//Mostramos lo que ha elegido del menú
echo "<h2> Menú elegido </h2>";
echo "<p> El primer plato es : " .$primerPlato;
echo "<p> El segundo plato es: " .$segundoPlato;
echo "<p> El postre elegido es: " .$postre;

//Comprobamos si hay observaciones por parte del cliente
if($observaciones == null){
	echo "<p> No hay observaciones por parte del cliente </p>";
}
else{
	echo "<p> Las observaciones por parte del cliente son: " .$observaciones;
}

//Comprobamos que el cliente haya marcado la opcion de acepta los terminos y condiciones
if($terminos != null){
	echo "<p>Acepta las condiciones</p>" ;
}
else{
	echo "<p> No acepta las condiciones </p>";
}

?>