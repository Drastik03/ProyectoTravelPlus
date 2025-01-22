<?php require_once HEADER; ?>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<main class="container">
    <h1 style="font-size: 2rem; text-align: center; font-weight: bold; padding-left: 20px; margin: 20px 0;">Editar Excursión</h1>
    <form method="post" id="excursionForm" class="form-grid" action="index.php?app=excursion&action=update_excursion" enctype="multipart/form-data" novalidate>
        <input type="hidden" name="id" value="<?php echo $excursion['id']; ?>"> <!-- Aquí se pasa el ID de la excursión -->

        <section class="form-group">
            <label for="nombre" class="required">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $excursion['title']; ?>" required>
            <span class="error-message">Este campo es obligatorio</span>
        </section>

        <section class="form-group">
            <label for="imagen" class="required">Imagen</label>
            <input type="file" id="image" name="image">
            <span class="error-message">Este campo es obligatorio</span>
            <!-- Mostrar la imagen actual si existe -->
            <?php if (!empty($excursion['image_route'])): ?>
                <figure>
                    <img src="./assets/images/uploads/excursions/<?php echo $excursion['image_route']; ?>" alt="Imagen de la excursión" style="width: 150px; margin-top: 10px;">
                </figure>
            <?php endif; ?>
        </section>

        <section class="form-row">
            <section class="form-group">
                <label for="categoria" class="required">Categoría</label>
                <select id="categoria" name="categoria" required>
                    <option value="">Seleccionar</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?php echo $categoria['id']; ?>" <?php if ($categoria['id'] == $excursion['category_id']) echo 'selected'; ?>>
                            <?php echo $categoria['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <span class="error-message">Seleccione una categoría</span>
            </section>

            <section class="form-group">
                <label for="fecha_inicio">Fecha de Inicio:</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo $excursion['start_date']; ?>" required>
                <span class="error-message">Seleccione una fecha actual o superior</span>
            </section>
        </section>

        <section class="form-row">
            <section class="form-group">
                <label for="duracion" class="required">Duración (horas)</label>
                <input type="number" id="duracion" name="duracion" value="<?php echo $excursion['duration']; ?>" min="1" required>
                <span class="error-message">Ingrese la duración</span>
            </section>

            <section class="form-group">
                <label for="precio" class="required">Precio ($)</label>
                <input type="number" id="precio" name="precio" value="<?php echo $excursion['price']; ?>" min="0" step="0.01" required>
                <span class="error-message">Ingrese el precio</span>
            </section>
        </section>

        <section class="form-group">
            <label for="descripcion" class="required">Descripción</label>
            <textarea id="descripcion" name="descripcion" required><?php echo $excursion['description']; ?></textarea>
            <span class="error-message">Ingrese una descripción</span>
        </section>

        <section class="actions">
            <button type="reset" class="btn-secondary">Limpiar</button>
            <button type="submit" class="btn-primary">Guardar</button>
        </section>
    </form>
</main>

<?php require_once FOOTER; ?>
