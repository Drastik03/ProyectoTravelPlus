<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./assets/images/logo.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/home.css">
    <link rel="stylesheet" href="./assets/css/contacto.css">
    <link rel="stylesheet" href="./assets/css/nosotros.css">
    <link rel="stylesheet" href="./assets/css/politica.css">
    <link rel="stylesheet" href="./assets/css/excursiones.css">

    <title>TravelPlus SA</title>
</head>

<body>

    <header>
        <nav class="nav-main d-flex justify-content-between">
            <a href="index.php" style="text-decoration: none">
                <div class="nav-main-logo-container ps-2">
                    <img src="./assets/images/logo.svg" alt="logo de TravelPlus  SA">
                    <span class="logo-text d-none d-md-block">
                        Travel<span>PLUS</span>
                    </span>
                </div>
            </a>

            <div class="d-none d-md-flex justify-content-center align-items-center gap-3 nav-link-container">
                <a class="nav-options nav-main-link" href="index.php">Inicio</a>
                <a class="nav-options nav-main-link" href="/pages/servicios.html">Servicios</a>
                <a class="nav-options nav-main-link" href="index.php?app=excursion&action=index">Excursiones</a>
                <a class="nav-options nav-main-link" href="/index.html">Destinos</a>
                <a class="nav-options nav-main-link" href="/pages/alojamientos.html">Alojamientos</a>
                <a class="nav-options nav-main-link" href="index.php?app=user&index">Usuarios</a>

                <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']) { ?>
                    <div class="d-flex align-items-center">
                        <span class="nav-options nav-main-link ms-2"> <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                        <img src="./assets/images/icons/Icono-sesion-iniciada.svg" alt="Usuario" class="user-icon">
                    </div>
                    <a class="btn-register nav-main-link" href="index.php?app=user&action=logout">Cerrar Sesión</a>
                <?php } else { ?>
                    <a class="btn-register nav-main-link" href="index.php?app=user&action=login">Iniciar Sesión</a>
                <?php } ?>
            </div>
            <button type="button" class="btn btn-button-menu d-flex align-items-center d-md-none">
                <img class="menu-mobile-icon" src="./assets/images/icons/menu-icon.svg" alt="icono de menu mobile"
                    aria-hidden="true">
            </button>
        </nav>
        <div class="sidebar">
            <button class="sidebar-close">&times;</button>
            <nav class="sidebar-nav">
                <div class="m-auto">
                    <img src="./assets/images/logo.svg" alt="logo de TravelPlus SA">
                </div>
                <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']) { ?>
                    <div class="d-flex align-items-center mx-auto">
                        <img src="./assets/images/icons/Icono-sesion-iniciada.svg" alt="Usuario" class="user-icon rounded-circle me-2">
                        <span class="nav-options nav-main-link text-white fw-bold"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    </div>
                <?php } ?>

                <a class="nav-options" href="index.php">
                    Inicio</a>
                <a class="nav-options" href="../index.html">Servicios</a>
                <a class="nav-options" href="index.php?app=excursiones&action=index">Excursiones</a>
                <a class="nav-options" href="../index.html">Destinos</a>
                <a class="nav-options" href="../pages/alojamientos.html">Alojamientos</a>
                <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']) { ?>
                    <a class="btn-register nav-main-link" href="index.php?app=user&action=logout">Cerrar Sesión</a>
                <?php } else { ?>
                    <a class="btn-register nav-main-link" href="index.php?app=user&action=login">Iniciar Sesión</a>
                <?php } ?>
            </nav>
        </div>
        <div class="overlay"></div>
    </header>