<!--INICIO del cont principal-->
<?php require_once "vistas/parte_superior.php" ?>


<!--INICIO del cont principal-->
<div class="container-fluid">
    <?php
    include_once 'bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    $consulta = "SELECT PER_IDTIPO, PER_NOMBRES, PER_APELLIDOS, FROM tb_personas";
    $resultado = $conexion->prepare($consulta);
   
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <style>
        .button-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .add-button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
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

        .buttons {
            display: flex;
            gap: 10px;
        }

        .btn-primary {
            background-color: #009688;
            color: white;
            border: none;
        }
    </style>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" style="font-size: 20px;">Deportistas</h6>
        </div>
        <br>
        <div class="col-5">
            <nav class="nav">
                <div class="nav-items">
                    <div class="buttons">
                        <button id="btnNuevo" type="button" class="add-button" data-toggle="modal">Añadir
                            deportista</button>
            </nav>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tablaDeportistas" class="table table-bordered" style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th>Foto</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Deporte</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Provincia</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data as $dat) {
                            ?>
                            <tr class="text-center">
                                <td><img style="height: 2rem;  width: 2rem;" src="img/user.png"></td>
                                <td><a href="tabla_persona.php"><?php echo $dat['PER_NOMBRES'] ?></a></td>
                                <td><?php echo $dat['PER_NOMBRES'] ?></td>
                                <td><?php echo $dat['PER_NOMBRES'] ?></td>
                                <td><?php echo $dat['PER_NOMBRES'] ?></td>
                                <td><?php echo $dat['PER_NOMBRES'] ?></td>
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
                                <label for="nombre" class="col-form-label">Nombres:</label>
                                <input type="text" class="form-control" id="nombre">
                            </div>
                            <div class="col-4">
                                <label for="apellidos" class="col-form-label">Apellidos:</label>
                                <input type="text" class="form-control" id="apellidos">
                            </div>
                            <div class="col-4">
                                <label for="cedula" class="col-form-label">Cedula:</label>
                                <input type="text" class="form-control" id="cedula">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label for="pasaporte" class="col-form-label">Pasaporte:</label>
                                <input type="text" class="form-control" id="pasaporte">
                            </div>
                            <div class="col-4">
                                <label for="sexo" class="col-form-label">Sexo:</label>
                                <select name="sexo" class="form-control" id="sexo">
                                    <option value="">Seleccione</option>
                                    <option value="masculino">Masculino</option>
                                    <option value="femenino">Femenino</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="deporte" class="col-form-label">Deporte:</label>
                                <select name="deporte" class="form-control" id="deporte">
                                    <option value="">Seleccione</option>
                                    <option value="atletismo">Atletismo</option>
                                    <option value="natacion">Natacion</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label for="fecha_nacimiento" class="col-form-label">Fecha de
                                    Nacimiento:</label>
                                <input type="date" class="form-control" id="fecha_nacimiento">
                            </div>
                            <div class="col-4">
                                <label for="pais_nacimiento" class="col-form-label">Pais de Nacimiento:</label>
                                <select name="pais_nacimiento" class="form-control" id="pais_nacimiento">
                                    <option value="">Seleccione</option>
                                    <option value="alemania">Alemania</option>
                                    <option value="colombia">Colombia</option>
                                    <option value="ecuador">Ecuador</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="provincia" class="col-form-label">Provincia de Nacimiento:</label>
                                <select name="provincia" class="form-control" id="provincia">
                                    <option value="">Seleccione</option>
                                    <option value="azuay">Azuay</option>
                                    <option value="bolivar">Bolívar</option>
                                    <option value="cañar">Cañar</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label for="ciudad" class="col-form-label">Ciudad:</label>
                                <select name="ciudad" class="form-control" id="ciudad">
                                    <option value="">Seleccione</option>
                                    <option value="guayaquil">Guayaquil</option>
                                    <option value="quito">Quito</option>
                                    <option value="cuenca">Cuenca</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="fallecido" class="col-form-label">Fallecido:</label>
                                <input type="text" class="form-control" id="fallecido" placeholder="Si o no" >
                            </div>
                            <div class="col-4">
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

                    </div>

                </form>
            </div>
        </div>
    </div>


    <!--FIN del cont principal-->
    <?php require_once "vistas/parte_inferior.php" ?>