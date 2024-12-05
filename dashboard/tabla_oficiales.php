<?php require_once "vistas/parte_superior.php" ?>

<style>
    /* Foto upload */
    .photo-upload {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 2rem;
    }

    .photo-container {
        position: relative;
        width: 100px;
        height: 100px;
    }

    .photo-preview {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 2px dashed var(--border-color);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        overflow: hidden;
    }

    .photo-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: none;
    }

    .photo-text {
        text-align: center;
        font-size: 0.9rem;
        color: #666;
    }

    .photo-size {
        font-size: 0.8rem;
        color: #999;
    }

    .remove-photo {
        position: absolute;
        top: -5px;
        right: -5px;
        width: 20px;
        height: 20px;
        background: var(--error-color);
        border-radius: 50%;
        display: none;
        align-items: center;
        justify-content: center;
        color: white;
        cursor: pointer;
        font-size: 14px;
    }
    /* Estilos generales */
    :root {
        --primary-color: #0066cc;
        --border-color: #e0e0e0;
        --text-color: #333;
        --error-color: #dc3545;
        --button-size: 25px;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Estilos del formulario */
    .form-group {
        margin-bottom: 1.5rem;
    }

    label {
        font-size: 0.9rem;
        color: #555;
    }

    input[type="text"],
    input[type="date"],
    select {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    input[type="text"]:focus,
    input[type="date"]:focus,
    select:focus {
        outline: none;
        border-color: var(--primary-color);
    }

    /* Botón de añadir */
    .add-button {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.75rem;
        width: 100%;
        border: 1px solid var(--border-color);
        background: none;
        border-radius: 4px;
        cursor: pointer;
        color: var(--primary-color);
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .add-button:hover {
        background-color: #f5f5f5;
    }

    .add-button:before {
        content: '+';
        margin-right: 0.5rem;
        font-size: 1.2rem;
    }

    /* Campos dinámicos */
    .dynamic-field {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
    }

    .dynamic-field input {
        flex: 1;
        margin-right: 0.5rem;
    }

    /* Botón de eliminar */
    .delete-button {
        width: var(--button-size);
        height: var(--button-size);
        background: var(--error-color);
        color: white;
        border: none;
        border-radius: 50%;
        font-size: 0.9rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .delete-button:hover {
        background: #c82333;
    }
    :root {
        --primary-color: #0066cc;
        --border-color: #e0e0e0;
        --text-color: #333;
        --error-color: #dc3545;
        --button-height: 40px; /* Altura igual a la del botón Añadir */
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    label {
        font-size: 0.9rem;
        color: #555;
    }

    .add-button {
        display: flex;
        align-items: center;
        justify-content: center;
        height: var(--button-height);
        width: 100%;
        border: 1px solid var(--border-color);
        background: none;
        border-radius: 4px;
        cursor: pointer;
        color: var(--primary-color);
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .add-button:hover {
        background-color: #f5f5f5;
    }

    .add-button:before {
        content: '+';
        margin-right: 0.5rem;
        font-size: 1.2rem;
    }

    .dynamic-field {
        display: flex;
        align-items: center;
        width: 100%;
        margin-bottom: 0.5rem;
    }

    .dynamic-field input {
        flex: 1;
        height: var(--button-height);
        padding: 0.75rem;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        font-size: 0.9rem;
        margin-right: 0.5rem;
    }

    .dynamic-field input:focus {
        outline: none;
        border-color: var(--primary-color);
    }

    .delete-button {
        height: var(--button-height);
        width: var(--button-height);
        background: var(--error-color);
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 0.9rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .delete-button:hover {
        background: #c82333;
    }
</style>


    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Consulta de Nómina de Juegos</h6>
            </div>
            <div class="card-body">
                <form id="personalDataForm">
                    <div class="form-row">
                        <div class="radio-group">
                            <label class="radio-label">
                                <input type="radio" name="gender" value="hombre">
                                Hombre
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="gender" value="mujer" checked>
                                Mujer
                            </label>
                        </div>
                        <div class="switch-container">
                            <span>Fallecido</span>
                            <label class="switch">
                                <input type="checkbox" id="fallecidoSwitch">
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>

                    <div class="photo-upload">
                        <div class="photo-container">
                            <div class="photo-preview" id="photoPreview">
                                <img id="previewImage" src="" alt="Foto de perfil">
                                <div class="photo-text">
                                    <div>Foto</div>
                                    <div class="photo-size">max. 1MB (1000KB)</div>
                                </div>
                            </div>
                            <div class="remove-photo" id="removePhoto">×</div>
                            <input type="file" id="photoInput" hidden accept="image/*">
                        </div>
                    </div>

                    <div class="form-group">
                        <h3 class="section-title">Datos Personales</h3>
                        <div class="input-group">
                            <label>Nombre</label>
                            <input type="text" value="NEISI PATRICIA">
                        </div>
                        <div class="input-group">
                            <label>Primer apellido</label>
                            <input type="text" value="DAJOMES">
                        </div>
                        <div class="input-group">
                            <label>Segundo apellido</label>
                            <input type="text" value="BARRERA">
                        </div>
                    </div>

                    <div class="form-group">
                        <h3 class="section-title">Datos de Nacimiento</h3>
                        <div class="input-group">
                            <label>País *</label>
                            <select>
                                <option value="ecuador" selected>Ecuador</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Fecha de nacimiento</label>
                            <input type="date" value="1998-05-12">
                        </div>
                        <div class="input-group">
                            <label>Población de nacimiento</label>
                            <input type="text" value="PASTAZA">
                        </div>
                    </div>

                    <div class="form-group">
                        <h3 class="section-title">Datos de Contacto</h3>
                        <div class="input-group">
                            <label>Teléfono</label>
                            <button type="button" class="add-button" data-type="telefono">Añadir teléfono</button>
                        </div>
                        <div class="input-group">
                            <label>Correo electrónico</label>
                            <button type="button" class="add-button" data-type="correo">Añadir correo electrónico</button>
                        </div>
                        <div class="input-group">
                            <label>Red social</label>
                            <button type="button" class="add-button" data-type="redSocial">Añadir red social</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <h3 class="section-title">Datos de Nacionalidad</h3>
                        <div class="input-group">
                            <label>Pasaporte</label>
                            <input type="text" value="1600890352">
                        </div>
                        <div class="input-group">
                            <label>Fecha de caducidad del pasaporte</label>
                            <input type="date" value="2022-09-08">
                        </div>
                        <div class="input-group">
                            <button type="button" class="add-button" data-type="nacionalidad">Añadir nacionalidad</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
    document.querySelectorAll(".add-button").forEach((button) => {
        button.addEventListener("click", function () {
            const type = button.getAttribute("data-type");
            const parent = button.parentElement;

            // Crear campo dinámico con botón de eliminar
            const dynamicField = document.createElement("div");
            dynamicField.className = "dynamic-field";

            const input = document.createElement("input");
            input.type = "text";
            input.placeholder = `Nuevo ${type}`;

            const deleteButton = document.createElement("button");
            deleteButton.className = "delete-button";
            deleteButton.innerHTML = "&#x2715;"; // Símbolo X
            deleteButton.addEventListener("click", function () {
                parent.removeChild(dynamicField);
            });

            dynamicField.appendChild(input);
            dynamicField.appendChild(deleteButton);
            parent.insertBefore(dynamicField, button);
        });
    });
</script>

<?php require_once "vistas/parte_inferior.php" ?>
