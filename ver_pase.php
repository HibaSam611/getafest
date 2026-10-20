<?php
include 'header.php';

if ($usuario_activo !== 'admin') {
    echo '<div class="card"><div class="error-msg">Acceso Restringido: Solo el usuario administrador puede ver los pases individuales.</div>';
    ?>
    <form action="ver_reservas.php" method="POST">
        <input type="hidden" name="usuario_activo" value="<?php echo htmlspecialchars($usuario_activo); ?>">
        <button type="submit" class="btn">Volver al listado</button>
    </form>
    </div></body></html>
    <?php
    exit();
}

$id_reserva = $_POST['id_reserva'] ?? null;

if ($id_reserva === null || !file_exists('reservas.txt')) {
    echo '<div class="card"><p>Reserva no encontrada.</p></div></body></html>';
    exit();
}

$lineas = file('reservas.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

if (!isset($lineas[$id_reserva])) {
    echo '<div class="card"><p>El ID de reserva indicado no existe.</p></div></body></html>';
    exit();
}

$reserva = explode('|', $lineas[$id_reserva]);

$fecha       = $reserva[0];
$nombre      = $reserva[1];
$email       = $reserva[2];
$edad        = $reserva[3];
$tipodepase  = $reserva[4];
$dias        = $reserva[5];
$pago        = $reserva[6];
$total       = $reserva[7];
$foto        = $reserva[8];
$comentario  = $reserva[9];
?>

<div id="tarjeta" class="card">
    <h2>Acreditación #<?php echo ($id_reserva + 1); ?> (Vista Administrador)</h2>

    <div id="foto" style="text-align: center; margin-bottom: 15px;">
        <img src="<?php echo htmlspecialchars($foto); ?>" alt="Foto" width="160" style="border-radius: 8px; border: 2px solid #6366f1;">
    </div>

    <h3><?php echo htmlspecialchars($nombre); ?></h3>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
    <p><strong>Edad:</strong> <?php echo htmlspecialchars($edad); ?> años</p>
    <p><strong>Tipo de Entrada:</strong> <?php echo htmlspecialchars($tipodepase); ?></p>
    <p><strong>Días de asistencia:</strong> <?php echo htmlspecialchars($dias); ?></p>
    <p><strong>Método de pago:</strong> <?php echo htmlspecialchars($pago); ?></p>
    <p><strong>Comentarios:</strong> <i>"<?php echo htmlspecialchars($comentario); ?>"</i></p>

    <h3 style="color: #6366f1; text-align: center; margin-top: 15px;">Total: <?php echo htmlspecialchars($total); ?></h3>

    <form action="ver_reservas.php" method="POST" style="margin-top: 20px;">
        <input type="hidden" name="usuario_activo" value="<?php echo htmlspecialchars($usuario_activo); ?>">
        <button type="submit" class="btn-secundario">← Volver al listado de reservas</button>
    </form>
</div>

</body>
</html>