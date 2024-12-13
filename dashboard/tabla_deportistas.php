<?php require_once "vistas/parte_superior.php" ?>

<?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "
    SELECT 
        p.PER_ID,
        p.PER_NOMBRES, 
        p.PER_APELLIDOS, 
        p.PER_FECHANACIMIENTO,
        p.PER_DEPORTE, 
        p.PER_PROVINCIA,
        d.PRO_DESCRIPCION AS PROVINCIA,
        t.DEP_DESCRIPCION AS DEPORTE
    FROM 
        tb_personas p
    JOIN 
        tb_deportes t ON p.PER_DEPORTE = t.DEP_ID
    JOIN 
        tb_provincias_pais d ON p.PER_PROVINCIA = d.PRO_ID;
    ";
$resultado = $conexion->prepare($consulta);
$resultado->execute(); // Ejecuta la consulta
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>
    <style>
            :root { --primary-color: #0066cc; --border-color: #e0e0e0; --error-color: #dc3545; --text-color: #333; --background-white: #fff; }
        * { margin: 0; padding: 0; box-sizing: border-box; }

        .form-label { display: block; margin-bottom: 0.5rem; color: #666; font-size: 0.9rem; }
        .form-section { margin-bottom: 2rem; }
        .section-title { font-size: 1.1rem; font-weight: 600; margin-bottom: 1rem; color: var(--text-color); }
        .header-controls { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .gender-group { display: flex; gap: 1.5rem; }

        .photo-section { flex: 0 0 150px; }
        .photo-container { position: relative; width: 150px; height: 150px; border-radius: 50%; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: 5px solid #0066cc; background-color: #f4f4f4; }
        .photo-upload img { width: 100%; height: 100%; object-fit: cover; }
        .photo-text { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; font-size: 0.9rem; color: #fff; font-weight: bold; z-index: 10; width: 100%; background-color: rgba(0, 0, 0, 0.5); padding: 5px; border-radius: 10px; }

        .add-button { display: flex; align-items: center; gap: 0.5rem; padding: 0.75rem; width: 100%; background: none; border: 1px solid var(--border-color); border-radius: 4px; cursor: pointer; color: var(--primary-color); font-size: 0.9rem; }
        .add-button:hover { background-color: #f5f5f5; }

        .added-item { display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem; padding: 0.5rem; background-color: #f8f8f8; border-radius: 4px; }
        .item-type { min-width: 120px; }

        .remove-button { color: var(--error-color); background: none; border: none; cursor: pointer; font-size: 1.2rem; }

        .preview-image { max-width: 100px; max-height: 100px; border-radius: 5px; }
        .passport-photo { margin-top: 1rem; padding: 1rem; border: 1px solid #ddd; border-radius: 4px; }
        .download-btn { background-color: #28a745; color: white; padding: 0.25rem 1.5rem; border: none; border-radius: 4px; cursor: pointer; display: inline-block; }

        .btn-primary { background-color: #00a86b; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .modal-header { cursor: move; }
        .modal-dialog { display: flex; justify-content: center; align-items: center; width: auto; max-width: 100%; margin: 1rem; }
        .modal-content { width: 60%; max-width: 60%; height: auto; max-height: calc(100vh - 2rem); overflow-y: auto; overflow-x: hidden; }

        @media (max-width: 768px) { .container { padding: 1rem; } }

    </style>
<!--INICIO del cont principal-->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Deportistas</h6>
        </div>
        <br>
        <div class="col-5">
            <nav class="nav">
                <div class="nav-items">
                    <div class="buttons">
                        <button id="" type="button" class="btn btn-success" data-toggle="modal"
                        data-target="#modalCRUD">Añadir deportista</button>
                    </div>
                </div>
            </nav>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tablaDeportistas" class="table table-bordered" style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th>id</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Deporte</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Provincia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data as $dat) {
                            ?>
                            <tr class="text-center">
                                <td><?php echo $dat['PER_ID'] ?></td>
                                <td><a
                                        href="tabla_persona.php?id=<?php echo $dat['PER_ID']; ?>"><?php echo $dat['PER_NOMBRES']; ?></a>
                                </td>
                                <td><?php echo $dat['PER_APELLIDOS'] ?></td>
                                <td><?php echo $dat['DEPORTE'] ?></td>
                                <td><?php echo $dat['PER_FECHANACIMIENTO'] ?></td>
                                <td><?php echo $dat['PROVINCIA'] ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal CRUD -->
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="m-0 font-weight-bold text-primary" id="exampleModalLabel">Nuevo deportista
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form id="formDeportistas">
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
                        </div>

                        <!-- Photo upload -->
                        <div class="photo-section">
                            <div class="photo-container">
                                <div class="photo-upload" id="photoUpload">
                                    <img id="photoPreview"
                                        style="display: none; width: 100%; height: 100%; object-fit: cover;">
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
                            <label class="form-label">Nombres</label>
                            <input type="text" class="form-control" id="nombre" required>
                        </div>


                        <div class="form-group">
                            <label class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" required>
                        </div>

                        <!-- Birth information -->
                        <div class="form-section">
                            <div class="section-title">Datos de Nacimiento</div>

                            <div class="form-group">
                                <label class="form-label">País </label>
                                <select class="form-control">
                                    <option value="ecuador" selected>Ecuador</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Fecha de nacimiento</label>
                                <input type="date" class="form-control" id="fecha_nacimiento" required>
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
                        <div class="form-group">
                            <label class="form-label">Foto del Pasaporte</label>
                            <input type="file" id="passportPhoto" accept="image/*" style="display: none;"
                                onchange="handleFileSelect(event)">
                            <button type="button" class="form-control"
                                onclick="document.getElementById('passportPhoto').click()">
                                Subir foto del pasaporte
                            </button>
                            <div class="file-info">Tamaño máximo: 1MB</div>
                            <div class="preview-container" id="previewContainer">
                                <img id="preview" class="preview-image" src="" alt="Vista previa del pasaporte">
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

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <button type="submit" class="btn btn-secondary">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
            // Subir pasaporte
        function handleFileSelect(event) {
            const file = event.target.files[0], maxSize = 1024 * 1024; // 1MB
            if (!file || file.size > maxSize) return alert('El archivo es demasiado grande. Por favor seleccione un archivo menor a 1MB.');
            const reader = new FileReader();
            reader.onload = e => {
                const preview = document.getElementById('preview');
                document.getElementById('previewContainer').style.display = 'block';
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
        // Foto upload
        document.getElementById('photoUpload').addEventListener('click', () => document.getElementById('photoInput').click());
        document.getElementById('photoInput').addEventListener('change', e => {
            const file = e.target.files[0];
            if (file && file.size <= 1000000) {
                const reader = new FileReader();
                reader.onload = e => {
                    document.getElementById('photoPreview').src = e.target.result;
                    document.querySelector('.photo-text').style.display = 'none';
                    document.getElementById('photoPreview').style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                alert('La imagen debe ser menor a 1MB');
            }
        });

        // Crear elementos agregados
        const createAddedItem = (type, options = []) => {
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
            item.append(select, input, removeBtn);
            return item;
        };

        // Funciones para agregar items
        const addPhone = () => document.getElementById('phoneContainer').appendChild(createAddedItem('tel', ['Casa', 'Trabajo', 'Móvil']));
        const addEmail = () => document.getElementById('emailContainer').appendChild(createAddedItem('email', ['Principal', 'Trabajo', 'Personal']));
        const addSocial = () => document.getElementById('socialContainer').appendChild(createAddedItem('text', ['Facebook', 'Twitter', 'Instagram']));
        const addNationality = () => {
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
            const startDate = document.createElement('input'), endDate = document.createElement('input');
            startDate.type = endDate.type = 'date';
            startDate.className = endDate.className = 'form-control';
            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'remove-button';
            removeBtn.textContent = '×';
            removeBtn.onclick = () => item.remove();
            item.append(countrySelect, startDate, endDate, removeBtn);
            document.getElementById('nationalityContainer').appendChild(item);
        };

        // Descargar foto de pasaporte
        const downloadPassportPhoto = () => {
            const link = document.createElement('a');
            link.href = 'Siged-2.0/fotos/foto.jpeg';
            link.download = 'foto_pasaporte.jpg';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        };
        </script>

<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php" ?>