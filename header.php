<?php
$usuario_activo = $_POST['usuario_activo'] ?? $_GET['usuario_activo'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Getafest V2.0</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<header>
    <h1>getafeFest 2026</h1>
    <p>Sistema Oficial de Reserva y Acreditación Digital</p>
    <?php if (!empty($usuario_activo)): ?>
        <p class="user-badge">Usuario activo: <strong><?php echo htmlspecialchars($usuario_activo); ?></strong></p>
    <?php endif; ?>
</header>