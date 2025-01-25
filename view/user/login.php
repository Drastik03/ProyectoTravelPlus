
<?php require_once HEADER; 
//AUTOR: ARIEL ALBERTO SOLIS PINO
?>
<div class="container d-flex justify-content-center align-items-center mt-3">
    <div class="col-md-5 p-2 bg-white shadow rounded">
        <h2 class="text-center mb-4">Login</h2>
        <form method="post" action="index.php?app=user&action=login" onsubmit="return validateLogin()">
            <?php if (isset($_SESSION['mensaje'])): ?>
                <div class="p-3 alert alert-<?php echo $_SESSION['color']; ?> alert-dismissible fade show text-center" role="alert">
                    <?php echo $_SESSION['mensaje']; ?>
                </div>
                <?php unset($_SESSION['mensaje'], $_SESSION['color']); ?>
            <?php endif; ?>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>
<script>
function validateLogin() {
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();
    if (!username || !password) {
        alert('Todos los campos son obligatorios.');
        return false;
    }
    return true;
}
</script>
<?php require_once FOOTER; ?>