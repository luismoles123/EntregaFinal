<?php
$xml = simplexml_load_file("../xml/preguntas.xml");
echo '<table border=1> <tr> <th> Correo </th> <th> Enunciado </th> <th> Respuesta Correcta</th>';
$ema=$_GET['email'];
$cont=0;
$cont1=0;
foreach($xml->xpath('//assessmentItem') as $assessmentItem){
	if($assessmentItem->attributes()->author==$ema){
		$cont++;
		echo '<tr><td>'.$assessmentItem->attributes()->author.'</td><td>'.$assessmentItem->itemBody->p.'</td><td>'.$assessmentItem->correctResponse->value.'</td><td>';
	}
}
echo '</table>';
echo "<br><br>";
echo "El numero de preguntas que has insertado es: $cont";

foreach($xml->xpath('//assessmentItem') as $assessmentItem){
	$cont1++;
}
echo "<br><br>";
echo "El numero de preguntas totales que se han insertado son: $cont1";
?>

