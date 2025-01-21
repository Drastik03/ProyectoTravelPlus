<?php require_once HEADER;
//AUTHOR: VEAS NOBOA JOHAN DAVID
?>

<main>
    <h1 style="font-size: 2rem; text-align: center; font-weight: bold; padding-left: 20px; margin: 20px 0;">
        Excursiones</h1>
    <section class="excursiones-container">
        <?php foreach ($excursiones as $excursion) { ?>
            <article class="excursion-card">
                <img class="excursion-card-image" src="./assets/images/uploads/excursions/<?php echo $excursion['image_route']; ?>" alt="Imagen de la excursión" />
                <div class="excursion-card-content">
                    <h3 class="excursion-card-title"><?php echo $excursion['title']; ?></h3>
                    <p class="excursion-card-description">
                        <?php echo $excursion['description']; ?>
                    </p>
                    <div class="excursion-card-details">
                        <span class="category">Categoría: <?php echo htmlspecialchars($excursion['category_name'], ENT_QUOTES, 'UTF-8'); ?></span>
                        <span class="duration">Duración: <?php echo $excursion['duration'] ?> horas</span>
                        <span class="price">Precio: $<?php echo $excursion['price']; ?></span>
                        <span class="fecha">Fecha: <?php echo $excursion['start_date']; ?></span>
                    </div>
                    <section class="excursion-card-services">
                        <h4>Servicios Incluidos:</h4>
                        <ul>
                            <li>Guía</li>
                            <li>Transporte</li>
                            <li>Equipo</li>
                        </ul>
                    </section>
                    <a href="/pages/forms/registrar-excursiones.html" class="excursion-card-button">Reservar ahora</a>
                    <!-- Botones de editar y eliminar -->
                    <div class="excursion-card-buttons">
                        <a href="index.php?app=excursion&action=edit&id=<?php echo $excursion['id']; ?>" class="edit-button">Editar</a>
                        <a href="index.php?app=excursion&action=delete_exursion&id=<?php echo $excursion['id']; ?>" class="delete-button">Eliminar</a>

                        </div>
                </div>
            </article>
        <?php } ?>
    </section>
</main>

<?php require_once FOOTER; ?>