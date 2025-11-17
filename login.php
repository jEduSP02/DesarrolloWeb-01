<?php
require 'configuracion.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = trim($_POST['correo'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) $errors[] = 'Correo inválido.';
    if ($password === '') $errors[] = 'Contraseña requerida.';

    if (empty($errors)) {
        // Preparar y ejecutar la consulta
        $stmt = $mysqli->prepare('SELECT contraseña FROM usuarios WHERE correo = ?');
        $stmt->bind_param('s', $correo);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($stored_password);
        $stmt->fetch();

        if ($stored_password && password_verify($password, $stored_password)) {
            // La contraseña coincide, se puede iniciar sesión
            $stmt->close(); 

            $stmt = $mysqli->prepare('SELECT contUsuario, nombre FROM usuarios WHERE correo = ?');
            $stmt->bind_param('s', $correo);
            $stmt->execute();
            $stmt->bind_result($user_id, $user_name);
            $stmt->fetch();

            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            header('Location: index.php');
            exit;
        } else {
            $errors[] = 'Credenciales inválidas.';
        }
        $stmt->close(); // Cerrar el stmt después de usarlo
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f2f2f2;
        }
        .login-container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 20px;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #5cb85c;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #4cae4c;
        }
        .error {
            color: red;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <?php if(!empty($errors)): ?>
            <ul class="error">
                <?php foreach($errors as $e) echo "<li>" . htmlspecialchars($e) . "</li>"; ?>
            </ul>
        <?php endif; ?>
        <form method="post" action="">
            <input type="email" name="correo" placeholder="Correo" value="<?= htmlspecialchars($correo ?? '') ?>" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Entrar</button>
        </form>
        <p><a href="registro.php">Aún no tienes una cuenta
