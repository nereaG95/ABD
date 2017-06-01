<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Prestamo libros</title>
</head>
<body>
 <?php
	$db = @mysqli_connect('localhost','root','','biblioteca'); ?>
	<h1><a href="index.html"> BIBLIOTECA </h1></a>
	
	<?php
		$sql = "SELECT * FROM libros";
		$consul= mysqli_query($db, $sql);
		if(mysqli_num_rows($consul)> 0){
			while ($resultado=mysqli_fetch_array($consul)){
				$valor = $resultado['idLibro'];
				echo "<p>Titulo: ".$resultado['titulo']."</p>";
				echo "<p> Categoria : ".$resultado['tema']."</p>";
				echo "<form action='' method='post'>";
				echo "<input type='hidden' name='id' value='$valor' />";
				echo "<input type='submit' name='btn' value='Ver usuario con este libro'>";
				echo "</form>";
				if(isset($_POST['btn'])){
					$idLibro= $_POST['id'];
					if($idLibro == $valor){
						$sql2= "SELECT * FROM usuarioslibros WHERE idLibro='$idLibro'";
						$consul2= mysqli_query($db, $sql2);
						$i=0;
						while ($resultado2=mysqli_fetch_array($consul2)){
							if($i==0){
								echo "Los usuarios que tienen este libro son: ";
							}
							echo "<p>Nombre de usuario: ". $resultado2['idUser'];
							$i++;
						}
						if($i==0){
							echo "Ningun usuario tiene este libro";
						}
					}
					/**/
					
				}
				echo "<hr></hr>";
			}
			
		}
		@mysqli_close($db);
	?>

</body>
</html>