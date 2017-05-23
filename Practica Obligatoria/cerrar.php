<!--Author: Nerea Gómez Domínguez-->
<?php
//Doble seguridad: unset + destroy
	session_start();
    session_destroy();
	unset($_SESSION["login"]);
    unset($_SESSION["idUser"]);
	$_SESSION=[];
	header('Location: index.php')
?>