<?php
require 'configuracion.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    // Validación básica
    if ($nombre === '') $errors[] = 'Nombre requerido.';
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) $errors[] = 'Correo inválido.';
    if (strlen($password) < 6) $errors[] = 'La contraseña debe tener al menos 6 caracteres.';
    if ($password !== $password_confirm) $errors[] = 'Las contraseñas no coinciden.';

    if (empty($errors)) {
        // Verificar correo único
        $stmt = $mysqli->prepare('SELECT contUsuario FROM usuarios WHERE correo = ?');
        $stmt->bind_param('s', $correo);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors[] = 'El correo ya está registrado.';
        } else {
            // Obtener el último código utilizado
            $stmt = $mysqli->query('SELECT MAX(contUsuario) AS max_cod FROM usuarios');
            $row = $stmt->fetch_assoc();
            $ultimo_codigo = $row['max_cod'];

            // Incrementar el código
            if ($ultimo_codigo === null) {
                $nuevo_codigo = 1; // Si no hay códigos, comenzamos con 1
            } else {
                $nuevo_codigo = intval($ultimo_codigo) + 1; // Incrementar el último código
            }

            // Formatear a 5 dígitos
            $codigo = str_pad($nuevo_codigo, 5, '0', STR_PAD_LEFT);

            $contraseña1 = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $mysqli->prepare('INSERT INTO usuarios (contUsuario, nombre, correo, contraseña) VALUES (?, ?, ?, ?)');
            $stmt->bind_param('isss', $codigo, $nombre, $correo, $contraseña1);
            $stmt->execute();

            // Auto-login simple
            $user_id = $mysqli->insert_id;  // Obtener el último ID insertado
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $nombre;
            header('Location: protegida.php');
            exit;
        }
        $stmt->close(); // Cerrar la declaración después de usarla
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f2f2f2;
        }
        .register-container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 20px;
        }
        input[type="text"],
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
    <div class="register-container">
        <h2>Registro</h2>
        <?php if (!empty($errors)): ?>
            <ul class="error">
                <?php foreach($errors as $e) echo "<li>" . htmlspecialchars($e) . "</li>"; ?>
            </ul>
        <?php endif; ?>
        <form method="post" action="">
            <input type="text" name="nombre" placeholder="Nombre" value="<?= htmlspecialchars($nombre ?? '') ?>" required>
            <input type="email" name="correo" placeholder="Correo" value="<?= htmlspecialchars($correo ?? '') ?>" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="password" name="password_confirm" placeholder="Confirmar contraseña" required>
            <button type="submit">Registrar</button>
        </form>
        <p><a href="login.php">¿Ya tienes cuenta? Entrar</a></p>
    </div>
</body>
</html>
