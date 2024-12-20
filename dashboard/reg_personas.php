<?php require_once "vistas/parte_superior.php" ?>
<?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT PER_ID, PER_NOMBRES, PER_APELLIDOS, PER_CEDULA, PER_PASAPORTE, PER_DEPORTE, PER_FECHANACIMIENTO, PER_FECH_VENCE_PASS, 
PER_DIRECCION FROM tb_personas";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$personas = $resultado->fetchAll(PDO::FETCH_ASSOC);


$consulta = "SELECT PAI_ID, PAI_NOMBRE FROM tb_pais";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "SELECT PRO_ID, PRO_DESCRIPCION FROM tb_provincias_pais";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$provincia = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "SELECT CIU_CODIGO, DESCRIPCION FROM tb_prov_ciudad";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$ciudad = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "SELECT TB_IDTIPO, TB_DESCRIPCION FROM tb_tipo_persona";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$tipo = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "SELECT DEP_ID, DEP_DESCRIPCION FROM tb_deportes";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$deportes = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>
<style>
    .selected-row {
        background-color: #d1ecf1;
        /* Un azul claro */
        color: #0c5460;
        /* Texto oscuro */
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }

    .centered-btn {
        display: block;
        margin: 0 auto;
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

        button {
            margin: 10px 0;
            padding: 5px;
            width: 100%;
        }
    }

    .modal-header {
        cursor: move;
    }

    .modal-dialog {
        display: flex;
        justify-content: center;
        align-items: center;
        width: auto;
        max-width: 100%;
        margin: 1rem;
    }

    .modal-content {
        width: 60%;
        max-width: 60%;
        height: auto;
        max-height: calc(100vh - 2rem);
        overflow-y: auto;
        overflow-x: hidden;
    }

    @media (max-width: 768px) {
        .container {
            padding: 1rem;
        }
    }
