<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulario de Coches</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>    
    <form action="anadirCoche.php" method="post">
        <label>Marca:</label> 
        <input type="text" name="marca" required> 
        <label>Modelo:</label> 
        <input type="text" name="modelo" required> 
        <label>Año:</label> 
        <input type="number" name="ano" required> 
        <label>Color:</label> 
        <input type="text" name="color" required> 
        <input type="submit" value="Añadir coche">
    </form>
</body>
</html>
