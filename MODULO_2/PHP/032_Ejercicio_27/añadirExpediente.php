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
    <form action="expedientes.php" method="post" enctype="multipart/form-data">
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
            <div class="actividad">
                <label>Nombre del Ejercicio:</label>
                <input type="text" name="actividad[0][nombre]" required><br>
                
                <label>Nota:</label>
                <select name="actividad[0][nota]" required>
                    <option value="">Selecciona una nota</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select><br>
                
                <label>Comentario:</label>
                <textarea name="actividad[0][comentario]"></textarea><br>
            </div>
            <div class="actividad">
                <label>Nombre del Ejercicio:</label>
                <input type="text" name="actividad[1][nombre]" required><br>
                
                <label>Nota:</label>
                <select name="actividad[1][nota]" required>
                    <option value="">Selecciona una nota</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select><br>
                
                <label>Comentario:</label>
                <textarea name="actividad[1][comentario]"></textarea><br>
            </div>
            <div class="actividad">
                <label>Nombre del Ejercicio:</label>
                <input type="text" name="actividad[2][nombre]" required><br>
                
                <label>Nota:</label>
                <select name="actividad[2][nota]" required>
                    <option value="">Selecciona una nota</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select><br>
                
                <label>Comentario:</label>
                <textarea name="actividad[2][comentario]"></textarea><br>
            </div>
        </fieldset>

        <fieldset>
            <legend>Actitud del Alumno en Clase</legend>
            <label>
                <input type="radio" name="actitud" value="Buena" required> Buena
            </label>
            <label>
                <input type="radio" name="actitud" value="Normal" required> Normal
            </label>
            <label>
                <input type="radio" name="actitud" value="Mala" required> Mala
            </label>
        </fieldset>

        <fieldset>
            <legend>Idiomas que Habla</legend>
            <label>
                <input type="checkbox" name="idiomas[]" value="Catalan"> Catalán
            </label>
            <label>
                <input type="checkbox" name="idiomas[]" value="Castellano"> Castellano
            </label>
            <label>
                <input type="checkbox" name="idiomas[]" value="Frances"> Francés
            </label>
            <label>
                <input type="checkbox" name="idiomas[]" value="Ingles"> Inglés
            </label>
        </fieldset>

        <fieldset>
            <legend>Subida de Archivos</legend>
            <label for="uploadedFile">Sube un Archivo:</label>
            <input type="file" id="uploadedFile" name="uploadedFile" /><br>
        </fieldset>

        <input type="submit" name="uploadBtn" value="Enviar" class="enviar">
        <a href="index.php" class="btn">Ver Expedientes</a>
    </form>
</body>
</html>
