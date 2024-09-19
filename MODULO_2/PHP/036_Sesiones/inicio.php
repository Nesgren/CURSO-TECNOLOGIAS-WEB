<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="estilos.css">
	</head>
	<body>
    <?php
	require("identificacion.php");
	echo "<p class=success>¡¡Felicidades ".$_SESSION['username'].", está identificado!!</p>";
	?>		
	</body>
</html>