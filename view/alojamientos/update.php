<?php require_once HEADER; 
//AUTHOR ZAMBRANO RODRIGUEZ ANGEL DANIEL
$usuarioLogueado = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'];

if(!$usuarioLogueado){
    header("Location: /index?app=user&action=login");
}
?>
<main>
<h1>Editar alojamiento</h1>
    <form action="index.php?app=alojamiento&action=update" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="PUT">    
    <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" value="<?php echo $alojamiento["nombre"] ?>" name="nombre" required>
        </div>
        <input type="text" name="id" value="<?php echo $alojamiento["id"] ?>" hidden>
        <div class="form-group">
            <label for="descripcion">Descripcion:</label>
            <textarea id="descripcion" name="descripcion" required><?php echo htmlspecialchars($alojamiento["descripcion"]); ?></textarea>
        </div>
        <div class="form-group">
            <label for="ubicacion">Ubicación:</label>
            <input type="text" id="ubicacion" value="<?php echo $alojamiento["ubicacion"] ?>" name="ubicacion" required>
        </div>
        <div class="form-group">
            <label for="tipo">Tipo:</label>
            <select id="tipo" name="tipo" required>
                <option value="casa" <?php echo $alojamiento["tipo"] == "casa" ? "selected" : ""; ?>>Casa</option>
                <option value="apartamento" <?php echo $alojamiento["tipo"] == "apartamento" ? "selected" : ""; ?>>Apartamento</option>
            </select>
        </div>
        <div class="form-group">
            <label for="precio">Precio:</label>
            <input step="0.01" type="number" value="<?php echo $alojamiento["precio"] ?>" id="precio" name="precio" required>
        </div>
        <div class="form-group">
            <label for="capacidad">Capacidad:</label>
            <input type="number" id="capacidad" value="<?php echo $alojamiento["capacidad"] ?>" name="capacidad" required>
        </div>
        <div class="form-group">
            <label for="disponible">Disponible:</label>
            <select id="disponible" name="disponible" required>
                <option value="1" <?php echo $alojamiento["disponible"] == 1 ? "selected" : ""; ?>>Sí</option>
                <option value="0" <?php echo $alojamiento["disponible"] == 0 ? "selected" : ""; ?>>No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="foto">Foto:</label>
            <input type="file" id="foto" name="foto" accept="image/*" >
        </div>
        <input type="hidden" id="foto_base64" name="foto_base64">
        <button type="submit">Crear Alojamiento</button>
    </form>

    <script>
        document.getElementById('foto').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('foto_base64').value = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</main>