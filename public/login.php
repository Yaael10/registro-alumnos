<?php
session_start();
if (isset($_SESSION['colaborador'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
      <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Login</h1>

    <?php if (isset($_GET['error'])): ?>
        <p style="color: red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <label for="correo">Correo:</label><br>
        <input type="email" id="correo" name="correo" required><br>

        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit" name="login">Iniciar Sesión</button>
    </form>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    require_once __DIR__ . '/../src/Controllers/AuthController.php';

    $correo = $_POST['correo'] ?? '';
    $password = $_POST['password'] ?? '';

    $auth = new AuthController();

    if ($auth->iniciarSesion($correo, $password)) {
        header("Location: index.php");
        exit;
    } else {
        header("Location: login.php?error=Correo+o+contraseña+inválidos");
        exit;
    }
}
