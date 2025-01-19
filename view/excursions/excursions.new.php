<?php require_once HEADER ; ?>

<main class="container">
    <h1 style="font-size: 2rem; text-align: center; font-weight: bold; padding-left: 20px; margin: 20px 0;">Nueva
        Excursión</h1>
    <form id="excursionForm" class="form-grid" novalidate>
        <div class="form-group">
            <label for="nombre" class="required">Nombre</label>
            <input type="text" id="nombre" name="nombre">
            <span class="error-message">Este campo es obligatorio</span>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="categoria" class="required">Categoría</label>
                <select id="categoria" name="categoria">
                    <option value="">Seleccionar</option>
                    <option value="montana">Montaña</option>
                    <option value="cultural">Cultural</option>
                    <option value="aventura">Aventura</option>
                </select>
                <span class="error-message">Seleccione una categoría</span>
            </div>
            <div class="form-group">
                <label for="dificultad" class="required">Dificultad</label>
                <select id="dificultad" name="dificultad">
                    <option value="">Seleccionar</option>
                    <option value="facil">Fácil</option>
                    <option value="moderado">Moderado</option>
                    <option value="dificil">Difícil</option>
                </select>
                <span class="error-message">Seleccione la dificultad</span>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="duracion" class="required">Duración (horas)</label>
                <input type="number" id="duracion" name="duracion" min="1">
                <span class="error-message">Ingrese la duración</span>
            </div>
            <div class="form-group">
                <label for="precio" class="required">Precio ($)</label>
                <input type="number" id="precio" name="precio" min="0" step="0.01">
                <span class="error-message">Ingrese el precio</span>
            </div>
        </div>

        <div class="form-group">
            <label for="descripcion" class="required">Descripción</label>
            <textarea id="descripcion" name="descripcion"></textarea>
            <span class="error-message">Ingrese una descripción</span>
        </div>

        <fieldset class="checkbox-grid">
            <legend>Servicios Incluidos</legend>
            <label>
                <input type="checkbox" name="servicios" value="guia"> Guía
            </label>
            <label>
                <input type="checkbox" name="servicios" value="transporte"> Transporte
            </label>
            <label>
                <input type="checkbox" name="servicios" value="equipo"> Equipo
            </label>
            <div class="error-message" style="display: none; color: red;">Debe seleccionar al menos un servicio
            </div>
        </fieldset>

        <div class="actions">
            <button type="reset" class="btn-secondary">Limpiar</button>
            <button type="submit" class="btn-primary">Guardar</button>
        </div>
    </form>
</main>

<? require_once FOOTER ; ?>