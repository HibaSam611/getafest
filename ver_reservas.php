<?php
include 'header.php';

if (empty($usuario_activo)) {
    header('Location: login.php');
    exit();
}

$reservas = [];
if (file_exists('reservas.txt')) {
    $reservas = file('reservas.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}
?>

<div class="container-wide">
    <div class="table-header">
        <h2>Listado de Reservas</h2>
        <form action="index.php" method="POST">
            <input type="hidden" name="usuario_activo" value="<?php echo htmlspecialchars($usuario_activo); ?>">
            <button type="submit" class="btn">+ Nueva Reserva</button>
        </form>
    </div>

    <?php if (empty($reservas)): ?>
        <p>No hay reservas registradas todavía.</p>
    <?php else: ?>
        <table class="tabla-reservas">
            <thead>
            <tr>
                <th>Fecha</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Edad</th>
                <th>Pase</th>
                <th>Pago</th>
                <th>Total</th>
                <th>Acción Admin</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($reservas as $index => $linea):
                $datos = explode('|', $linea);
                if (count($datos) < 10) continue;

                $id_reserva = $index;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($datos[0]); ?></td>
                    <td><?php echo htmlspecialchars($datos[1]); ?></td>
                    <td><?php echo htmlspecialchars($datos[2]); ?></td>
                    <td><?php echo htmlspecialchars($datos[3]); ?></td>
                    <td><?php echo htmlspecialchars($datos[4]); ?></td>
                    <td><?php echo htmlspecialchars($datos[6]); ?></td>
                    <td><strong><?php echo htmlspecialchars($datos[7]); ?></strong></td>
                    <td>
                        <form action="ver_pase.php" method="POST">
                            <input type="hidden" name="usuario_activo" value="<?php echo htmlspecialchars($usuario_activo); ?>">
                            <input type="hidden" name="id_reserva" value="<?php echo $id_reserva; ?>">
                            <button type="submit" class="btn-ver">Ver Pase</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

</body>
</html>