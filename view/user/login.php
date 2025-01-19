<?php require_once HEADER; ?>
<div class="container d-flex justify-content-center align-items-center mt-3">
    <div class="col-md-5 p-2 bg-white shadow rounded">
        <h2 class="text-center mb-4">Login</h2>
        <form method="post" action="index.php?app=user&action=login">
        <?php
            if (isset($_SESSION['mensaje'])):
            ?>
                <div class="p-3 alert alert-<?php echo $_SESSION['color']; ?> alert-dismissible fade show text-center" role="alert">
                    <?php echo $_SESSION['mensaje']; ?>
                </div>

                <?php
                unset($_SESSION['mensaje']);
                unset($_SESSION['color']);
                unset($_SESSION['user_id']);
                unset($_SESSION['username']); 
                ?>
            <?php endif; ?>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input
                    type="text"
                    class="form-control"
                    name="username"
                    placeholder="user123"
                    value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"
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