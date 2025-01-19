<?php require_once HEADER ; ?>

<main>
    <h1 style="font-size: 2rem; text-align: center; font-weight: bold; padding-left: 20px; margin: 20px 0;">
        Excursiones</h1>
    <section class="excursiones-container">
        <article class="excursion-card">
            <img src="https://images.pexels.com/photos/2161449/pexels-photo-2161449.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                alt="Excursión Montaña" class="excursion-card-image">
            <div class="excursion-card-content">
                <h3 class="excursion-card-title">Excursión a la Montaña</h3>
                <p class="excursion-card-description">
                    Disfruta de una experiencia única en la montaña con un guía especializado.
                </p>
                <div class="excursion-card-details">
                    <span class="category">Categoría: Montaña</span>
                    <span class="difficulty">Dificultad: Moderado</span>
                    <span class="duration">Duración: 5 horas</span>
                    <span class="price">Precio: $150</span>
                </div>
                <div class="excursion-card-rating">
                    <span>★★★★★</span><span>4.5</span> <!-- Calificación por defecto -->
                </div>
                <section class="excursion-card-services">
                    <h4>Servicios Incluidos:</h4>
                    <ul>
                        <li>Guía</li>
                        <li>Transporte</li>
                        <li>Equipo</li>
                    </ul>
                </section>
                <!-- <button class="excursion-card-button" >Reservar ahora</button> -->
                <a href="/pages/forms/registrar-excursiones.html" class="excursion-card-button">Reservar ahora</a>

            </div>
        </article>
        <article class="excursion-card">
            <img src="https://images.pexels.com/photos/1743165/pexels-photo-1743165.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                alt="Excursión Montaña" class="excursion-card-image">
            <div class="excursion-card-content">
                <h3 class="excursion-card-title">Excursión a la Montaña (Nocturno)</h3>
                <p class="excursion-card-description">
                    Disfruta de una experiencia única en la montaña, en plena luz de la luna.
                </p>
                <div class="excursion-card-details">
                    <span class="category">Categoría: Aventura</span>
                    <span class="difficulty">Dificultad: Moderado</span>
                    <span class="duration">Duración: 8 horas</span>
                    <span class="price">Precio: $200</span>
                </div>
                <div class="excursion-card-rating">
                    <span>★★★★★</span><span>4.9</span>
                </div>
                <section class="excursion-card-services">
                    <h4>Servicios Incluidos:</h4>
                    <ul>
                        <li>Guía</li>
                        <li>Transporte</li>
                        <li>Equipo</li>
                    </ul>
                </section>
                <!-- <button class="excursion-card-button">Reservar ahora</button> -->
                <a href="/pages/forms/registrar-excursiones.html" class="excursion-card-button">Reservar ahora</a>
            </div>
        </article>
    </section>
</main>

<?php require_once FOOTER ; ?>
