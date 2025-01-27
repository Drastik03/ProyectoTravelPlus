<?php require_once HEADER; 
//AUTHOR ZAMBRANO RODRIGUEZ ANGEL DANIEL
$usuarioLogueado = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'];

if(!$usuarioLogueado){
    header("Location: /index?app=user&action=login");
}
?>
<main>
<h1>Crear Nuevo Alojamiento</h1>
    <form action="index.php?app=alojamiento&action=store" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripcion:</label>
            <textarea type="text" id="descripcion" name="descripcion" required>
            </textarea>
        </div>
        <div class="form-group">
            <label for="ubicacion">Ubicación:</label>
            <input type="text" id="ubicacion" name="ubicacion" required>
        </div>
        <div class="form-group">
            <label for="tipo">Tipo:</label>
            <select id="tipo" name="tipo" required>
                <option value="casa">Casa</option>
                <option value="apartamento">Apartamento</option>
            </select>
        </div>
        <div class="form-group">
            <label for="precio">Precio:</label>
            <input step="0.01" type="number" id="precio" name="precio" required>
        </div>
        <div class="form-group">
            <label for="capacidad">Capacidad:</label>
            <input type="number" id="capacidad" name="capacidad" required>
        </div>
        <div class="form-group">
            <label for="disponible">Disponible:</label>
            <select id="disponible" name="disponible" required>
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="foto">Foto:</label>
            <input type="file" id="foto" name="foto" accept="image/*" required>
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