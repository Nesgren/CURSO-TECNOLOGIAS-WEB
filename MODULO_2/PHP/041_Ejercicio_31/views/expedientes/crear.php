<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Expediente</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Crear Nuevo Expediente</h1>
        <form action="index.php?action=crear" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Información Personal</legend>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="apellido1">Primer Apellido:</label>
                <input type="text" id="apellido1" name="apellido1" required>

                <label for="apellido2">Segundo Apellido:</label>
                <input type="text" id="apellido2" name="apellido2">

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="actitud">Actitud:</label>
                <select id="actitud" name="actitud" required>
                    <option value="positiva">Positiva</option>
                    <option value="neutral">Neutral</option>
                    <option value="negativa">Negativa</option>
                </select>
            </fieldset>

            <fieldset>
                <legend>Idiomas y Actividades</legend>
                <label for="idiomas">Idiomas:</label>
                <input type="text" id="idiomas" name="idiomas[]" placeholder="Idioma 1">
                <input type="text" id="idiomas" name="idiomas[]" placeholder="Idioma 2">
                <input type="text" id="idiomas" name="idiomas[]" placeholder="Idioma 3">

                <label for="actividad">Actividades:</label>
                <input type="text" name="actividad[]" placeholder="Actividad 1">
                <input type="text" name="actividad[]" placeholder="Actividad 2">
                <input type="text" name="actividad[]" placeholder="Actividad 3">
            </fieldset>

            <fieldset>
                <legend>Subir Archivo</legend>
                <label for="archivo">Archivo (opcional):</label>
                <input type="file" id="archivo" name="uploadedFile" accept=".pdf,.doc,.docx">
                <div class="upload-file-info">Formato permitido: PDF, DOC, DOCX</div>
            </fieldset>

            <button type="submit" class="btn">Crear Expediente</button>
            <a href="index.php" class="btn">Cancelar</a>
        </form>
    </div>
</body>
</html>
