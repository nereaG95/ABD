<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pedido</title>
	
	       <!-- <link rel="stylesheet" href="style.css" type="text/css" media="all"/>-->
<style>
th{color:blue;}
td{color:green;}
</style>
</head>
<body>
<?php
		$db = @mysqli_connect('localhost','root','','libreria');
	
?>
	<form action="" method="post">
	<fieldset>
		<legend>Visualizar libros</legend>	
			<p>Categorias : 
			<select name="categoria">
			<?php
			$sql = "SELECT * FROM categorias";
			$query = mysqli_query($db,$sql);
			if(mysqli_num_rows($query) > 0){
				while ($lib=mysqli_fetch_array($query)){
					$valor = $lib['categoria'];
					echo "<option value='".$valor."'> ".$valor ."</option>";
				}
			}
			?>
			</select>
			</p>
			Precio Min:<br> <input type="number" name="min"><br>
			Precio Max: <br> <input type="number" name="max"><br>
			
	</fieldset>
	<input type="submit" name="Buscar">	
	</form>
	<?php
	if(isset($_POST["categoria"]) && isset($_POST["min"]) && isset($_POST["max"])){
		$max = $_POST["max"];
		$min = $_POST["min"];
		$categoria = $_POST["categoria"];
		$sql2 = "SELECT * FROM libros WHERE categoria='$categoria' AND ( precio <= '$max' && precio >= '$min')";
		$consulta = mysqli_query($db, $sql2);
		if(mysqli_num_rows($consulta)>0){
			echo "<table>";
			//th para los titulos
			echo "<th>Titulo </th><th> Precio </th>";
			while ($lib=mysqli_fetch_array($consulta)){
					$titulo = $lib['titulos'];
					$precio = $lib ['precio'];
					//tr indica que es una nueva fila
					echo "<tr>";
					//td indica lo que va en cada columna de esa fila
					echo "<td>" .$titulo ."</td>";
					echo "<td>" .$precio ."</td>";
					echo "<tr>";
			}
			echo "</table>";
		}
	}
	
	?>
	
	<form action="insertaLibro.php" method="post">
	<fieldset>
		<legend>Insertar libro</legend>	
			Titulo <br> <input type="text" name="titulo"><br>
			<p>Categoria : 
			<select name="categoria">
			<?php
			$sql3 = "SELECT * FROM categorias";
			$query2 = mysqli_query($db,$sql3);
			if(mysqli_num_rows($query2) > 0){
				while ($lib=mysqli_fetch_array($query2)){
					$valor = $lib['categoria'];
					echo "<option value='".$valor."'> ".$valor ."</option>";
				}
			}
			@mysqli_close($db);
			?>
			</select>
			</p>
			Precio:<br> <input type="number" name="precio"><br>
			
			
	</fieldset>
	<input type="submit" name="Buscar">	
	</form>

</body>
</html>