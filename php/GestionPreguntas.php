<?php
ob_start();
session_start();
if(!isset($_SESSION["email"])){
    header("location:Seguridad.php");
}
if(strpos($_SESSION["email"], "ehu.eus")==false){
    header("location: Seguridad.php");
}
?>
<html>
	<head>
		<meta name="tipo_contenido" content="text/html" http-equiv="content-type" charset="utf-8">
		<title>Preguntas</title>
		<link rel='stylesheet' type='text/css' href='../estilos/Pregunta.css' />
	</head>
	<body>
	
		<?php
			$email = $_GET['email'];
		?>
		<div id="divForm" align="center"> 
			<h2>EDITAR PREGUNTA</h2>
			<form id="fpreguntas" name="fpreguntas" method="post">
				  
				<div class="datosRegistro">
					<label>Introduzca el enunciado de la pregunta:*</label>
					<input type="text" id="enun" name="enunc" class="datos">
					<br><br>
				</div>
				
				<div class="datosRegistro">
					<label>Respuesta correcta:*</label>
					<input type="text" id="resp" name="respu" class="datos">
					<br><br>
				</div>
				  	
				<div class="datosRegistro">
					<label>Complejidad (0-5):*</label>
					<input type="number" id="comp" name="compl" class="datos">
					<br><br>
				</div>
				
				<div class="datosRegistro">
					<label>Tema de la pregunta:*</label>
					<input type="text" id="tem" name="tema" class="datos">
					<br><br>
				</div>
				<input type="button" id="subm" name="subm" value="Ver Preguntas" onclick="pedirDatos()">
				<input type="button" id="subm1" name="subm" value="Insertar Pregunta" onclick="pedirDatos1()">
			</form>
		</div>
		
		<div align="center" id="resultado" style="background-color:blue">
			<p>Aqui aparecera texto</p>
		</div> 
			
		<script language = "javascript">
			XMLHttpRequestObject = new XMLHttpRequest();
			XMLHttpRequestObject.onreadystatechange = function()
			{
			if (XMLHttpRequestObject.readyState==4)
			{var obj = document.getElementById('resultado');
			obj.innerHTML = XMLHttpRequestObject.responseText;}
			}
			var jsVar = "<?php echo $email; ?>";
			
			function pedirDatos()
			{
			XMLHttpRequestObject.open("GET",'VerPreguntasXML.php?email='+jsVar);
			XMLHttpRequestObject.send(null);
			}
			
			function pedirDatos1()
			{
			var en = document.getElementById('enun').value;
			var re = document.getElementById('resp').value;
			var comp = document.getElementById('comp').value;
			var te = document.getElementById('tem').value;
			XMLHttpRequestObject.open("GET",'InsertarPreguntaGestion.php?email='+jsVar+'&enunc='+en+'&respu='+re+'&compl='+comp+'&tema='+te);
			XMLHttpRequestObject.send(null);
			}
			
		</script>
	</body>
</html>
<?php
ob_end_flush();
?>