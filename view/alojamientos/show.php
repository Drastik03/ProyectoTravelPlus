<?php require_once HEADER; 
//AUTHOR ZAMBRANO RODRIGUEZ ANGEL DANIEL
$usuarioLogueado = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'];
?>
<main id="main-container">
        <section style="padding: 20px;" class="container">
            <h1 class="visually-hidden">Servicio ofrecido por plusServices</h1>
            <article class="row">
                <div class="col-12 col-md-4 image-service-container mb-2">
                    <img class="img-main-image" src="<?php echo htmlspecialchars($alojamiento["foto_base64"]?:'/assets/images/default-image.png'); ?>" alt="imagen de servicio turistico">

                    <div class="d-none d-md-flex my-4 justify-content-between">
                        <small class="share-service-tag">Compartir</small>
                        <div class="d-flex gap-1">
                            <img src="/assets/images/icons/facebook-media.svg" alt="icono para compartir contenido en facebook"
                                aria-hidden="true">

                        </div>

                    </div>
                </div>
                <div class="col-12 col-md-6 ">
                    <h2 class="service-title"><?php echo htmlspecialchars($alojamiento["nombre"])?></h2>
                    <p class="price-service"><?php echo htmlspecialchars("$".$alojamiento["precio"])?></p>
                    <div class="d-flex">
                        <div class="d-flex p-2 gap-2">
                        <?php
                            $rate = $alojamiento["score"];
                            $maxStars = 5;
                            $rateInStars = ($rate / 10) * $maxStars;
                        ?>
                        <div class="rating">
                    <?php for ($i = 1; $i <= $maxStars; $i++): ?>
                        <?php if ($i <= $rateInStars): ?>
                        <img src="/assets/images/icons/star-rate.svg" alt="star">
                    <?php else: ?>
                        <img src="/assets/images/icons/star-rate-gray.svg" alt="star">
                    <?php endif; ?>
                    <?php endfor; ?>
                    </div>
                           
                        </div>
                        <div style="height: auto;background-color: var(--color-gray);width: 2px;">

                        </div>
                        <span class=" comment-tag ps-2 d-flex align-items-center justify-content-center">
                            <?php
                                //print all comments
                                $commentsCount = count($comentarios);
                                echo $commentsCount . " Comentario" . ($commentsCount > 1 ? "s" : "");
                        
                            ?>
                        </span>
                    </div>
                    <article class="service-article-description text-md-left text-center">
                        <h6>Disfruta en uno de los mejores lugares</h6>
                        <p>
                           <?php echo htmlspecialchars($alojamiento["descripcion"])  ?>
                        </p>
                    </article>
                    <div class="d-flex gap-2 mb-3">
                        <img src="/assets/images/icons/ubication-icon.svg" style="width: 14px;" alt="icono de tiempo"
                            aria-hidden="true">
                        <small><?php echo htmlspecialchars($alojamiento["ubicacion"])  ?></small>
                    </div>
                    <div class="d-md-flex d-block justify-content-between gap-2">
                        <button class="btn-button-default px-5 w-100  mb-2 ">Agregar</button>
                        <button class="btn-button-outline px-5 px-5 w-100  mb-2">Reservar Ahora</button>
                    </div>

                    <div class="w-100 my-2" style="height: 2px;background-color:var(--color-gray)">

                    </div>

                </div>
            </article>
            <section class="row">
                <h3 class="visually-hidden">Seccion de comentarios</h3>
                <div class="d-none d-md-flex col-2 ">

                </div>
                <article class="col col-md-8">
                    <h4 class="service-title">Comentarios</h4>
                    <div class="service-review-container">
                        <?php foreach($comentarios as $comentario): ?>
                        <div class="service-review-item">
                            <div class="d-flex gap-2">
                                <img src="/assets/images/icons/user-icon.png" width="20px" height="20px" alt="icono de usuario"
                                    aria-hidden="true">
                                <span>
                                <?php 
                                require_once './model/dao/UserDAO.php';
                                $userDao = new UserDAO();
                                $user = $userDao->getById($comentario["user_id"]);
                                echo htmlspecialchars($user->username)
                                ?></span>
                            </div>
                            <div class="d-flex p-2 gap-2">
                                <?php
                                    $rate = $comentario["score"];
                                    $maxStars = 5;
                                    $rateInStars = ($rate / 10) * $maxStars;
                                ?>
                                <div class="rating">
                                    <?php for ($i = 1; $i <= $maxStars; $i++): ?>
                                        <?php if ($i <= $rateInStars): ?>
                                            <img src="/assets/images/icons/star-rate.svg" alt="star">
                                        <?php else: ?>
                                            <img src="/assets/images/icons/star-rate-gray.svg" alt="star">
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <p><?php echo htmlspecialchars($comentario["comentario"])?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if($usuarioLogueado): ?>
                    <div class="service-review-input-container">
                        <h5>Puntua este servicio</h5>
                        <form action="index.php?app=alojamiento&action=create_comment" method="POST">
                            <div class="input-container">
                                <textarea class="w-100" name="comment" placeholder="Envianos tus comentarios"></textarea>
                                <div class="d-flex p-2 gap-2 review-rate-container-user">
                                    <img class="img-rate-user" src="/assets/images/icons/star-rate-gray.svg" alt="icono de estrella" aria-hidden="true">
                                    <img class="img-rate-user" src="/assets/images/icons/star-rate-gray.svg" alt="icono de estrella" aria-hidden="true">
                                    <img class="img-rate-user" src="/assets/images/icons/star-rate-gray.svg" alt="icono de estrella" aria-hidden="true">
                                    <img class="img-rate-user" src="/assets/images/icons/star-rate-gray.svg" alt="icono de estrella" aria-hidden="true">
                                    <img class="img-rate-user" src="/assets/images/icons/star-rate-gray.svg" alt="icono de estrella" aria-hidden="true">

                                </div>
                                <input type="hidden" name="rate" id="rate-input" value="0">
                                <input type="hidden" name="alojamiento_id" value="<?php echo $alojamiento["id"]?>">
                                <button type="submit" class="btn-button-default">Enviar</button>
                            </div>
                        </form>
                    </div>
                    <?php endif; ?>
                </article>

    

                    

            </section>



        </section>
    </main>

    <script type="module">
        const images = document.querySelectorAll('.image-slider-item');
        const mainImage = document.querySelector('.img-main-image'); 

        images.forEach(img=>{
            img.addEventListener('click',()=>{
                mainImage.src = img.src;
                img.classList.add('image-slider-selected');
                images.forEach(image=>{
                    if(image !== img){
                        image.classList.remove('image-slider-selected');
                    }
                })
            })
        })

        const starOfRates = document.querySelectorAll('.img-rate-user');
        starOfRates.forEach(star=>{
            star.addEventListener('click',(e)=>{

                star.src = '/assets/images/icons/star-rate.svg';
                for(let i = 0; i < starOfRates.length; i++){
            
                    if(starOfRates[i] === star){
                        for(i=i+1; i < starOfRates.length; i++){
                            starOfRates[i].src = '/assets/images/icons/star-rate-gray.svg';
                        }
                        break;
                    }
                    starOfRates[i].src = '/assets/images/icons/star-rate.svg';
                }

            })
        })

        document.addEventListener('DOMContentLoaded', (event) => {
            const rateInput = document.getElementById('rate-input');
        const starOfRates = document.querySelectorAll('.img-rate-user');
        starOfRates.forEach(star => {
            console.log('Star:', star);
            star.addEventListener('click', (e) => {
                let clickedIndex = Array.from(starOfRates).indexOf(star);
                starOfRates.forEach((s, index) => {
                    s.src = index <= clickedIndex ? '/assets/images/icons/star-rate.svg' : '/assets/images/icons/star-rate-gray.svg';
                });
                let newRate = ((clickedIndex + 1) / 5) * 10;
                rateInput.value = newRate.toFixed(1); // Actualiza el valor del input hidden
            });
        });
    });

    </script>