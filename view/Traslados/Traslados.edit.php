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
<main class="container" style="background-image: url('assets/traslados.jpg'); background-size: cover; background-position: center; height: 100vh; display: flex; justify-content: center; align-items: center;">
    <div style="background-color: rgba(0, 0, 0, 0.7); padding: 20px; border-radius: 10px; max-width: 500px; width: 100%; color: white;">
        <h1 style="font-size: 2rem; text-align: center; font-weight: bold; margin-bottom: 20px;">Editar Traslado</h1>

        <form method="post" action="index.php?app=traslado&action=edit" novalidate>
            <input type="hidden" name="id" value="<?php echo $traslado->getId(); ?>">

            <div class="form-group">
                <label for="origen" class="required">Origen</label>
                <input type="text" id="origen" name="origen" value="<?php echo htmlspecialchars($traslado->getOrigen()); ?>" required>
                <span class="error-message">Este campo es obligatorio</span>
            </div>

            <div class="form-group">
                <label for="destino" class="required">Destino</label>
                <input type="text" id="destino" name="destino" value="<?php echo htmlspecialchars($traslado->getDestino()); ?>" required>
                <span class="error-message">Este campo es obligatorio</span>
            </div>

            <div class="form-group">
                <label for="fecha_recogida" class="required">Fecha de Recogida</label>
                <input type="date" id="fecha_recogida" name="fecha_recogida" value="<?php echo htmlspecialchars($traslado->getFechaRecogida()); ?>" required>
                <span class="error-message">Este campo es obligatorio</span>
            </div>

            <div class="form-group">
                <label for="hora_recogida" class="required">Hora de Recogida</label>
                <input type="time" id="hora_recogida" name="hora_recogida" value="<?php echo htmlspecialchars($traslado->getHoraRecogida()); ?>" required>
                <span class="error-message">Este campo es obligatorio</span>
            </div>

            <div class="form-group">
                <label for="cantidad_pasajeros" class="required">Cantidad de Pasajeros</label>
                <input type="number" id="cantidad_pasajeros" name="cantidad_pasajeros" value="<?php echo htmlspecialchars($traslado->getCantidadPasajeros()); ?>" required>
                <span class="error-message">Este campo es obligatorio</span>
            </div>

            <div class="form-group">
                <label for="precio" class="required">Precio</label>
                <input type="number" id="precio" name="precio" value="<?php echo htmlspecialchars($traslado->getPrecio()); ?>" required>
                <span class="error-message">Este campo es obligatorio</span>
            </div>

            <div class="actions" style="text-align: center; margin-top: 20px;">
                <button type="reset" class="btn-secondary" style="margin-right: 10px; padding: 10px 20px; border: none; background: #ccc; color: black; border-radius: 5px; cursor: pointer;">Limpiar</button>
                <button type="submit" class="btn-primary" style="padding: 10px 20px; border: none; background: #007bff; color: white; border-radius: 5px; cursor: pointer;">Actualizar</button>
            </div>
        </form>
    </div>
</main>
<?php require_once FOOTER; ?>