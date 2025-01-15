<?php require_once HEADER; ?>

<section id="contacto">
    <h2>Información de Contacto</h2>
    <ul class="contact-info">
        <li><strong>Teléfono:</strong> +593 912095512 - (04) 259-1287 ext. 298</li>
        <li><strong>Email:</strong> contacto@travelplus.com</li>
        <li><strong>Dirección:</strong> Av. Francisco de Orellana, frente al C.C Mall del Sol</li>
    </ul>

    <h3>Formulario de Contacto</h3>
    <form class="contact-form" action="mailto:contacto@travelplus.com" method="POST" enctype="multipart/form-data">
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Mensaje:</label>
        <textarea id="message" name="message" rows="5" required></textarea>

        <button type="submit">Enviar mensaje</button>
    </form>
</section>

<?php require_once FOOTER; ?>