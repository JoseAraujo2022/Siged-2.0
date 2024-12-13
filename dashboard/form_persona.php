<?php require_once "vistas/parte_superior.php" ?>

<style>
    :root {
        --primary-color: #0066cc;
        --border-color: #e0e0e0;
        --error-color: #dc3545;
        --text-color: #333;
        --background-white: #fff;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .form-section {
        margin-bottom: 2rem;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: var(--text-color);
    }

    /* Header controls */
    .header-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .gender-group {
        display: flex;
        gap: 1.5rem;
    }

    /* Switch toggle */
    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 24px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked+.slider {
        background-color: var(--primary-color);
    }

    input:checked+.slider:before {
        transform: translateX(26px);
    }


    /* Photo upload * justify-content: flex-end;*/
    .photo-section {
        display: flex;
        justify-content: center;
        margin-bottom: 2rem;
    }

    .photo-container {
        position: relative;
        width: 100px;
        height: 100px;
    }

    .photo-upload {
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

    .photo-text {
        text-align: center;
        font-size: 0.9rem;
        color: #666;
    }

    .photo-size {
        font-size: 0.8rem;
        color: #999;
    }



    .collapsible:after {
        content: '▼';
        font-size: 0.8rem;
        color: #666;
    }

    .collapsible.active:after {
        content: '▲';
    }

    .collapsible-content {
        display: none;
        padding: 1rem 0;
    }

    /* Add buttons */
    .add-button {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem;
        width: 100%;
        background: none;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        cursor: pointer;
        color: var(--primary-color);
        font-size: 0.9rem;
    }

    .add-button:hover {
        background-color: #f5f5f5;
    }

    /* Added items */
    .added-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
        padding: 0.5rem;
        background-color: #f8f8f8;
        border-radius: 4px;
    }

    .item-type {
        min-width: 120px;
    }

    .remove-button {
        color: var(--error-color);
        background: none;
        border: none;
        cursor: pointer;
        font-size: 1.2rem;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .container {
            padding: 1rem;
        }
    }
</style>
<div class="modal-dialog"">
    <div class="modal-content">
        <div class="modal-header">
            <h6 class="m-0 font-weight-bold text-primary">Formulario de Datos Personales</h6>
        </div>
        <div class="card-body">
            <form id="personalDataForm">
                <div class="section-title">Datos Personales</div>

                <!-- Header controls -->
                <div class="header-controls">
                    <div class="gender-group">
                        <label>
                            <input type="radio" name="gender" value="hombre"> Hombre
                        </label>
                        <label>
                            <input type="radio" name="gender" value="mujer" checked> Mujer
                        </label>
                    </div>
                    <div class="status-group">
                        <span>Fallecido</span>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>

                <!-- Photo upload -->
                <div class="photo-section">
                    <div class="photo-container">
                        <div class="photo-upload" id="photoUpload">
                            <img id="photoPreview" style="display: none; width: 100%; height: 100%; object-fit: cover;">
                            <div class="photo-text">
                                <div>Foto</div>
                                <div class="photo-size">max. 1MB (1000KB)</div>
                            </div>
                        </div>
                        <input type="file" id="photoInput" hidden accept="image/*">
                    </div>
                </div>

                <!-- Personal information -->
                <div class="form-group">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" value="NEISI PATRICIA">
                </div>

                <div class="form-group">
                    <label class="form-label">Primer apellido</label>
                    <input type="text" class="form-control" value="DAJOMES">
                </div>

                <div class="form-group">
                    <label class="form-label">Segundo apellido</label>
                    <input type="text" class="form-control" value="BARRERA">
                </div>

                <!-- Birth information -->
                <div class="form-section">
                    <div class="section-title">Datos de Nacimiento</div>

                    <div class="form-group">
                        <label class="form-label">País *</label>
                        <select class="form-control">
                            <option value="ecuador" selected>Ecuador</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Fecha de nacimiento</label>
                        <input type="date" class="form-control" value="1998-05-12">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Población de nacimiento</label>
                        <select class="form-control">
                            <option value="pastaza" selected>Pastaza</option>
                        </select>
                    </div>
                </div>

                <!-- Contact information -->
                <div class="form-section">
                    <div class="section-title">Datos de contacto</div>
                    <div id="phoneContainer"></div>
                    <button type="button" class="add-button" onclick="addPhone()">
                        + Añadir teléfono
                    </button>
                    <br>
                    <div id="emailContainer"></div>
                    <button type="button" class="add-button" onclick="addEmail()">
                        + Añadir correo electrónico
                    </button>
                    <br>
                    <div id="socialContainer"></div>
                    <button type="button" class="add-button" onclick="addSocial()">
                        + Añadir red social
                    </button>
                </div>

                <!-- Nationality information -->
                <div class="form-section">
                    <div class="section-title">Datos de Nacionalidad</div>

                    <div class="form-group">
                        <label class="form-label">Pasaporte</label>
                        <input type="text" class="form-control" value="1600890352">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Fecha de caducidad del pasaporte</label>
                        <input type="date" class="form-control" value="2022-09-08">
                    </div>
                </div>

                <!-- Nationality add-->
                <div class="form-section">
                    <div class="section-title">Nacionalidades</div>
                    <div id="nationalityContainer"></div>
                    <button type="button" class="add-button" onclick="addNationality()">
                        + Añadir nacionalidad
                    </button>
                </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="submit" class="btn btn-secondary">Cancelar</button>
        </div>

        </form>
    </div>
