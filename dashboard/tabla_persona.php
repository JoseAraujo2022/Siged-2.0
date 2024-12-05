<?php require_once "vistas/parte_superior.php" ?>

<?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Verificar si el parámetro 'id' está presente en la URL
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Obtener el id de la URL

    // Hacer la consulta para obtener los datos de esa persona
    $consulta = "
        SELECT 
            p.PER_ID,
            p.PER_NOMBRES, 
            p.PER_APELLIDOS, 
            p.PER_CEDULA,
            p.PER_FECHANACIMIENTO,
            p.PER_DEPORTE,
            p.PER_PASAPORTE,
            p.PER_SEXO,
            p.PER_PAIS,
            p.PER_PROVINCIA,
            p.PER_CIUDAD_NACIMIENTO,
            d.PRO_DESCRIPCION AS PROVINCIA,
            t.DEP_DESCRIPCION AS DEPORTE,
            e.PAI_NOMBRE AS PAIS
        FROM 
            tb_personas p
        JOIN 
            tb_deportes t ON p.PER_DEPORTE = t.DEP_ID
        JOIN 
            tb_pais e ON p.PER_PAIS = e.PAI_ID
        JOIN 
            tb_provincias_pais d ON p.PER_PROVINCIA = d.PRO_ID

        WHERE p.PER_ID = :id;
    ";
    $resultado = $conexion->prepare($consulta);
    $resultado->bindParam(':id', $id, PDO::PARAM_INT);
    $resultado->execute();
    $data = $resultado->fetch(PDO::FETCH_ASSOC); // Obtener solo una fila (la de la persona seleccionada)
} else {
    // Si no se pasa el id, redirigir o mostrar un mensaje de error
    echo "No se especificó una persona.";
    exit;
}
?>
<style>
    .btn { padding: 10px 15px; border: 1px solid #ccc; border-radius: 5px; }
    /* Estilos personalizados */
    /* Estilos de botones */
    .btn-primary { background-color: #00a86b; color: white; border: none; border-radius: 4px; cursor: pointer; }
    /* Modal header style */
    .modal-header {
        cursor: move;
    }
</style>
<!--INICIO del cont principal-->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <nav class="nav">
                <div class="nav-items">
                    <div class="buttons">
                        <a href="tabla_deportistas.php" class="btn"><i class="fas fa-arrow-left"></i> Volver</a>
                        <!--a href="tabla_deportistas.php" class="btn btn-primary">Información personal</a-->
                        <a href="resultados_deportivos.php?id=<?php echo $id; ?>" class="btn btn-primary">Resultados deportivos</a>
                        <a href="resultados_deportivos.php?id=<?php echo $id; ?>"  data-toggle="modal" data-target="#modalCRUD" class="btn btn-primary">Editar</a>
                    </div>
                </div>
                
            </nav>
        </div>
        <div class="card-body">
            <?php if ($data): ?>
                <div class="row">
                    <div class="col-6">
                        <label for="nombre" class="col-form-label">Nombres:</label>
                        <span class="form-control"><?php echo $data['PER_NOMBRES'] ?></span>
                    </div>
                    <div class="col-6">
                        <label for="apellidos" class="col-form-label">Apellidos:</label>
                        <span class="form-control"><?php echo $data['PER_APELLIDOS'] ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="cedula" class="col-form-label">Cédula:</label>
                        <span class="form-control"><?php echo $data['PER_CEDULA'] ?></span>
                    </div>
                    <div class="col-6">
                        <label for="pasaporte" class="col-form-label">Pasaporte:</label>
                        <span class="form-control"><?php echo $data['PER_PASAPORTE'] ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="sexo" class="col-form-label">Sexo:</label>
                        <span class="form-control"><?php echo $data['PER_SEXO'] ?></span>
                    </div>
                    <div class="col-6">
                        <label for="fecha_nacimiento" class="col-form-label">Fecha de nacimiento:</label>
                        <span class="form-control"><?php echo $data['PER_FECHANACIMIENTO'] ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="pais" class="col-form-label">País:</label>
                        <span class="form-control"><?php echo $data['PAIS'] ?></span>
                    </div>
                    <div class="col-6">
                        <label for="provincia" class="col-form-label">Provincia:</label>
                        <span class="form-control"><?php echo $data['PROVINCIA'] ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="ciudad" class="col-form-label">Ciudad:</label>
                        <span class="form-control"><?php echo $data['PER_CIUDAD_NACIMIENTO'] ?></span>
                    </div>
                    <div class="col-6">
                        <label for="fallecido" class="col-form-label">Fallecido:</label>
                        <span class="form-control">No</span>
                    </div>
                </div>
            <?php else: ?>
                <p>La persona no fue encontrada.</p>
            <?php endif; ?>
        </div>
        <!-- Modal CRUD -->
        <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document" id="movableModal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Información</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formEditar">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <label for="edit_nombre" class="col-form-label">Nombres:</label>
                                    <input type="text" class="form-control" id="edit_nombre" value="JUAN PEPE">
                                </div>
                                <div class="col-6">
                                    <label for="edit_apellidos" class="col-form-label">Apellidos:</label>
                                    <input type="text" class="form-control" id="edit_apellidos" value="PRUEBA1">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="edit_cedula" class="col-form-label">Cédula:</label>
                                    <input type="text" class="form-control" id="edit_cedula" value="1264567891">
                                </div>
                                <div class="col-6">
                                    <label for="edit_pasaporte" class="col-form-label">Pasaporte:</label>
                                    <input type="text" class="form-control" id="edit_pasaporte" value="126456789111">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="edit_sexo" class="col-form-label">Sexo:</label>
                                    <select class="form-control" id="edit_sexo">
                                        <option value="Masculino" selected>Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="edit_fecha_nacimiento" class="col-form-label">Fecha de
                                        Nacimiento:</label>
                                    <input type="date" class="form-control" id="edit_fecha_nacimiento"
                                        value="2002-05-12">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="edit_pais" class="col-form-label">Pais:</label>
                                    <select class="form-control" id="edit_pais">
                                        <option value="ecuador" selected>Ecuador</option>
                                        <option value="colombia">Colombia</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="edit_provincia" class="col-form-label">Provincia:</label>
                                    <select class="form-control" id="edit_provincia">
                                        <option value="pastaza" selected>Pastaza</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="edit_ciudad" class="col-form-label">Ciudad:</label>
                                    <select class="form-control" id="edit_ciudad">
                                        <option value="gye" selected>Guayaquil</option>
                                        <option value="quito">Quito</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="edit_fallecido" class="col-form-label">Fallecido:</label>
                                    <select class="form-control" id="edit_fallecido">
                                        <option value="si" selected>Si</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" id="guardarCambios">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Hacer el modal movible
    const modal = document.querySelector('#movableModal');
    const header = modal.querySelector('.modal-header');

    let isDragging = false;
    let startX, startY, initialLeft, initialTop;

    header.addEventListener('mousedown', (e) => {
        isDragging = true;
        const rect = modal.getBoundingClientRect();
        startX = e.clientX;
        startY = e.clientY;
        initialLeft = rect.left;
        initialTop = rect.top;

        modal.style.position = 'absolute';
        modal.style.margin = '0';
    });

    document.addEventListener('mousemove', (e) => {
        if (!isDragging) return;

        const deltaX = e.clientX - startX;
        const deltaY = e.clientY - startY;

        modal.style.left = initialLeft + deltaX + 'px';
        modal.style.top = initialTop + deltaY + 'px';
    });

    document.addEventListener('mouseup', () => {
        isDragging = false;
    });
</script>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"; ?>