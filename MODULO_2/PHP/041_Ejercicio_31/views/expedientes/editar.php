<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Expediente</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Editar Expediente</h1>
        <form action="index.php?action=editar&id=<?= $expediente->id ?>" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Información Personal</legend>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($expediente->nombre) ?>" required>

                <label for="apellido1">Primer Apellido:</label>
                <input type="text" id="apellido1" name="apellido1" value="<?= htmlspecialchars($expediente->apellido1) ?>" required>

                <label for="apellido2">Segundo Apellido:</label>
                <input type="text" id="apellido2" name="apellido2" value="<?= htmlspecialchars($expediente->apellido2) ?>">

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($expediente->email) ?>" required>

                <label for="actitud">Actitud:</label>
                <select id="actitud" name="actitud" required>
                    <option value="positiva" <?= $expediente->actitud == 'positiva' ? 'selected' : '' ?>>Positiva</option>
                    <option value="neutral" <?= $expediente->actitud == 'neutral' ? 'selected' : '' ?>>Neutral</option>
                    <option value="negativa" <?= $expediente->actitud == 'negativa' ? 'selected' : '' ?>>Negativa</option>
                </select>
            </fieldset>

            <fieldset>
                <legend>Idiomas y Actividades</legend>
                <label for="idiomas">Idiomas:</label>
                <?php 
                $idiomas = is_array($expediente->idiomas) ? $expediente->idiomas : json_decode($expediente->idiomas, true);
                foreach ($idiomas as $idioma): ?>
                    <input type="text" name="idiomas[]" value="<?= htmlspecialchars($idioma) ?>">
                <?php endforeach; ?>
                <input type="text" name="idiomas[]" placeholder="Agregar idioma extra">

                <label for="actividad">Actividades:</label>
                <?php 
                $actividades = is_array($expediente->actividades) ? $expediente->actividades : json_decode($expediente->actividades, true);
                foreach ($actividades as $actividad): ?>
                    <input type="text" name="actividad[]" value="<?= htmlspecialchars($actividad['nombre']) ?>">
                <?php endforeach; ?>
                <input type="text" name="actividad[]" placeholder="Agregar actividad extra">
            </fieldset>

            <fieldset>
                <legend>Subir Nuevo Archivo</legend>
                <label for="archivo">Archivo (opcional):</label>
                <input type="file" id="archivo" name="uploadedFile" accept=".pdf,.doc,.docx">
                <div class="upload-file-info">Formato permitido: PDF, DOC, DOCX</div>
            </fieldset>

            <button type="submit" class="btn">Guardar Cambios</button>
            <a href="index.php" class="btn">Cancelar</a>
        </form>
    </div>
</body>
</html>
