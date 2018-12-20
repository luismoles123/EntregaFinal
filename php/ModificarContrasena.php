<!DOCTYPE html>
<html>
	<head>
		<meta name="tipo_contenido" content="text/html" http-equiv="content-type" charset="utf-8">
		<title>Preguntas</title>
		<link rel='stylesheet' type='text/css' href='../estilos/registro.css' />
	</head>
		<body>
			<div id="divForm" align="center">
				<h2>Rellene el formulario de registro</h2>
					<form id="fregistrar" name="fregistrar" method="post" action="ModificarContrasena.php">
						<div class="datosRegistro">
							<label>Introduzca su correo electrónico:*</label>
							<input type="text" id="corr" name="mail" class="datos" required>
							<br><br>
						</div>
					  
						<div class="datosRegistro">
							<label>Introduzca su contraseña antigua:*</label>
							<input type="password" id="oldPass" name="oldPass" class="datos" required>
							<br><br>
						</div>
					  
						<div class="datosRegistro">
							<label>Introduzca su nueva contraseña:*</label>
							<input type="password" id="newPass" name="newPass" class="datos" required>
							<br><br>
						</div>
					  
						<div class="datosRegistro">
							<label>Repita su nueva contraseña:*</label>
							<input type="password" id="newPass1" name="newPass1" class="datos" required>
							<br><br>
						</div>
				  
						<input type="submit" id="subm" name="subm" value="Registrarse">
					</form>
			</div>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"> </script>
			<script>
					
				   function validarCorreo(){
					  var correo=$("#corr").val();
					  var correoER= new RegExp("[a-z]*[0-9]{3}@ikasle.ehu.eus");
					  var test=correoER.test(correo);
					  return test;
					}
						
					$("#fregistrar").submit(function (){
						
						var correo=$("#corr").val();
						var old = $("#oldPass").val();
						var newPas = $("#newPass").val();
						var newPas1 = $("#newPass1").val();
						
						if(!validarCorreo()){
							 alert("El correo tiene que ser de la universidad")
						   return false;
						}
						
						if(newPas.length<8){
							alert("La contraseña debe contener al menos 8 carácteres")
							return false; 
						}
						if(newPas!=newPas1){
							alert("Las nuevas contraseñas no coinciden");
							return false;
						}
						  return true;
					});
			</script>
		<body>
	<?php
		include"ParametrosDB.php";
		$link = new mysqli($server, $user, $pass, $basededatos);
		if(isset($_POST["mail"]) && isset($_POST["oldPass"]) && isset($_POST["newPass"])){
			$em=$_POST["mail"];
			$oldPass=$_POST["oldPass"];
			$newPass=$_POST["newPass"];
			if ($link->connect_error) {
				die("La conexion falló: " . $link->connect_error);
			}
			$veri = "Select pass from usuarios where email  = '".$em."'";
			$result = mysqli_query($link, $veri);
			$row = mysqli_fetch_assoc($result);
			if(mysqli_num_rows ($result)==1){
				$hash1 = password_hash($newPass,PASSWORD_BCRYPT);
				if(($row['pass']==password_verify($oldPass,$row['pass']))){
					$sql2= mysqli_query($link, "UPDATE usuarios SET pass='$hash1' where email  = '".$em."'");
					echo "La contraseña ha sido cambiada correctamente";
				}
			 }
		}
		 mysqli_close($link);
	?>
</html>