</style>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Registro de Personas</h6>
        </div>
        <div class="card-body">
            <form id="registroForm" action="bd/crud.php" method="POST" enctype="multipart/form-data">
                <div class="section">
                    <div class="section-title">Datos Personales</div>
                    <div style="display: flex; flex-wrap: wrap;">
                        <div style="flex: 1; min-width: 250px;">
                            <div class="form-group">
                                <button id="openModal" data-toggle="modal" data-target="#modalCRUD" class="btn">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <label class="form-label">Nombres</label>
                                <input type="text" name="nombres" type="text" class="form-control" id="nombres"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Apellidos</label>
                                <input type="text" name="apellidos" type="text" class="form-control" id="apellidos"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Identificacion</label>
                                <input type="text" name="cedula" type="text" class="form-control" id="cedula" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Fecha de Nacimiento</label>
                                <input type="date" name="fecha_nacimiento" type="text" id="fecha_nacimiento"
                                    class="form-control" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Pais de Nacimiento</label>
                                    <select id="pais_nacimiento" type="text" name="pais_nacimiento" class="form-control"
                                        required>
                                        <option value="">Seleccione un País</option>
                                        <?php
                                        foreach ($data as $pais):
                                            echo '<option value="' . $pais["PAI_ID"] . '">' . $pais["PAI_NOMBRE"] . '</option>';
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Provincia de Nacimiento</label>
                                    <select id="provincia_nacimiento" type="text" name="provincia_nacimiento"
                                        class="form-control" required>
                                        <option value="">Seleccione una Provincia</option>
                                        <?php
                                        foreach ($provincia as $pro):
                                            echo '<option value="' . $pro["PRO_ID"] . '">' . $pro["PRO_DESCRIPCION"] . '</option>';
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Ciudad de Nacimiento</label>
                                    <select id="ciudad_nacimiento" type="text" name="ciudad_nacimiento"
                                        class="form-control" required>
                                        <option value="">Seleccione una Ciudad</option>
                                        <?php
                                        foreach ($ciudad as $ciu):
                                            echo '<option value="' . $ciu["CIU_CODIGO"] . '">' . $ciu["DESCRIPCION"] . '</option>';
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="">Representa a</label>
                                    <select class="form-control" type="text" name="provincia_representa"
                                        id="provincia_representa" required>
                                        <option value="">Seleccione una Provincia</option>
                                        <?php
                                        foreach ($provincia as $pro):
                                            echo '<option value="' . $pro["PRO_ID"] . '">' . $pro["PRO_DESCRIPCION"] . '</option>';
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="">Tipo de Sangre</label>
                                    <select class="form-control" type="text" name="tipo_sangre" id="tipo_sangre"
                                        required>
                                        <option>Seleccione un Tipo de Sangre</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Funcion</label>
                                    <select class="form-control" type="text" name="tipo_persona" id="tipo_persona"
                                        required>
                                        <option value="">Seleccione un Tipo</option>
                                        <?php
                                        foreach ($tipo as $tipos):
                                            echo '<option value="' . $tipos["TB_IDTIPO"] . '">' . $tipos["TB_DESCRIPCION"] . '</option>';
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="">Deporte</label>
                                    <select class="form-control" type="text" name="deporte" id="deporte" required>
                                        <option value="">Seleccione un Deporte</option>
                                        <?php
                                        foreach ($deportes as $deporte):
                                            echo '<option value="' . $deporte["DEP_ID"] . '">' . $deporte["DEP_DESCRIPCION"] . '</option>';
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Genero</label>
                                    <select class="form-control" type="text" name="genero" id="genero" required>
                                        <option value="">Seleccione un Genero</option>
                                        <option value="M">Hombre</option>
                                        <option value="F">Mujer</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Estado</label>
                                    <select class="form-control" type="select" name="estado" id="estado" required>
                                        <option value="">Seleccion un Estado</option>
                                        <option value="A">Activo</option>
                                        <option value="H">Historico</option>
                                        <option value="I">Inactivo</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="photo-container">
                            <div class="photo-upload">
                                <img id="preview" style="display: none; max-width: 100%; max-height: 100%;">
                                <input type="file" id="foto" name="foto" accept="image/*" style="display: none;">
                                <button type="button" class="btn" onclick="document.getElementById('foto').click()">
                                    Seleccionar archivo
                                </button>
                                <div>Ningún archivo seleccionado</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Nationality information -->
                <div class="section">
                    <div class="section-title">Documentos Personales</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Pasaporte</label>
                            <input type="text" class="form-control" name="pasaporte" id="pasaporte" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Fecha Ex. del pasaporte</label>
                            <input type="date" class="form-control" name="venc_pasaporte" id="venc_pasaporte" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nacionalidad</label>
                            <select class="form-control" type="select" name="nacionalidad" id="nacionalidad">
                                <option value="">Seleccion una Nacionalidad</option>
                                <option value="Ecuatoriana">Ecuatoriano/-a</option>
                                <option value="Argentino">Argentino/-a</option>
                                <option value="Canadiense">Canadiense</option>
                                <option value="Colombiano">Colombiano/-a</option>
                                <option value="Chileno">Chileno/-a</option>
                                <option value="Estadounidense">Estadounidense</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Fecha Ex. Cédula</label>
                            <input type="date" name="venc_cedula" class="form-control" id="venc_cedula" required>
                        </div>
                    </div>
                </div>

                <div class="section">
                    <div class="section-title">Datos de Residencia</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Ciudad</label>
                            <input type="text" class="form-control" name="ciudad_reside" id="ciudad_reside" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Dirección</label>
                            <input type="text" class="form-control" name="direccion" id="direccion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Celular</label>
                            <input type="text" class="form-control" name="celular" id="celular" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Contacto</label>
                            <input type="text" class="form-control" name="nombre_contacto" id="nombre_contacto"
                                required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Correo electrónico</label>
                            <input type="text" class="form-control" name="email" id="email" required>
                        </div>
                    </div>
                </div>

                <div class="section">
                    <div class="section-title">Formación Académica</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Primaria</label>
                            <input type="text" class="form-control" name="primaria" id="primaria" value="">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Secundaria</label>
                            <input type="text" class="form-control" name="secundaria" id="secundaria" value="">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Superior</label>
                            <input type="text" class="form-control" name="superior" id="superior" value="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Otros</label>
                            <input type="text" class="form-control" name="otros_estudios" id="otros_estudios" value="">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Idiomas</label>
                            <input type="text" class="form-control" name="idiomas" id="idiomas" value="">
                        </div>
                    </div>
                </div>
                <div class="button-group">
                    <button type="submit" id="btn_guardar" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn">Editar</button>
                    <button type="button" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalCRUD" tabindex="-1" aria-labelledby="modalCRUDLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="overflow: hidden;">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCRUDLabel">Consulta de Personas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para ingresar los datos del deportista -->
                    <form id="formConsulta" method="POST">
                        <div class="section">
                            <div class="row">
                                <div class="col-3">
                                    <label for="deporte">Deporte</label>
                                    <select class="form-control" id="deporte" name="deporte">
                                        <option value="">Todos</option>
                                        <?php
                                        foreach ($deportes as $deporte) {
                                            echo "<option value='" . $deporte['DEP_ID'] . "'>" . $deporte['DEP_DESCRIPCION'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre">
                                </div>
                                <div class="col-3">
                                    <label for="apellidos">Apellidos</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos">
                                </div>
                                <div class="col-3">
                                    <button type="button" id="btnBuscar" class="btn btn-primary">Consultar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="section">
                        <div class="table-responsive">
                            <table class="table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Apellidos</th>
                                        <th>Nombres</th>
                                        <th>Cédula</th>
                                        <th>Pasaporte</th>
                                        <th>Deporte</th>
                                        <th>Fec. Nac.</th>
                                    </tr>
                                </thead>
                                <tbody id="resultados">
                                    <!-- Aquí se insertarán las filas con los datos -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    document.getElementById("btnBuscar").addEventListener("click", function () {
        var deporte = document.getElementById("deporte").value.trim();
        var nombre = document.getElementById("nombre").value.trim();
        var apellidos = document.getElementById("apellidos").value.trim();
        var pasaporte = document.getElementById("pasaporte").value.trim();
        var fecha_nacimiento = document.getElementById("fecha_nacimiento").value.trim();

        var tbody = document.getElementById("resultados");
        tbody.innerHTML = ""; // Limpiar resultados anteriores

        var data = {};
        if (deporte) data.deporte = deporte;
        if (nombre) data.nombre = nombre;
        if (apellidos) data.apellidos = apellidos;
        if (pasaporte) data.pasaporte = pasaporte;
        if (fecha_nacimiento) data.fecha_nacimiento = fecha_nacimiento;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "consulta_personas.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        var params = new URLSearchParams(data).toString();
        xhr.send(params);

        xhr.onload = function () {
            if (xhr.status == 200) {
                var resultados = JSON.parse(xhr.responseText);

                // Verificar qué datos se están recibiendo
                console.log(resultados);

                // Recorrer los resultados y agregarlos a la tabla
                resultados.forEach(function (persona, index) {
                    var row = document.createElement("tr");

                    var cell1 = document.createElement("td");
                    cell1.textContent = index + 1;
                    var cell2 = document.createElement("td");
                    cell2.textContent = persona.PER_NOMBRES;
                    var cell3 = document.createElement("td");
                    cell3.textContent = persona.PER_APELLIDOS;
                    var cell4 = document.createElement("td");
                    cell4.textContent = persona.PER_CEDULA;
                    var cell5 = document.createElement("td");
                    cell5.textContent = persona.PER_PASAPORTE;
                    var cell6 = document.createElement("td");
                    cell6.textContent = persona.DEPORTE;
                    var cell7 = document.createElement("td");
                    cell7.textContent = persona.PER_FECHANACIMIENTO;

                    row.appendChild(cell1);
                    row.appendChild(cell2);
                    row.appendChild(cell3);
                    row.appendChild(cell4);
                    row.appendChild(cell5);
                    row.appendChild(cell6);
                    row.appendChild(cell7);

                    tbody.appendChild(row);

                    // Añadir evento click a cada fila
                    row.addEventListener("click", function () {
                        // Remover clase seleccionada de otras filas
                        var rows = tbody.querySelectorAll("tr");
                        rows.forEach(function (r) {
                            r.classList.remove("selected-row");
                        });

                        // Agregar clase seleccionada a la fila actual
                        row.classList.add("selected-row");

                        // Mostrar los valores recibidos en el formulario
                        document.getElementById("nombres").value = persona.PER_NOMBRES;
                        document.getElementById("apellidos").value = persona.PER_APELLIDOS;
                        document.getElementById("cedula").value = persona.PER_CEDULA;
                        document.getElementById("pasaporte").value = persona.PER_PASAPORTE;
                        document.getElementById("deporte").value = persona.DEPORTE;
                        document.getElementById("fecha_nacimiento").value = persona.PER_FECHANACIMIENTO;

                        // Verifica si todos los campos están disponibles
                        document.getElementById("ciudad_nacimiento").value = persona.PER_CIUDAD_NACIMIENTO || '';
                        document.getElementById("provincia_nacimiento").value = persona.PER_PROVINCIA || '';
                        document.getElementById("pais_nacimiento").value = persona.PER_PAIS || '';
                        document.getElementById("tipo_sangre").value = persona.PER_TIPO_SANGRE || '';
                        document.getElementById("tipo_persona").value = persona.PER_IDTIPO || '';
                        document.getElementById("genero").value = persona.PER_SEXO || '';
                        document.getElementById("estado").value = persona.PER_ESTADO || '';
                        document.getElementById("venc_pasaporte").value = persona.PER_FECH_VENCE_PASS || '';
                        document.getElementById("nacionalidad").value = persona.PER_NACIONALIDAD || '';
                        document.getElementById("venc_cedula").value = persona.PER_FECH_VENCE_CED || '';
                        document.getElementById("ciudad_reside").value = persona.PER_CIUDAD_RESIDE || '';
                        document.getElementById("direccion").value = persona.PER_DIRECCION || '';
                        document.getElementById("telefono").value = persona.PER_FONOCONVENCIONAL || '';
                        document.getElementById("nombre_contacto").value = persona.PER_NOMBRE_CONTACTO || '';
                        document.getElementById("email").value = persona.PER_EMAIL || '';
                        document.getElementById("primaria").value = persona.PER_ESCUELA || '';
                        document.getElementById("secundaria").value = persona.PER_COLEGIO || '';
                        document.getElementById("superior").value = persona.PER_SUPERIOR || '';
                        document.getElementById("otros").value = persona.PER_EDUCACION_OTROS || '';
                        document.getElementById("idiomas").value = persona.PER_IDIOMAS || '';

                        // Cerrar el modal con Bootstrap 5
                        var myModal = new bootstrap.Modal(document.getElementById('modalCRUD'));
                        myModal.hide();
                    });
                });
            } else {
                console.error("Error al realizar la consulta.");
            }
        };
    });
</script>

<?php require_once "vistas/parte_inferior.php" ?>