<!--Author: Nerea Gómez Domínguez-->
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="scriptIndex.js"></script>


<title>Portada</title>
</head>

<body>

<div id="contenedor">

	<?php
		$db = @mysqli_connect('localhost','root','','mensajeriaweb');
		session_start();   
		require ("comun.php");
	?>
	
	<div id="contenido">
		<?php 
		if (isset($_SESSION['login']) && $_SESSION['login'] && $_SESSION['admin']) {
		?>
			<div id='cajaMensajes'>
			<!--Formulario para mensajes comunes -->
			<form action='insertaGrupo.php' id="formGrupo" class="cajaGrupo" method="post">
			<p><h3>Crear grupo</h3></p>
			Nombre de grupo: <input type="text" maxlength="40" name="nombre" id="nombre" required />
			<p> Tipo de musica :
			<?php
				$sql = "SHOW COLUMNS FROM grupos LIKE 'tipoMusica'";
				$query = mysqli_query($db, $sql);
				$array = $query->fetch_array(MYSQLI_ASSOC);
				$parts = str_replace("enum(", '',$array['Type']); 
				$parts = explode(",", str_replace(")", '',$parts));
				echo "<select name='tipo' required>";
				foreach($parts as $key=>$value){
					$val = str_replace("'", '', $value);
					echo "<option value='$val' selected='selected'>$val</option>";
				}
				echo "</select>";
			?></p>
			<p>Edad mínima : <input type="number" min="5" max=130 name="edadMin" id="edadMin" required /></p>
			<p>Edad máxima : <input type="number" min="5" max=130 name="edadMax" id="edadMax" required /></p>
			<input type="submit" id="add" class="boton3" value="Añadir Grupo"/>
			<div class="correcto" id="correcto">Se ha añadido el grupo correctamente</div>
			<div class="error3" id="add_err3">
						<span> Este nombre de grupo ya existe</span>
			</div>
			</form>
			</div>
		<?php
		}
		?>
	</div>

	<?php  
		require ("pie.php");
	?>

</div> <!-- Fin del contenedor -->


</body>
</html>