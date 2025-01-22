<?php require_once HEADER;
//AUTHOR: VEAS NOBOA JOHAN DAVID ?>
<main class="container">
    <h1 style="font-size: 2rem; text-align: center; font-weight: bold; padding-left: 20px; margin: 20px 0;">Nueva
        Excursión</h1>
    <form method="post" id="excursionForm" class="form-grid" action="index.php?app=excursion&action=new" novalidate enctype="multipart/form-data">
        <div class="form-group">
            <label for="nombre" class="required">Nombre</label>
            <input type="text" id="nombre" name="nombre">
            <span class="error-message">Este campo es obligatorio</span>
        </div>
        <div class="form-group">
            <!--imagn-->
            <label for="imagen" class="required">Imagen</label>
            <input type="file" id="imagen" name="imagen">
            <span class="error-message">Este campo es obligatorio</span>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="categoria" class="required">Categoría</label>
                <select id="categoria" name="categoria">
                    <option value="">Seleccionar</option>
                    <?php foreach ($categorias as $categoria) { ?>
                        <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['name']; ?></option>
                    <?php } ?>
                </select>
                <span class="error-message">Seleccione una categoría</span>
            </div>
            <div class="form-group">
                <label for="fecha_inicio">Fecha de Inicio:</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" required>
                <span class="error-message">Seleccione una fecha actual o superior</span>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="duracion" class="required">Duración (horas)</label>
                <input type="number" id="duracion" name="duracion" min="1">
                <span class="error-message">Ingrese la duración</span>
            </div>
            <div class="form-group">
                <label for="precio" class="required">Precio ($)</label>
                <input type="number" id="precio" name="precio" min="0" step="0.01">
                <span class="error-message">Ingrese el precio</span>
            </div>
        </div>

        <div class="form-group">
            <label for="descripcion" class="required">Descripción</label>
            <textarea id="descripcion" name="descripcion"></textarea>
            <span class="error-message">Ingrese una descripción</span>
        </div>

        <div class="actions">
            <button type="reset" class="btn-secondary">Limpiar</button>
            <button type="submit" class="btn-primary">Guardar</button>

        </div>
    </form>
</main>

<?php require_once FOOTER; ?>