<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Resultado de Añadir Coche</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>	
	<pre>
	<?php
	$fichero = file_get_contents('coches.json');
	$coches = json_decode($fichero, true);
	echo '$coches antes de añadir:<br>';
	print_r($coches);

	$coche = array(
		'Marca' => $_POST['marca'],
		'Modelo' => $_POST['modelo'],
		'Año' => $_POST['ano'],
		'Color' => $_POST['color']
	);

	$coches[] = $coche;
	echo '$coches después de añadir un coche:<br>';
	print_r($coches);

	$cochesJSON = json_encode($coches, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
	file_put_contents("coches.json", $cochesJSON);
	?>
	</pre>
</body>
</html>
