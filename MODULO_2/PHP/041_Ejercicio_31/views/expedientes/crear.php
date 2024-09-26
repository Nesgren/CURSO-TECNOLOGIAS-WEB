<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Expediente</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Crear Nuevo Expediente</h1>
    <form action="index.php?action=crear" method="POST" enctype="multipart/form-data">
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

        <label for="idiomas">Idiomas:</label>
        <input type="text" id="idiomas" name="idiomas[]" placeholder="Idioma 1">
        <input type="text" id="idiomas" name="idiomas[]" placeholder="Idioma 2">
        <input type="text" id="idiomas" name="idiomas[]" placeholder="Idioma 3">

        <label for="actividad">Actividades:</label>
        <input type="text" name="actividad[]" placeholder="Actividad 1">
        <input type="text" name="actividad[]" placeholder="Actividad 2">
        <input type="text" name="actividad[]" placeholder="Actividad 3">

        <label for="archivo">Subir Archivo:</label>
        <input type="file" id="archivo" name="uploadedFile" accept=".pdf,.doc,.docx">

        <button type="submit">Crear Expediente</button>
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>
