<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Expediente de Alumnos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Formulario de Expediente de Alumnos</h1>
    <form action="send_mail.php" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Datos Personales</legend>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br>
            
            <label for="apellido1">Primer Apellido:</label>
            <input type="text" id="apellido1" name="apellido1" required><br>
            
            <label for="apellido2">Segundo Apellido:</label>
            <input type="text" id="apellido2" name="apellido2"><br>

            <label for="email">Enviar Correo Electrónico:</label>
            <input type="email" id="email" name="email" required><br>
        </fieldset>

        <fieldset>
            <legend>Actividades</legend>
            <?php for ($i = 0; $i < 3; $i++): ?>
            <div class="actividad">
                <label>Nombre del Ejercicio:</label>
                <input type="text" name="actividad[<?php echo $i; ?>][nombre]" required><br>
                
                <label>Nota:</label>
                <input type="number" name="actividad[<?php echo $i; ?>][nota]" min="0" max="10" required><br>
                
                <label>Comentario:</label>
                <textarea name="actividad[<?php echo $i; ?>][comentario]"></textarea><br>
            </div>
            <?php endfor; ?>
        </fieldset>

        <fieldset>
            <legend>Actitud del Alumno en Clase</legend>
            <label><input type="radio" name="actitud" value="Buena" required> Buena</label>
            <label><input type="radio" name="actitud" value="Normal" required> Normal</label>
            <label><input type="radio" name="actitud" value="Mala" required> Mala</label>
        </fieldset>

        <fieldset>
            <legend>Idiomas que Habla</legend>
            <label><input type="checkbox" name="idiomas[]" value="Catalan"> Catalán</label>
            <label><input type="checkbox" name="idiomas[]" value="Castellano"> Castellano</label>
            <label><input type="checkbox" name="idiomas[]" value="Frances"> Francés</label>
            <label><input type="checkbox" name="idiomas[]" value="Ingles"> Inglés</label>
        </fieldset>

        <fieldset>
            <legend>Subida de Archivos</legend>
            <span>Sube una foto:</span>
            <input type="file" id="uploadedFile" name="uploadedFile" accept="image/*" required><br>
        </fieldset>

        <input type="submit" name="uploadBtn" value="Enviar">
    </form>

    <?php
    session_start();
    if (isset($_SESSION['photoPath'])) {
        echo '<h2>Vista previa de la foto:</h2>';
        echo '<img src="' . $_SESSION['photoPath'] . '" alt="Foto del Alumno" style="max-width: 200px;">';
        unset($_SESSION['photoPath']);
    }
    ?>
</body>
</html>
