<?php require_once HEADER; ?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<main class="container">
    <h1 style="font-size: 2rem; text-align: center; font-weight: bold; padding-left: 20px; margin: 20px 0;">Editar Excursión</h1>
    <?php
    if (isset($_SESSION['mensaje'])):
    ?>
        <div class="p-3 alert alert-<?php echo $_SESSION['color']; ?> alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['mensaje']; ?>
        </div>
        <?php
        unset($_SESSION['mensaje']);
        unset($_SESSION['color']);
        ?>
    <?php endif; ?>

    <form method="post" id="excursionForm" class="form-grid" action="index.php?app=excursion&action=edit_excursion" novalidate enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $excursion->getId(); ?>">

        <div class="form-group">
            <label for="nombre" class="required">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $excursion->getTitle(); ?>" required>
            <span class="error-message">Este campo es obligatorio</span>
        </div>

        <div class="form-group">
            <label for="imagen" class="required">Imagen</label>
            <input type="file" id="image" name="image">
            <span class="error-message">Este campo es obligatorio</span>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="categoria" class="required">Categoría</label>
                <select id="categoria" name="categoria" required>
                    <option value="">Seleccionar</option>
                    <?php foreach ($categorias as $categoria) { ?>
                        <option value="<?php echo $categoria['id']; ?>" <?php if ($categoria['id'] == $excursion->getCategoryId()) echo 'selected'; ?>>
                            <?php echo $categoria['name']; ?>
                        </option>
                    <?php } ?>
                </select>
                <span class="error-message">Seleccione una categoría</span>
            </div>

            <div class="form-group">
                <label for="fecha_inicio">Fecha de Inicio:</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo $excursion->getStartDate(); ?>" required>
                <span class="error-message">Seleccione una fecha actual o superior</span>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="duracion" class="required">Duración (horas)</label>
                <input type="number" id="duracion" name="duracion" value="<?php echo $excursion->getDuration(); ?>" min="1" required>
                <span class="error-message">Ingrese la duración</span>
            </div>

            <div class="form-group">
                <label for="precio" class="required">Precio ($)</label>
                <input type="number" id="precio" name="precio" value="<?php echo $excursion->getPrice(); ?>" min="0" step="0.01" required>
                <span class="error-message">Ingrese el precio</span>
            </div>
        </div>

        <div class="form-group">
            <label for="descripcion" class="required">Descripción</label>
            <textarea id="descripcion" name="descripcion" required><?php echo $excursion->getDescription(); ?></textarea>
            <span class="error-message">Ingrese una descripción</span>
        </div>

        <div class="actions">
            <button type="reset" class="btn-secondary">Limpiar</button>
            <button type="submit" class="btn-primary">Guardar</button>
        </div>
    </form>
</main>

<?php require_once FOOTER; ?>
