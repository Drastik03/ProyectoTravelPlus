
<?php
// AUTHOR: MOSQUERA VERGARA GEORGE ARIEL
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
        <h1 style="font-size: 2rem; text-align: center; font-weight: bold; margin-bottom: 20px;">Reserva tu Traslado</h1>
        <form method="post" action="index.php?app=traslado&action=register_traslado" enctype="multipart/form-data" novalidate>
            <div class="form-group">
                <label for="origen" class="required">Origen</label>
                <input type="text" id="origen" name="origen" placeholder="Aeropuerto, dirección, etc." required>
                <span class="error-message">Este campo es obligatorio</span>
            </div>
            <div class="form-group">
                <label for="destino" class="required">Destino</label>
                <input type="text" id="destino" name="destino" placeholder="Aeropuerto, dirección, etc." required>
                <span class="error-message">Este campo es obligatorio</span>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="fecha_recogida" class="required">Fecha de Recogida</label>
                    <input type="date" id="fecha_recogida" name="fecha_recogida" required>
                    <span class="error-message">Seleccione una fecha válida</span>
                </div>
                <div class="form-group">
                    <label for="hora_recogida" class="required">Hora de Recogida</label>
                    <input type="time" id="hora_recogida" name="hora_recogida" required>
                    <span class="error-message">Ingrese la hora de recogida</span>
                </div>
            </div>
            <div class="form-group">
                <label for="cantidad_pasajeros" class="required">Cantidad de Pasajeros</label>
                <input type="number" id="cantidad_pasajeros" name="cantidad_pasajeros" min="1" value="1" required>
                <span class="error-message">Ingrese un número válido</span>
            </div>
            <div class="form-group">
                <label for="precio" class="required">Precio</label>
                <input type="number" id="precio" name="precio" placeholder="Precio del traslado (USD)" step="0.01" required>
                <span class="error-message">Ingrese un precio válido</span>
            </div>
            <div class="actions" style="text-align: center; margin-top: 20px;">
                <button type="reset" class="btn-secondary" style="margin-right: 10px; padding: 10px 20px; border: none; background: #ccc; color: black; border-radius: 5px; cursor: pointer;">Limpiar</button>
                <button type="submit" class="btn-primary" style="padding: 10px 20px; border: none; background: #007bff; color: white; border-radius: 5px; cursor: pointer;">Registrar Traslado</button>
            </div>
        </form>
        <div class="actions" style="text-align: center; margin-top: 20px;">
            <a href="index.php?app=traslado&action=view_new" class="btn-secondary" style="padding: 10px 20px; background: #28a745; color: white; text-decoration: none; border-radius: 5px; display: inline-block;">Ver Lista</a>
        </div>
    </div>
</main>

<?php require_once FOOTER; ?>