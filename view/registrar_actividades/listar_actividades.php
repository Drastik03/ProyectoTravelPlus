<?php
//AUTHOR: Santacruz Salas Jostin Fabricio
include_once('../controller/ActividadesController.php');
$actividadesController = new ActividadesController();
$actividades = $actividadesController->listarActividades();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Actividades</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

    <h1>Catálogo de Actividades Recreativas</h1>

    <table>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Ubicación</th>
            <th>Hora</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>

        <?php
        foreach ($actividades as $actividad) {
            echo "<tr>";
            echo "<td>" . $actividad->nombre_actividad . "</td>";
            echo "<td>" . $actividad->descripcion . "</td>";
            echo "<td>" . $actividad->ubicacion . "</td>";
            echo "<td>" . $actividad->hora . "</td>";
            echo "<td>" . $actividad->precio . "</td>";
            echo "<td>
                    <a href='../controller/ActividadesController.php?accion=editar&id=" . $actividad->id . "'>Editar</a> | 
                    <a href='../controller/ActividadesController.php?accion=eliminar&id=" . $actividad->id . "'>Eliminar</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>

</body>
</html>
