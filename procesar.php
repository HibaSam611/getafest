<?php
$usuario_activo = $_POST['usuario_activo'] ?? $_GET['usuario_activo'] ?? '';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit();
}

include 'header.php';

$nombre = $_POST['nombre'] ?? '';
$email = $_POST['email'] ?? '';
$edad = intval($_POST['edad'] ?? 0);
$tipodepase = $_POST['tipodepase'] ?? '';
$diaAsistencia = $_POST['diaAsistencia'] ?? [];
$pago = $_POST['pago'] ?? '';
$comentario = $_POST['comentario'] ?? 'Sin comentarios';

$errores = [];

if ($edad < 18) {
    $errores[] = "Acceso denegado: El evento es exclusivo para mayores de edad (18+).";
}

if (empty($diaAsistencia)) {
    $errores[] = "Debes seleccionar al menos un día de asistencia.";
}

$ruta_foto = "";
if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== 0) {
    $errores[] = "Error al subir la imagen.";
} else {
    $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ['jpg', 'jpeg', 'png'])) {
        $errores[] = "Solo se permiten formatos JPG, JPEG o PNG.";
    } else {
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }
        $nuevo_nombre = "user_" . uniqid() . "." . $ext;
        $ruta_foto = "uploads/" . $nuevo_nombre;
        move_uploaded_file($_FILES['foto']['tmp_name'], $ruta_foto);
    }
}

if (!empty($errores)) {
    echo '<div class="card"><div class="error-msg"><ul>';
    foreach ($errores as $err) {
        echo '<li>' . $err . '</li>';
    }
    echo '</ul></div>';
    ?>
    <form action="index.php" method="POST">
        <input type="hidden" name="usuario_activo" value="<?php echo htmlspecialchars($usuario_activo); ?>">
        <button type="submit" class="btn">Volver al formulario</button>
    </form>
    </div></body></html>
    <?php
    exit();
}

$precioBase = 0;
if ($tipodepase == "General") $precioBase = 50;
elseif ($tipodepase == "VIP") $precioBase = 120;
elseif ($tipodepase == "Super VIP") $precioBase = 180;

$suplemento = count($diaAsistencia) * 10;
$precioTotal = $precioBase + $suplemento;

$fecha = date('Y-m-d H:i:s');
$diasTexto = implode(', ', $diaAsistencia);

$linea_reserva = "$fecha|$nombre|$email|$edad|$tipodepase|$diasTexto|$pago|{$precioTotal}€|$ruta_foto|$comentario\n";

file_put_contents('reservas.txt', $linea_reserva, FILE_APPEND);

?>
<form id="gotoList" action="ver_reservas.php" method="POST">
    <input type="hidden" name="usuario_activo" value="<?php echo htmlspecialchars($usuario_activo); ?>">
</form>
<script>document.getElementById('gotoList').submit();</script>
</body>
</html>