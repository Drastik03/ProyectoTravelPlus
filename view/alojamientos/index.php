<?php require_once HEADER; 
//AUTHOR ZAMBRANO RODRIGUEZ ANGEL DANIEL
$usuarioLogueado = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'];

if(!$usuarioLogueado){
    header("Location: /index?app=user&action=login");
}
?>

<main id="main-container">
        <h1 class="px-3">Alojamientos</h1>
        <section class="d-flex  gap-2 mb-3 px-3">
            <div class="input-search-container">
                <img src="/assets/images/icons/search.svg" alt="imagen de buscar" width="20px">
                <form action="index.php?app=alojamiento&action=search" method="get">
                <input type="text" name="app" value="alojamiento" hidden>
                <input type="text" name="action" value="search" hidden>
                    <input class="search-input" name="search" type="text" placeholder="Busca servicios turisticos..">
                    <button>buscar</button>
                </form>
            </div>
            <?php if($_SESSION['rol_id'] == 2){ ?>
                <a href="index?app=alojamiento&action=create">
                    <button class="btn-button-default">Crear Alojamiento</button>
                </a>
            <?php } ?>
        </section>

        <section class="container">
    <div class="row g-4"> 
        <?php if (count($alojamientos) <= 0) { ?>
            <div class="col-12">
                <h2>No se encontraron resultados</h2>
            </div>
        <?php } ?>

        <?php foreach ($alojamientos as $alojamiento) { ?>
            <div class="col-md-4 col-12 mb-4">
                <div class="card-service-container">
                    <div class="w-100 mb-2 d-flex justify-content-center">
                        <img style="width: 200px;height:100px" src="<?php echo htmlspecialchars($alojamiento["foto_base64"]?:'/assets/images/default-image.png'); ?>" alt="">
                    </div>
                    <h3><?php 
                    $curr = $alojamiento["nombre"]?:"nombre no disponible";
                    if(strlen($curr) > 20){
                        echo htmlspecialchars(substr($curr, 0, 13) . "...");
                    }else{

                        echo htmlspecialchars($curr) ;
                    } 
                    ?></h3>
                    <div class="d-flex gap-2 mb-2">
                        <img style="width: 13px;" src="/assets/images/icons/ubication-icon.svg" alt="icono de ubicacion">
                        <span>

                        <?php 
                    $curr = $alojamiento["ubicacion"]?:"ubicacion no disponible";
                    // substring if curr is too long
                    if(strlen($curr) > 20){
                        echo htmlspecialchars(substr($curr, 0, 13) . "...");
                    }else{

                        echo htmlspecialchars($curr) ;
                    } 
                    ?>

                        </span>
                    </div>
                    <div class="d-flex mb-2 justify-content-between mb-2">
                        <div class="d-flex gap-2">
                            <img style="width: 15px;" src="/assets/images/icons/star-rate.svg" alt="icono de ubicacion">
                            <span>
                                <?php echo htmlspecialchars($alojamiento["score"])?>
                            </span>
                        </div>
                        <div>
                            <?php echo htmlspecialchars("$".$alojamiento["precio"])?>
                        </div>
                    </div>
                    <a href="index?app=alojamiento&action=show&id=<?php echo $alojamiento["id"]?>">
                        <button class="btn-button-default w-100 mb-2">Ver mas</button>
                        <?php if($_SESSION['rol_id'] == 2){ ?>
                            <a href="index?app=alojamiento&action=edit&id=<?php echo $alojamiento["id"]?>">
                                <button class="btn-button-default w-100">Editar</button>
                            </a>
                        <?php } ?>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

    </main>
