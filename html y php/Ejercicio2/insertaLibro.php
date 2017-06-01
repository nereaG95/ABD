<?php
			$db = @mysqli_connect('localhost','root','','libreria');
			$titulo = $_POST["titulo"];
			echo $titulo;
			$precio = $_POST["precio"];
			echo $precio;
			$categoria = $_POST["categoria"];
			echo $categoria;
			$sql = "INSERT INTO libros (titulos, categoria, precio) VALUES ('$titulo', '$categoria','$precio')";
			$query = mysqli_query($db,$sql);
			echo mysqli_error($db);
			@mysqli_close($db);
			//header("Location: libreria.php");

?>