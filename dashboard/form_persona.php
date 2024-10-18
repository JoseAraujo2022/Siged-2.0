<?php require_once "vistas/parte_superior.php" ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .breadcrumb {
            margin-bottom: 20px;
        }

        .breadcrumb a {
            color: #666;
            text-decoration: none;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .tabs {
            display: flex;
            gap: 20px;
        }

        .tab {
            cursor: pointer;
            padding: 5px 10px;
            border-bottom: 2px solid transparent;
        }

        .tab.active {
            border-bottom-color: #00a86b;
        }

        .buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-cancel {
            background-color: #f0f0f0;
        }

        .btn-save {
            background-color: #00a86b;
            color: white;
        }

        .form-section {
            margin-bottom: 20px;
        }

        .row {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }

        .col-4 {
            flex: 1;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .radio-group {
            display: flex;
            gap: 15px;
        }

        .photo-upload {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .photo-placeholder {
            width: 100px;
            height: 100px;
            background-color: #f0f0f0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #999;
            position: relative;
            overflow: hidden;
        }

        .photo-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .photo-remove {
            position: absolute;
            top: 0;
            right: 0;
            background-color: red;
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            cursor: pointer;
        }

        .contact-info {
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 4px;
        }

        .expandable {
            cursor: pointer;
        }

        .expandable::after {
            content: '▼';
            margin-left: 5px;
        }

        .add-button {
            background-color: transparent;
            border: none;
            color: #00a86b;
            cursor: pointer;
        }

        .add-button::before {
            content: '+';
            margin-right: 5px;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
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
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #00a86b;
        }

        input:checked+.slider:before {
            transform: translateX(26px);
        }
    </style>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <nav class="nav">
                <div class="nav-items">
                    <div class="buttons">
                        <a href="tabla_persona.php" class="btn">← Volver</a>
                        <a href="tabla_persona.php" class="btn btn-primary">Información personal</a>
                        <a href="tabla_deportistas.php" class="btn btn-primary">Ayudas y becas</a>
                        <a href="resultados_deportivos.php" class="btn btn-primary">Resultados deportivos</a>
                    </div>
                </div>
                <a href="form_persona.php" class="btn btn-primary">
                    <svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">

                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                    Editar datos
                </a>
            </nav>
        </div>
        <form>
            <div class="form-section">
                <h2>Datos personales</h2>
                <div class="row">
                    <div class="col-4 radio-group">
                        <label>
                            <input type="radio" name="gender" value="hombre"> Hombre
                        </label>
                        <label>
                            <input type="radio" name="gender" value="mujer" checked> Mujer
                        </label>
                    </div>
                    <div class="col-4">
                        <label>Fallecido</label>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="photo-upload">
                        <div class="photo-placeholder">
                            <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-7JjvLoihvFeuLxzD7ojCHIN4NsKf9O.png"
                                alt="Profile photo">
                            <button class="photo-remove">✕</button>
                        </div>
                        <div>
                            <p>Foto</p>
                            <small>max. 1MB (1000KB)</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="tratamiento">Tratamiento</label>
                        <select id="tratamiento">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="titulo">Título</label>
                        <select id="titulo">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" value="NEISI PATRICIA">
                    </div>
                    <div class="col-4">
                        <label for="nombreNormalizado">Nombre normalizado</label>
                        <input type="text" id="nombreNormalizado" value="NEISI PATRICIA">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="primerApellido">Primer apellido</label>
                        <input type="text" id="primerApellido" value="DAJOMES">
                    </div>
                    <div class="col-4">
                        <label for="primerApellidoNormalizado">Primer apellido normalizado</label>
                        <input type="text" id="primerApellidoNormalizado" value="DAJOMES">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="segundoApellido">Segundo apellido</label>
                        <input type="text" id="segundoApellido" value="BARRERA">
                    </div>
                    <div class="col-4">
                        <label for="segundoApellidoNormalizado">Segundo apellido normalizado</label>
                        <input type="text" id="segundoApellidoNormalizado" value="BARRERA">
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h2>DATOS DE NACIMIENTO</h2>
                <div class="row">
                    <div class="col-4">
                        <label for="pais">País*</label>
                        <select id="pais">
                            <option>Ecuador</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="primeraSubdivision">Primera subdivisión</label>
                        <select id="primeraSubdivision">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="segundaSubdivision">Segunda subdivisión</label>
                        <input type="text" id="segundaSubdivision">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="fechaNacimiento">Fecha de nacimiento</label>
                        <input type="date" id="fechaNacimiento" value="1998-12-03">
                    </div>
                    <div class="col-4">
                        <label for="poblacionNacimiento">Población de nacimiento</label>
                        <input type="text" id="poblacionNacimiento" value="PASTAZA">
                    </div>
                    <div class="col-4">
                        <label for="poblacionNacimientoNormalizada">Población de nacimiento normalizada</label>
                        <input type="text" id="poblacionNacimientoNormalizada" value="PASTAZA">
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h2>DATOS DE NACIONALIDAD</h2>
                <div class="row">
                    <div class="col-4">
                        <label for="pasaporte">Pasaporte</label>
                        <input type="text" id="pasaporte" value="1600800352">
                    </div>
                    <div class="col-4">
                        <label for="fechaCaducidadPasaporte">Fecha de caducidad del pasaporte</label>
                        <input type="date" id="fechaCaducidadPasaporte" value="2022-08-09">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="documentoIdentificacion">Documento de identificación</label>
                        <input type="text" id="documentoIdentificacion">
                    </div>
                    <div class="col-4">
                        <label for="fechaCaducidadDocumento">Fecha de caducidad del documento de
                            identificación</label>
                        <input type="date" id="fechaCaducidadDocumento">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="nacionalidades" class="expandable">Nacionalidades</label>
                        <select id="nacionalidades">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <button class="add-button">Añadir nacionalidad</button>
            </div>
            <div class="form-section contact-info">
                <h2>DATOS DE CONTACTO</h2>
                <p class="expandable">Teléfono</p>
                <button class="add-button">Teléfono</button>
                <p class="expandable">Correo electrónico</p>
                <button class="add-button">Correo electrónico</button>
                <p class="expandable">Red social</p>
                <button class="add-button">Red social</button>
                <p class="expandable">Direcciones Postales</p>
                <button class="add-button">Añadir dirección postal</button>
            </div>
        </form>
    </div>
</div>

<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php" ?>