<?php require_once HEADER; ?>

<div class="container d-flex justify-content-center align-items-center mt-3">
    <div class="col-md-5 p-2 bg-white shadow rounded">
        <h2 class="text-center mb-4">Login</h2>
        <form method="post" action="index.php?controller=auth&action=loguear">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                    type="email"
                    class="form-control"
                    name="email"
                    placeholder="abc@example.com"
                    required />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input
                    type="password"
                    class="form-control"
                    name="password"
                    placeholder="Password"
                    required />
            </div>
            <div class="mb-3 text-center">
                <a href="recuperar_contrasena.php" class="card-link">Olvidé mi contraseña</a>
            </div>
            <div class="mb-3">
                <input
                    type="submit"
                    class="btn btn-primary w-100" name="btnLogin" />
            </div>
            <div class="mb-3 text-center">
                <span class="text-center">No tienes una cuenta? <a href="index.php?app=user&action=index" class="card-link">Registrarse</a></span>
            </div>
        </form>
    </div>
</div>

<?php require_once FOOTER; ?>
