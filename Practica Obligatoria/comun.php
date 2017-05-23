<!--Author: Nerea Gómez Domínguez-->
<?php
	echo "<div id='cabecera'>";
			echo "<h1><a href='index.php'>Mensajeria WEB</a></h1>";
			if (isset($_SESSION['login']) && $_SESSION['login']){
				echo "<div class='saludo'>";
				echo "Hola " .$_SESSION['idUser']. "<a href='cerrar.php'> Cerrar Sesion </a></div>";
			}
	echo"</div>";

	if (isset($_SESSION['login']) && $_SESSION['login']) {
		
		echo "<div id='sidebar-left'>";
				if(!$_SESSION['admin']){
					echo "<div id='cajaSidebar'>";
					echo "<h4><a href='index.php'>Enviar mensajes</a></h4>";
					echo"<ul>";
						echo "<h4>Mensajes comunes</h4>";
						echo "<li><a href='mensajesComunes.php?tipo=recibido'>Recibidos</a></li>";
						echo "<li><a href='mensajesComunes.php?tipo=enviado'>Enviados</a></li>";
					echo "</ul>";
					echo "</div>";
					echo "<div id='cajaSidebar'>";
					echo"<ul>";
						echo "<p><h4>Mensajes personales</h4>";
						echo "<li><a href='mensajesPersonales.php?tipo=recibido'>Recibidos</a></li>";
						echo "<li><a href='mensajesPersonales.php?tipo=enviado'>Enviados</a></li>";
					echo "</ul>";
					echo "</div>";
					echo "<div id='cajaSidebar'>";
					echo"<ul>";
						echo "<p><h4>Grupos </h4>";
						echo "<li><a href='grupos.php'>Tus grupos</a></li>";
						echo "<li><a href='mensajesGrupales.php'>Mensajes</a></li>";
					echo "</ul>";
					echo "</div>";
				}
				else{
					echo "<div id='cajaSidebar'>";
					echo "<h4><a href='admin.php'>Crear grupos</a></h4>";
					echo"<ul>";
						echo "<h4>Grupos disponibles</h4>";
						echo "<li><a href='gruposCreados.php'>Grupos creados</a></li>";
					echo "</ul>";
					echo "</div>";
				}
		echo "</div>";
	}
	
?>