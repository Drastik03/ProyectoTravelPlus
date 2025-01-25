
<?php
//AUTOR: ARIEL ALBERTO SOLIS PINO
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<?php require_once HEADER; ?>
<div class="container d-flex justify-content-center align-items-center">
    <div class="col-md-5 p-2 bg-white shadow rounded">

        <h2 class="text-center mb-3">Regístrate</h2>
        <form method="post" action="index.php?app=user&action=register" onsubmit="return validateRegister()">
            <?php if (isset($_SESSION['mensaje'])): ?>
                <div class="p-3 alert alert-<?php echo $_SESSION['color']; ?> alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['mensaje']; ?>
                    <a href="index.php?app=user&action=login" class="text-primary text-decoration-none">
                        <i class="fas fa-sign-in-alt"></i> Iniciar sesión
                    </a>
                </div>
                <?php unset($_SESSION['mensaje'], $_SESSION['color']); ?>
            <?php endif; ?>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="">Seleccione un rol</option>
                    <option value="cliente">Cliente</option>
                    <option value="administrador">Administrador</option>
                    <option value="vendedor">Vendedor</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Registrarse</button>
        </form>
    </div>
</div>
<script>
function validateRegister() {
    const username = document.getElementById('username').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();
    const confirmPassword = document.getElementById('confirm_password').value.trim();
    const role = document.getElementById('role').value;

    if (!username || !email || !password || !confirmPassword || !role) {
        alert('Todos los campos son obligatorios.');
        return false;
    }
    if (password !== confirmPassword) {
        alert('Las contraseñas no coinciden.');
        return false;
    }
    return true;
}
</script>
<?php require_once FOOTER; ?>