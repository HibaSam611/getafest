<?php
include 'header.php';

// Si no hay usuario activo, mandamos a login
if (empty($usuario_activo)) {
    header('Location: login.php');
    exit();
}
?>

<div class="getafest">
    <h2>Reserva tu Pase</h2>

    <form action="ver_reservas.php" method="POST" style="margin-bottom: 20px;">
        <input type="hidden" name="usuario_activo" value="<?php echo htmlspecialchars($usuario_activo); ?>">
        <button type="submit" class="btn-secundario">📋 Ver Listado de Reservas</button>
    </form>

    <form action="procesar.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="usuario_activo" value="<?php echo htmlspecialchars($usuario_activo); ?>">

        <div class="form-group">
            <label>Nombre completo:</label>
            <input type="text" name="nombre" required placeholder="Ej: Hiba Samraoui">
        </div>

        <div class="form-group">
            <label>Correo electrónico:</label>
            <input type="email" name="email" required placeholder="Ej: micorreo@correo.com">
        </div>

        <div class="form-group">
            <label>Edad:</label>
            <input type="number" name="edad" min="1" required placeholder="Ej: 18">
        </div>

        <div class="form-group">
            <label>Tipo de pase:</label><br>
            <label><input type="radio" name="tipodepase" value="General" checked> General (50€)</label>
            <label><input type="radio" name="tipodepase" value="VIP"> VIP (120€)</label>
            <label><input type="radio" name="tipodepase" value="Super VIP"> Super VIP + Camping (180€)</label>
        </div>

        <div class="form-group">
            <label>Días de asistencia (+10€ por día):</label><br>
            <label><input type="checkbox" name="diaAsistencia[]" value="Viernes"> Viernes</label>
            <label><input type="checkbox" name="diaAsistencia[]" value="Sábado"> Sábado</label>
            <label><input type="checkbox" name="diaAsistencia[]" value="Domingo"> Domingo</label>
        </div>

        <div class="form-group">
            <label>Método de pago:</label>
            <select name="pago" required>
                <option value="Bizum">Bizum</option>
                <option value="Tarjeta de crédito">Tarjeta de crédito</option>
                <option value="PayPal">PayPal</option>
            </select>
        </div>

        <div class="form-group">
            <label>Foto para la acreditación (jpg/png):</label>
            <input type="file" name="foto" required>
        </div>

        <div class="form-group">
            <label>Comentarios o peticiones especiales:</label>
            <input type="text" name="comentario">
        </div>

        <input type="submit" name="enviar" class="btn" value="Guardar Reserva">
    </form>
</div>

</body>
</html>