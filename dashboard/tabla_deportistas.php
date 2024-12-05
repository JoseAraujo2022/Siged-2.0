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
    /* Estilos personalizados */
    .btn-primary {
        background-color: #00a86b;
        color: white;
        cursor: pointer;
    }
</style>
<!--INICIO del cont principal-->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" >Deportistas</h6>
        </div>
        <br>
        <div class="col-5">
            <nav class="nav">
                <div class="nav-items">
                    <div class="buttons">
                        <button id="btnNuevo" type="button" class="btn btn-success"  data-toggle="modal">Añadir
                            deportista</button>
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
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data as $dat) {
                            ?>
                            <tr class="text-center">
                                <td><?php echo $dat['PER_ID'] ?></td>
                                <td><a href="tabla_persona.php?id=<?php echo $dat['PER_ID']; ?>"><?php echo $dat['PER_NOMBRES']; ?></a></td>
                                <td><?php echo $dat['PER_APELLIDOS'] ?></td>
                                <td><?php echo $dat['DEPORTE'] ?></td>
                                <td><?php echo $dat['PER_FECHANACIMIENTO'] ?></td>
                                <td><?php echo $dat['PROVINCIA'] ?></td>
                                <td>
                                    <button class="btn btn-primary btnEditar">Editar</button>
                                    <button class="btn btn-danger btnBorrar">Borrar</button>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Deportista</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para ingresar los datos del deportista -->
                    <form id="formDeportistas">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" required>
                        </div>
                        <div class="form-group">
                            <label for="deporte">Deporte</label>
                            <select class="form-control" id="deporte" required>
                                <?php
                                // Cargar deportes desde la base de datos
                                $consultaDeportes = "SELECT DEP_ID, DEP_DESCRIPCION FROM tb_deportes";
                                $resultadoDeportes = $conexion->prepare($consultaDeportes);
                                $resultadoDeportes->execute();
                                $deportes = $resultadoDeportes->fetchAll(PDO::FETCH_ASSOC);

                                // Asignar el deporte seleccionado si estamos editando
                                foreach ($deportes as $deporte) {
                                    // Comprobar si el deporte es el seleccionado
                                    $selected = '';
                                    if (isset($dat['PER_DEPORTE']) && $deporte['DEP_ID'] == $dat['PER_DEPORTE']) {
                                        $selected = 'selected';
                                    }
                                    echo "<option value='" . $deporte['DEP_ID'] . "' $selected>" . $deporte['DEP_DESCRIPCION'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" required>
                        </div>
                        <div class="form-group">
                            <label for="provincia">Provincia</label>
                            <input type="text" class="form-control" id="provincia" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php" ?>
