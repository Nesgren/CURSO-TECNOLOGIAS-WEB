<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Expediente</title>
    <link rel="stylesheet" href="https://franco.104cubes.com/MODULO_2/PHP/041_Ejercicio_31/css/styles.css">
</head>
<body>
    <h1>Crear Expediente</h1>
    <div class="container">
        <form action="index.php?action=crear" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Datos Personales</legend>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" required>
                <br>

                <label for="apellido1">Primer Apellido:</label>
                <input type="text" name="apellido1" required>
                <br>

                <label for="apellido2">Segundo Apellido:</label>
                <input type="text" name="apellido2">
                <br>

                <label for="email">Correo Electrónico:</label>
                <input type="email" name="email" required>
                <br>
            </fieldset>

            <fieldset>
                <legend>Actividad 1</legend>
                <div class="actividad">
                    <label>Nombre del Ejercicio:</label>
                    <input type="text" name="actividad[0][nombre]" required>
                    <br>

                    <label>Nota:</label>
                    <select name="actividad[0][nota]" required>
                        <option value="">Selecciona una nota</option>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <option value="<?= $i; ?>"><?= $i; ?></option>
                        <?php endfor; ?>
                    </select>
                    <br>

                    <label>Comentario:</label>
                    <textarea name="actividad[0][comentario]"></textarea>
                    <br>
                </div>
            </fieldset>
            <fieldset>
                <legend>Actividad 2</legend>
                <div class="actividad">
                    <label>Nombre del Ejercicio:</label>
                    <input type="text" name="actividad[1][nombre]" required>
                    <br>

                    <label>Nota:</label>
                    <select name="actividad[1][nota]" required>
                        <option value="">Selecciona una nota</option>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <option value="<?= $i; ?>"><?= $i; ?></option>
                        <?php endfor; ?>
                    </select>
                    <br>

                    <label>Comentario:</label>
                    <textarea name="actividad[1][comentario]"></textarea>
                    <br>
                </div>
            </fieldset>    
            <fieldset>
                <legend>Actividad 3</legend>
                <div class="actividad">
                    <label>Nombre del Ejercicio:</label>
                    <input type="text" name="actividad[2][nombre]" required>
                    <br>

                    <label>Nota:</label>
                    <select name="actividad[2][nota]" required>
                        <option value="">Selecciona una nota</option>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <option value="<?= $i; ?>"><?= $i; ?></option>
                        <?php endfor; ?>
                    </select>
                    <br>

                    <label>Comentario:</label>
                    <textarea name="actividad[2][comentario]"></textarea>
                    <br>
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
                <input type="file" id="uploadedFile" name="uploadedFile" accept="image/*">
            </fieldset>

            <button type="submit">Crear Expediente</button>
            <a href="index.php" class="btn">Volver a la lista</a>
        </form>
    </div>
</body>
</html>