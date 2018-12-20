<html>
	<head>
		<meta name="tipo_contenido" content="text/html" http-equiv="content-type" charset="utf-8">
		<title>Restablecer Contraseña</title>
		<link rel='stylesheet' type='text/css' href='../estilos/registro.css' />
	</head>
		<body>
			<div id="divForm" align="center">
				<h2>Rellene el formulario de restablecimiento</h2>
					<form id="frestablecer" name="frestablecer" method="post" action="../Html/Login.html">
						<div class="datosRegistro">
							<label>E-mail:*</label>
							<input type="text" id="corr" name="mail" class="datos" required>
							<br><br>
						</div>
					  
						<div class="datosRegistro">
							<label>Introduzca Codigo de recuperación:*</label>
							<input type="text" id="nom" name="nom" class="datos" required>
							<br><br>
						</div>
					  
						<div class="datosRegistro">
							<label>Introduzca su nueva contraseña:*</label>
							<input type="password" id="pass" name="pass" class="datos" required>
							<br><br>
						</div>
					  
						<div class="datosRegistro">
							<label>Repetir nueva contraseña:*</label>
							<input type="password" id="pass1" name="pass1" class="datos" required>
							<br><br>
						</div>
				  
						<input type="submit" id="subm" name="subm" value="Restablecer">
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
				
				$("#frestablecer").submit(function (){
                    
                    var correo=$("#corr").val();
                    var contr = $("#pass").val();
                    var repContr = $("#pass1").val();
                    
                    if(!validarCorreo()){
                         alert("El correo tiene que ser de la universidad")
                       return false;
                    }
					
                    if(contr.length<8){
                        alert("La contraseña debe contener al menos 8 carácteres")
                        return false; 
                    }
                    if(contr!=repContr){
						alert("Las contraseñas no coinciden");
						return false;
					}
					
                      return true;
                });
        </script>
	</body>
	</html>
	<?php
	
	if (isset($_POST["mail"])){
		if(empty($_POST["pass"])){
		   die("Error");	
		}else{
			 $email = $_SESSION['mail'];
			 
			 $link = new mysqli($server, $user, $pass, $basededatos);
			 if ($link->connect_error) {
				die("La conexion falló: " . $link->connect_error);
			 } 
			$veri = "UPDATE usuarios SET password=password_hash($password,PASSWORD_BCRYPT) where email  = '".$email."'";
			$result = mysqli_query($link, $veri);
			$row = mysqli_fetch_assoc($result);
			   if(mysqli_num_rows ($result)==1){
					die("El usuario ya está registrado");
				}
			
				mysqli_close($link);						
		}
	}
}else{
	echo "La contraseña no es valida";
}
	}
} 