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
                <a class="nav-options nav-main-link" href="/pages/excursiones.html">Excursiones</a>
                <a class="nav-options nav-main-link" href="/index.html">Destinos</a>
                <a class="nav-options nav-main-link" href="/pages/alojamientos.html">Alojamientos</a>
                <a class="btn-register nav-main-link" href="/index.html">
                    Iniciar Sesion
                </a>
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
                <a class="nav-options" href="index.php">
                    Inicio</a>
                <a class="nav-options" href="../index.html">Servicios</a>
                <a class="nav-options" href="../pages/excursiones.html">Excursiones</a>
                <a class="nav-options" href="../index.html">Destinos</a>
                <a class="nav-options" href="../pages/alojamientos.html">Alojamientos</a>
                <a class="btn-register" href="#">Iniciar Sesión</a>
            </nav>
        </div>
        <div class="overlay"></div>
    </header>