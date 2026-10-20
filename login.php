<?php
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['usuario'] ?? '';
    $pass = $_POST['password'] ?? '';

    if (!file_exists('usuarios.txt')) {
        $error = "Error: No existe el archivo usuario.txt";
    } else {
        $lineas = file('usuarios.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $login_correcto = false;

        foreach ($lineas as $linea) {
            list($u, $p) = explode(':', trim($linea));
            if ($u === $user && $p === $pass) {
                $login_correcto = true;
                break;
            }
        }

        if ($login_correcto) {
            ?>
            <form id="redirectForm" action="index.php" method="POST">
                <input type="hidden" name="usuario_activo" value="<?php echo htmlspecialchars($user); ?>">
            </form>
            <script>document.getElementById('redirectForm').submit();</script>
            <?php
            exit();
        } else {
            $error = "Usuario o contraseña incorrectos.";
        }
    }
}
include 'header.php';
?>

<div class="card">
    <h2>Iniciar Sesión</h2>

    <?php if (!empty($error)): ?>
        <div class="error-msg"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <div class="form-group">
            <label>Usuario:</label>
            <input type="text" name="usuario" required placeholder="Ingresa tu usuario">
        </div>
        <div class="form-group">
            <label>Contraseña:</label>
            <input type="password" name="password" required placeholder="Ingresa tu contraseña">
        </div>
        <button type="submit" class="btn">Entrar al Sistema</button>
    </form>
</div>

</body>
</html>