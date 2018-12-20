<?php
ob_start();
session_start();
if(!isset($_SESSION['email'])){
    header("location: Seguridad.php");
}
if(strpos($_SESSION["email"], "ehu.es")==false){
    header("location: Seguridad.php");
}
include "ParametrosDB.php";
    $link = new mysqli($server, $user, $pass, $basededatos);
    if($link->connect_error){
        die("La conexión falló:" . $link->connect_error);
    }
    
    $dat= mysqli_query($link, "select * from usuarios");
    
    echo "<table border=1>";  
    echo "<tr>";  
    echo "<th>Nombre</th>";  
    echo "<th>Correo</th>";  
    echo "<th>Password</th>";
	echo "<th>Estado</th>";
    echo "</tr>"; 
    
while ($row = mysqli_fetch_array($dat)){   
	$var=$row['email'];
	$est=$row['estado'];
    echo "<tr>";  
    echo "<td>".$row['nombre']."</td>";  
    echo "<td>".$row['email']."</td>";  
    echo "<td>".$row['pass']."</td>";   
	echo "<td>".$row['estado']."</td>";
	echo "<td> <input type='button' onclick=cambiarEstado('$var','$est') value='Cambiar Estado'> </td>";
	echo "<td> <input type='button' onclick=eliminar('$var') value='Eliminar'/> <td>";
    echo "</tr>"; 
}

$dat->close();
mysqli_close($link);
echo "</table>";  
?> 

<script>
function cambiarEstado(correo,est){
	document.location='CambiarEstado.php?email='+correo+'&estado='+est;
}

function eliminar(correo){
	document.location='EliminarCuenta.php?email='+correo;
}
</script>
<?php 
ob_end_flush();
?>