<?php
// AUTHOR: MOSQUERA VERGARA GEORGE ARIEL
// Verificación de sesión
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header('Location: index.php?app=user&action=login');
    exit();
}

require_once HEADER;
?>
<main class="container">
    <h1 style="font-size: 2rem; text-align: center; font-weight: bold; padding-left: 20px; margin: 20px 0;">Mis Traslados</h1>

    
    <form method="post" action="index.php?app=traslado&action=search" style="text-align: center; margin-bottom: 20px;">
        <input type="text" name="search" placeholder="Buscar por origen o destino" required>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <table class="table" id="trasladoTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Fecha de Recogida</th>
                <th>Hora de Recogida</th>
                <th>Cantidad de Pasajeros</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($traslados) && !empty($traslados)) { ?>
                <?php foreach ($traslados as $traslado) { ?>
                    <tr>
                        <td><?php echo $traslado->getId(); ?></td>
                        <td><?php echo $traslado->getOrigen(); ?></td>
                        <td><?php echo $traslado->getDestino(); ?></td>
                        <td><?php echo $traslado->getFechaRecogida(); ?></td>
                        <td><?php echo $traslado->getHoraRecogida(); ?></td>
                        <td><?php echo $traslado->getCantidadPasajeros(); ?></td>
                        <td><?php echo $traslado->getPrecio(); ?></td>
                        <td>
                            <a href="index.php?app=traslado&action=view_edit&id=<?php echo $traslado->getId(); ?>" class="btn btn-warning">Editar</a>
                            <a href="index.php?app=traslado&action=delete_traslado&id=<?php echo $traslado->getId(); ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este traslado?')">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="8" style="text-align: center;">No hay traslados disponibles.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>
<?php require_once FOOTER; ?>