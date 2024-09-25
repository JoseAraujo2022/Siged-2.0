<!--INICIO del cont principal-->
<?php require_once "vistas/parte_superior.php" ?>

<!--INICIO del cont principal-->
<div class="container-fluid">



    <?php
    include_once 'bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    $consulta = "SELECT id, nombre, apellidos, federaciones, fecha_nacimiento, pais_nacimiento FROM oficiales";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    ?>


    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Oficiales</h6>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-2">
                    <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Añadir oficial
                    </button>
                </div>
                <div class="col-lg-2">
                    <button id="btnNuevo1" type="button" class="btn btn-success" data-toggle="modal">Añadir persona
                        existente</button>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tablaDeportistas" class="table table-bordered" style="width: 100%">
                        <thead class="text-center">
                            <tr>
                                <th>Foto</th>
                                <th>Nombre </th>
                                <th>Apellidos</th>
                                <th>Federaciones</th>
                                <th>Fecha de Nacimiento</th>
                                <th>Pais de Nacimiento</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $dat) {
                                ?>
                                <tr class="text-center">
                                    <td><img style="height: 2rem;  width: 2rem;" src="img/user.png"></td>
                                    <td><?php echo $dat['nombre'] ?></td>
                                    <td><?php echo $dat['apellidos'] ?></td>
                                    <td><?php echo $dat['federaciones'] ?></td>
                                    <td><?php echo $dat['fecha_nacimiento'] ?></td>
                                    <td><?php echo $dat['pais_nacimiento'] ?></td>
                                    <td></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <!--Modal para CRUD-->
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
                    <form id="formPersonas">
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
                                <button type="submit" id="btnGuardar" class="btn btn-primary">Guardar</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--FIN del cont principal-->

    <?php require_once "vistas/parte_inferior.php" ?>