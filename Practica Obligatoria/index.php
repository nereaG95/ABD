<!--Author: Nerea Gómez Domínguez-->
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Portada</title>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="scriptIndex.js"></script>
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
		if (isset($_SESSION['login']) && $_SESSION['login'] && isset($_SESSION['admin']) && ($_SESSION['admin'])){
			header('Location: admin.php');
		}
		if (isset($_SESSION['login']) && $_SESSION['login']) {
		?>
			<div id='cajaMensajes'>
			<!--Formulario para mensajes comunes -->
			<form action='insertaMensaje.php' method='post' name='formularioMen'>
			
			<p><h3>Enviar mensajes</h3> </p>
			<p> Tipo de mensaje: 
			<select id="opcion" name="opcion" id="opcion" onChange="mostrar(this.value);">
				<option value="comun"> Común </option> 
				<option value="personal"> Personal </option>
				<option value="grupo"> Grupal </option>
			</select>
			<div id="personal" style="display: none;">
				
				<?php
					$usuario = $_SESSION['idUser'];
					$sql = "SELECT idUser FROM usuarios WHERE idUser <> '$usuario'";
					$consul= mysqli_query($db, $sql);
					if(mysqli_num_rows($consul)==0){
						echo "<p>No puede enviar mensajes personales porque no hay contactos</p>";
					}
					else{
						echo "<p>Enviar a :";
						echo "<select name='receptor' id='receptor' class='select2'>";
						while ($resultado=mysqli_fetch_array($consul)){
							$valor = $resultado['idUser'];
							echo "<option value='".$resultado['idUser']."'>". $valor."</option>";
						}
						echo "</select></p>";
					}
				?>
			</div>
			
			<div id="grupal" style="display: none;">
				<?php
					$usuario = $_SESSION['idUser'];
					
					$sql="SELECT idGrupo FROM gruposusuario WHERE (idUser='$usuario')";
					$consulta=mysqli_query($db, $sql);
					if(mysqli_num_rows($consulta)==0){
						echo "<p>No puede enviar mensajes grupales, no pertences a ningun grupo</p>";
					}
					else{
						echo "<p>Grupo:";
						echo "<select name='grupo' id='grupo' class='select3'>";
						while ($lib=mysqli_fetch_array($consulta)){
							$id = $lib['idGrupo'];
							//Nombre del grupo
							$sql3="SELECT nombreGrupo FROM grupos WHERE idGrupo='$id'";
							$consul2 = mysqli_query($db, $sql3);
							$lib2=mysqli_fetch_assoc($consul2);
							$valor = $lib2['nombreGrupo'];
							echo "<option value='".$id."'> ".$valor ."</option>";
						}
						echo "</select>";
						echo "</p>";
						
					}
				?>
			</div>
			<textarea name="mensaje" id="mensaje" maxlength="250" rows="10" cols="30" placeholder="Escribe aqui tu mensaje" required></textarea>
			<input type='submit' id='botonsms' class='boton3' value='Enviar Mensaje'/>
			<div class="correcto" id="correcto">Su mensaje ha sido enviado correctamente</div>
			</form>
		</div>
		<?php
		}
		else{
		?>
			<div id='cajaBotones'>
			<button onclick="document.getElementById('id01').style.display='block'" class="boton">Inicia sesión</button>
			<button onclick="document.getElementById('id02').style.display='block'" class="boton">Registrate</button>
			</div>
			
			<div id="id01" class="modal">
			<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
			
			<form class="modal-content animate" method="post" id="loginform" action="procesaLogin.php">
			<div class="container">
					<label><b>Username: </b></label>
					<input type="text" name="name" id="name">

					<p><label><b>Password: </b></label>
					<input type="password" name="pass" id="pass"></p>

					<input type="submit" id="login" value="Login" class="boton2">
					<div class="error2" id="add_err">
						<span> Datos de ingreso no válidos, intentálo de nuevo</span>
					</div>
			</div>
			</form>
			</div>
			
			<div id="id02" class="modal">
			<span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
			<form class="modal-content animate" method="post" id="registraform" autocomplete="off" action="procesaRegistro.php">
			<div class="container">
					<label><b>Username : </b></label>
					<input type="text" name="user" id="user" required>
					<p><label><b>Password : </b></label>
					<input type="password" name="contra" id="contra" required></p>
					<p><label><b>Edad : </b></label>
					<input type="number" name="edad" min="5" max="130" id="edad" class="cajaEdad" required></p>
					<p><label><b> Tipo de musica: </b></label>
					<?php
						$sql = "SHOW COLUMNS FROM grupos LIKE 'tipoMusica'";
						$query = mysqli_query($db, $sql);
						$array = $query->fetch_array(MYSQLI_ASSOC);
						$parts = str_replace("enum(", '',$array['Type']); 
						$parts = explode(",", str_replace(")", '',$parts));
						foreach($parts as $key=>$value){
							$val = str_replace("'", '', $value);
							echo "<p><input type='checkbox' name='tipos[]' value='$val'>$val</input></p>";
						}
					?>
					</p>
					<input type="submit" id="registro" value="Registrate" class="boton2">
					<div class="error4" id="add_err2">
						<span> El nombre de usuario ya existe, intentelo de nuevo</span>
					</div>
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