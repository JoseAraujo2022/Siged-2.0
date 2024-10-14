<!--INICIO del cont principal-->
<?php require_once "vistas/parte_superior.php" ?>
<!--INICIO del cont principal-->
<div class="container-fluid">
    <?php
    include_once 'bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    $consulta = "SELECT id, nombre, apellidos, federaciones, fecha_nacimiento, pais_nacimiento FROM deportistas";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <style>
        .medal {
            color: gold;
            margin-right: 5px;
        }

        details {
            margin-bottom: 20px;
        }

        summary {
            cursor: pointer;
            font-weight: bold;
            font-size: 20px;

        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .event-logo {
            width: 30px;
            height: 30px;
            margin-right: 10px;
            vertical-align: middle;
        }

        h1 {
            margin: 0 0 20px 0;
        }

        .bold {
            font-weight: bold;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-items {
            display: flex;
            gap: 20px;
        }

        .nav-item {
            text-decoration: none;
            color: black;
        }

        .dropdown::after {
            content: "▼";
            font-size: 0.7em;
            margin-left: 5px;
        }

        .buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-decoration: none;
            color: black;
        }

        .btn-primary {
            padding: 8px 16px;
            background-color: #00a86b;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .medal-card {
            background-color: white;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            padding: 20px;
            margin-top: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .medal-icon {
            font-size: 24px;
            margin-right: 10px;
        }
    </style>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <nav class="nav">
                <div class="nav-items">
                    <div class="buttons">
                        <a href="tabla_deportistas.php" class="btn">← Volver</a>
                        <a href="tabla_deportistas.php" class="btn btn-primary">Información personal</a>
                        <a href="tabla_deportistas.php" class="btn btn-primary">Ayudas y becas</a>
                        <a href="resultados_deportivos.php" class="btn btn-primary">Resultados deportivos</a>
                    </div>
                </div>
                <a href="#" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                    Editar datos
                </a>
            </nav>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <label for="nombre" class="col-form-label">Nombres:</label>
                    <label type="text" class="form-control" id="">JUAN PEPE</label>
                </div>
                <div class="col-6">
                    <label for="nombre" class="col-form-label"> Apellidos:</label>
                    <label type="text" class="form-control" id="">PRUEBA1</label>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="" class="col-form-label">Cédula:</label>
                    <label type="text" class="form-control" id="">1264567891</label>
                </div>
                <div class="col-6">
                    <label for="" class="col-form-label">Pasaporte:</label>
                    <label type="text" class="form-control" id="">126456789111</label>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="" class="col-form-label">Sexo:</label>
                    <label type="text" class="form-control" id="">Masculino</label>
                </div>
                <div class="col-6">
                    <label for="" class="col-form-label">Fecha de nacimiento:</label>
                    <label type="text" class="form-control" id="">12-05-2002</label>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="" class="col-form-label">País:</label>
                    <label type="text" class="form-control" id="">Ecuador</label>
                </div>
                <div class="col-6">
                    <label for="" class="col-form-label">Provincia:</label>
                    <label type="text" class="form-control" id="">Guayas</label>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="" class="col-form-label">Ciudad:</label>
                    <label type="text" class="form-control" id="">Guayaquil</label>
                </div>
                <div class="col-6">
                    <label for="" class="col-form-label">Fallecido:</label>
                    <label type="text" class="form-control" id="">No</label>
                </div>
            </div>
            <br>

        </div>
        <!--Modal para CRUD BOTON EDITAR -->
        <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formDeportistas">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-4">
                                    <label for="nombre" class="col-form-label">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre">
                                </div>
                                <div class="col-4">
                                    <label for="apellidos" class="col-form-label">Apellidos:</label>
                                    <input type="text" class="form-control" id="apellidos">
                                </div>
                                <div class="col-4">
                                    <label for="federaciones" class="col-form-label">Federaciones:</label>
                                    <input type="text" class="form-control" id="federaciones">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label for="fecha_nacimiento" class="col-form-label">Fecha de
                                        Nacimiento:</label>
                                    <input type="date" class="form-control" id="fecha_nacimiento">
                                </div>
                                <div class="col-4">
                                    <label for="pais_nacimiento" class="col-form-label">Pais de
                                        Nacimiento:</label>
                                    <input type="text" class="form-control" id="pais_nacimiento">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label for=""></label>
                                </div>
                                <div class="col-4">
                                    <label for=""></label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                                <button type="" id="btnGuardar" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php" ?>