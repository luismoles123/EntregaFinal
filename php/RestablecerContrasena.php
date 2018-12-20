<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Preguntas</title>
    <link rel='stylesheet' type='text/css' href='../estilos/login.css' />
  </head>
  <body>
	<div id="divIniSes">
		<form class="flogin" action="RestablecerContrasena.php" method="post">
			<h2 class="h2">Restablecer contraseña</h2>
			<div class="datosLogin">
				<label> Introduce tu email: </label>
				<input type="email" name="email" size="21" class="IniSes"/>
			</div>
			
			<input type="submit" id="subm" value="Restablecer contraseña">
		</form>
	</div>
	</body>
</html>
<?php
	include "ParametrosDB.php";
	if(isset($_POST["email"])){
		$email=$_POST["email"];
		$link = new mysqli($server, $user, $pass, $basededatos);
			 if ($link->connect_error) {
				die("La conexion falló: " . $link->connect_error);
			 } 
			$veri = "Select * from usuarios where email  = '".$email."'";
			$result = mysqli_query($link, $veri);
			$row = mysqli_fetch_assoc($result);
			   if(mysqli_num_rows ($result)!=1){
					die("Ese usuario no está registrado");
				}
			
		$subject="Recuperar contraseña";
		$codigo=rand(10000,99999);
		
		$_SESSION["code"]=$codigo;
		$_SESSION["mail"]=$email;
		$message="
			<html>
			<head>
			<title>Recuperar contraseña</title>
			</head>
			<body>
			<h3> Sigue los siguientes pasos para recuperar tu contraseña </h3>
			<ol>
				<li> Entrar en el link proporcionado en el correo</li>
				<li>Introduce el codigo proporcionado junto con la contraseña</li>
				<li> Si todo sucede correctamente, tu contraseña habrá sido restablecida</li>
			</ol>
			<h3> Link para recuperar la contraseña</h3>
			<h2><a href='RecuperarContrasenaCodigo.php?email=".$email."'>Clicka aquí</a></h2>
			<h3>Codigo de recuperación</h3>
			<h2> ".$codigo."</h2>
			</body>
			</html>
			";
			
		$headers="MIME-Version:1.0"."\r\n";
		$headers .= "Content-type:text/html:charset=iso-8859-1"."\r\n";
		$headers .= "To: Usuario <'.$email.'>"."\r\n";
		$headers .= "From: Recuperar Password <'.admin@ehu.es.'>"."\r\n";
		mail($email,$subject,$message,$headers);
		
		echo "El e-mail se ha enviado correctamente";
	}
?>

	
	
	
	
	
	
	
	
	
	