<?php
//AUTHOR: Santacruz Salas Jostin Fabricio
include_once('../controller/ActividadesController.php');
$actividadesController = new ActividadesController();
$actividadesController->registrarActividad();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Actividad</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

    <h1>Registrar una Actividad Recreativa</h1>

    <form method="POST" action="">
        <label for="nombre">Nombre de la actividad:</label>
        <input type="text" name="nombre" required>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" required></textarea>

        <label for="ubicacion">Ubicación:</label>
        <input type="text" name="ubicacion" required>

        <label for="hora">Hora:</label>
        <input type="time" name="hora" required>

        <label for="precio">Precio:</label>
        <input type="text" name="precio" required>

        <label for="imagen">Imagen:</label>
        <input type="file" name="imagen">

        <button type="submit">Registrar Actividad</button>
    </form>

</body>
</html>
