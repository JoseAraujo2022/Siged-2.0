<?php require_once "vistas/parte_superior.php" ?>

<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }

    .section {
        border: 1px solid #ddd;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 4px;
        background-color: #f8f9fa;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 10px;
        color: #4e73df !important;
    }

    .form-row {
        display: flex;
        flex-wrap: wrap;
        margin-bottom: 15px;
        gap: 20px;
    }

    .form-group {
        flex: 1;
        min-width: 250px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        color: #333;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    .required::after {
        content: " *";
        color: red;
    }

    .photo-container {
        width: 150px;
        height: 180px;
        border: 1px solid #ddd;
        margin-left: 20px;
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .photo-upload {
        text-align: center;
    }

    .button-group {
        text-align: center;
        margin-top: 20px;
    }

    .btn {
        padding: 8px 20px;
        margin: 0 5px;
        border: 1px solid #ddd;
        border-radius: 4px;
        cursor: pointer;
        background-color: #fff;
    }

    .btn-primary {
        background-color: #004AAD;
        color: white;
        border-color: #004AAD;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
        border-color: #dc3545;
    }

    @media (max-width: 768px) {
        .form-group {
            flex: 100%;
        }

        .photo-container {
            margin: 20px auto;
        }

        .form-row {
            flex-direction: column;
        }
    }

    @media (max-width: 576px) {
        .section {
            padding: 10px;
        }

        .section-title {
            font-size: 1rem;
        }

        .btn {
            padding: 6px 15px;
            font-size: 14px;
        }

        .photo-container {
            width: 120px;
            height: 150px;
        }
    }
</style>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Registro de Personas</h6>
        </div>
        <div class="card-body">
            <form id="registroForm">
                <div class="section">
                    <div class="section-title">Datos Personales</div>
                    <div style="display: flex; flex-wrap: wrap;">
                        <div style="flex: 1; min-width: 250px;">
                            <div class="form-group">
                                <label class="form-label">Nombres</label>
                                <input type="text" class="form-control" id="nombre" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Identificacion</label>
                                <input type="text" class="form-control" id="cedula" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required">Tipo de Sangre</label>
                                    <select required>
                                        <option value="">Seleccione</option>
                                        <option>A+</option>
                                        <option>A-</option>
                                        <option>B+</option>
                                        <option>B-</option>
                                        <option>AB+</option>
                                        <option>AB-</option>
                                        <option>O+</option>
                                        <option>O-</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tipo</label>
                                    <select required>
                                        <option value="">Seleccione</option>
                                        <option>Deportista</option>
                                        <option>Entrenador</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required">Deporte</label>
                                    <select required>
                                        <option value="">Seleccione</option>
                                        <option>Atletismo</option>
                                        <option>Ajedrez</option>
                                        <option>Boxeo</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Genero</label>
                                    <select required>
                                        <option value="">Seleccione</option>
                                        <option>Hombre</option>
                                        <option>Mujer</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Estado</label>
                                    <select required>
                                        <option value="">Activo</option>
                                        <option>Historico</option>
                                        <option>Inactivo</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        <div class="photo-container">
                            <div class="photo-upload">
                                <img id="preview" style="display: none; max-width: 100%; max-height: 100%;">
                                <input type="file" id="foto" accept="image/*" style="display: none;">
                                <button type="button" class="btn" onclick="document.getElementById('foto').click()">
                                    Seleccionar archivo
                                </button>
                                <div>Ningún archivo seleccionado</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section">
                    <div class="section-title">Datos de Residencia</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Ciudad</label>
                            <input type="text" class="form-control" value="Guayaquil">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Dirección</label>
                            <input type="text" class="form-control" value="fortin">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Teléfono</label>
                            <input type="text" class="form-control" value="1600890352">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Celular</label>
                            <input type="text" class="form-control" value="1600890352">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Contacto</label>
                            <input type="text" class="form-control" value="1600890352">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Correo electrónico</label>
                            <input type="text" class="form-control" value="@gmail.com">
                        </div>
                    </div>
                </div>

                <div class="section">
                    <div class="section-title">Formación Académica</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Primaria</label>
                            <input type="text" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Secundaria</label>
                            <input type="text" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Superior</label>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Otros</label>
                            <input type="text" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Idiomas</label>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn">Editar</button>
                    <button type="button" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('foto').addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const preview = document.getElementById('preview');
                preview.src = e.target.result;
                preview.style.display = 'block';
                preview.parentElement.querySelector('div').style.display = 'none';
                preview.parentElement.querySelector('button').style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('registroForm').addEventListener('submit', function (e) {
        e.preventDefault();
        alert('Formulario enviado');
    });
</script>

<?php require_once "vistas/parte_inferior.php" ?>