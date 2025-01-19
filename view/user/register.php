<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<?php require_once HEADER; ?>
<div class="container d-flex justify-content-center align-items-center">
    <div class="col-md-5 p-2 bg-white shadow rounded">

        <h2 class="text-center mb-3">Regístrate</h2>
        <form method="post" action="index.php?app=user&action=register">
            <?php
            if (isset($_SESSION['mensaje'])):
            ?>
                <div class="p-3 alert alert-<?php echo $_SESSION['color']; ?> alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['mensaje']; ?>
                    <a href="index.php?app=user&action=login" class="text-primary text-decoration-none">
                        <i class="fas fa-sign-in-alt"></i> Iniciar sesión
                    </a>
                </div>

                <?php
                unset($_SESSION['mensaje']);
                unset($_SESSION['color']);
                ?>
            <?php endif; ?>
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input
                    type="text"
                    class="form-control"
                    name="name"
                    placeholder="Ingrese su nombre"
                    required />
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Apellido</label>
                <input
                    type="text"
                    class="form-control"
                    name="lastName"
                    placeholder="Ingrese sus apellidos"
                    required />
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Nombre de Usuario</label>
                <input
                    type="text"
                    class="form-control"
                    name="username"
                    placeholder="usuario123"
                    required />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input
                    type="password"
                    class="form-control"
                    name="password"
                    placeholder="Password"
                    required />
            </div>
            <div class="mb-3 d-flex align-items-center">
                <label for="admin" class="form-label mb-0 me-2">¿Eres una empresa?</label>
                <div class="form-check form-switch">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="admin"
                        name="admin"
                        value="2" />
                </div>
            </div>

            <div class="mb-3">
                <input
                    type="submit"
                    class="btn btn-primary w-100" name="btnRegister" />
            </div>
            <div class="mb-2 text-center">
                <span class="text-center">¿Ya tienes una cuenta? <a href="index.php?app=user&action=login" class="card-link">Inicia sesión</a></span>
            </div>
        </form>
    </div>
</div>
<?php require_once FOOTER; ?>