</div>

<script>
    // Collapsible functionality
    document.querySelectorAll('.collapsible').forEach(button => {
        button.addEventListener('click', function () {
            this.classList.toggle('active');
            const content = this.nextElementSibling;
            if (content.style.display === 'block') {
                content.style.display = 'none';
            } else {
                content.style.display = 'block';
            }
        });
    });

    // Photo upload functionality
    const photoUpload = document.getElementById('photoUpload');
    const photoInput = document.getElementById('photoInput');
    const photoPreview = document.getElementById('photoPreview');
    const photoText = document.querySelector('.photo-text');

    photoUpload.addEventListener('click', () => photoInput.click());

    photoInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file && file.size <= 1000000) { // 1MB limit
            const reader = new FileReader();
            reader.onload = function (e) {
                photoPreview.src = e.target.result;
                photoPreview.style.display = 'block';
                photoText.style.display = 'none';
            }
            reader.readAsDataURL(file);
        } else {
            alert('La imagen debe ser menor a 1MB');
        }
    });

    // Add item functions
    function createAddedItem(type, options = ['Casa', 'Trabajo', 'Móvil']) {
        const item = document.createElement('div');
        item.className = 'added-item';

        const select = document.createElement('select');
        select.className = 'form-control item-type';
        options.forEach(option => {
            const opt = document.createElement('option');
            opt.value = option.toLowerCase();
            opt.textContent = option;
            select.appendChild(opt);
        });

        const input = document.createElement('input');
        input.type = type;
        input.className = 'form-control';

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'remove-button';
        removeBtn.textContent = '×';
        removeBtn.onclick = () => item.remove();

        item.appendChild(select);
        item.appendChild(input);
        item.appendChild(removeBtn);

        return item;
    }

    function addPhone() {
        const container = document.getElementById('phoneContainer');
        container.appendChild(createAddedItem('tel', ['Casa', 'Trabajo', 'Móvil']));
    }

    function addEmail() {
        const container = document.getElementById('emailContainer');
        container.appendChild(createAddedItem('email', ['Principal', 'Trabajo', 'Personal']));
    }

    function addSocial() {
        const container = document.getElementById('socialContainer');
        container.appendChild(createAddedItem('text', ['500px', 'Facebook', 'Twitter', 'Instagram']));
    }

    function addNationality() {
        const container = document.getElementById('nationalityContainer');
        const item = document.createElement('div');
        item.className = 'added-item';

        const countrySelect = document.createElement('select');
        countrySelect.className = 'form-control';
        ['Ecuador', 'Colombia', 'Perú'].forEach(country => {
            const option = document.createElement('option');
            option.value = country.toLowerCase();
            option.textContent = country;
            countrySelect.appendChild(option);
        });

        const startDate = document.createElement('input');
        startDate.type = 'date';
        startDate.className = 'form-control';

        const endDate = document.createElement('input');
        endDate.type = 'date';
        endDate.className = 'form-control';

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'remove-button';
        removeBtn.textContent = '×';
        removeBtn.onclick = () => item.remove();

        item.appendChild(countrySelect);
        item.appendChild(startDate);
        item.appendChild(endDate);
        item.appendChild(removeBtn);

        container.appendChild(item);
    }
</script>

<?php require_once "vistas/parte_inferior.php" ?>