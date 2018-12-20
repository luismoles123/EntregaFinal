<?php
	include "ParametrosDB.php";
	if(isset($_POST['email'])){
		 $link = new mysqli($server, $user, $pass, $basededatos) or die(mysqli_connect_error());
		 $email=$_POST['email']; 
		 $password=$_POST['pass'];
		 $veri1 = "Select * from usuarios where email  = '".$email."'";
         $result = mysqli_query($link, $veri1);
		 $cont= mysqli_fetch_assoc($result); //Se verifica el total de filas devueltas
		 mysqli_close($link); //cierra la conexion
		if($cont){
			if(($cont['pass'] == password_verify($password,$cont['pass']))){
				session_start();
				$_SESSION["email"]=$email;
				echo("<script> alert ('BIENVENIDO AL SISTEMA:". $_SESSION["email"] . "')</script>");
				if(strpos($email, 'ehu.es') !== false){
					echo ("Login correcto como administrador<p> <a href='layout.php?email=$email'>Ya puede gestionar las cuentas</a></p>");
				}else{
					echo ("Login correcto como alumno<p> <a href='layout.php?email=$email'>Ya puede gestionar preguntas</a></p>");
				}
			}else{
				echo ("El usuario y la contraseña no coinciden<p><a href='../Html/Login.html'>Puede intentarlo de nuevo</a>");
			}
		}else{
			echo ("Usuario inexistente<p><a href='../Html/Login.html'>Puede intentarlo de nuevo</a>");
		}
	}
?>