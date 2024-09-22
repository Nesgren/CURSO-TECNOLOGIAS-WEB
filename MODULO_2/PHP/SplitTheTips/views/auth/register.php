<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>
    <h1>Registro de Usuario</h1>

    <form action="../../controllers/UserController.php?action=register" method="POST">
        <label for="name">Nombre:</label>
        <input type="text" name="name" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>

        <label for="role">Rol:</label>
        <select name="role" required>
            <option value="admin">Administrador</option>
            <option value="employee">Empleado</option>
        </select>

        <button type="submit">Registrarse</button>
    </form>

    <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a>.</p>
</body>
</html>
