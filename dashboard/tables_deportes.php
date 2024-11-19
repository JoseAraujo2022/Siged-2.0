<?php require_once "vistas/parte_superior.php" ?>
<!-- Begin Page Content -->
<?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Corrección en la asignación de alias
$consulta = "
    SELECT 
        a.ID_EVENTO, 
        a.ID_DEPORTE, 
        a.ID_PERSONA,
        a.FECHA_REGISTRO, 
        a.DIVISION,
        a.EQUIPO,
        a.ORO,
        a.PLATA,
        a.BRONCE,
        a.MARCA,
        c.DEP_DESCRIPCION AS DEPORTE,
        b.NOMBRE AS EVENTO,
        d.SEDES AS PAIS,
        CONCAT(e.PER_NOMBRES, ' ', e.PER_APELLIDOS) AS PERSONA,
        f.DEP_DESCRIPCION AS DEPORTE
    FROM 
        tb_resultados a
    JOIN 
        tb_gev_evento b ON a.ID_EVENTO = b.ID_EVENTO
    JOIN 
        tb_gev_evento d ON a.ID_EVENTO = d.ID_EVENTO
	JOIN 
        tb_personas e ON a.ID_PERSONA = e.PER_ID
    JOIN 
        tb_deportes f ON a.ID_DEPORTE = f.DEP_ID
    JOIN 
       tb_deportes c ON a.ID_DEPORTE = c.DEP_ID;
";
$resultado = $conexion->prepare($consulta);
$resultado->execute(); // Ejecuta la consulta
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- DataTales Example -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Deportes</h6>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-1">
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tablaDeportistas" width="100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Juegos</th>
                            <th>Pais</th>
                            <th>Deporte</th>
                            <th>Prueba</th>
                            <th>Marcas</th>
                            <th>Oro</th>
                            <th>Plata</th>
                            <th>Bronce</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data as $dat) {
                            ?>
                            <tr>
                                <td><?php echo $dat['PERSONA'] ?></td>
                                <td><?php echo $dat['EVENTO'] ?></td>
                                <td><?php echo $dat['PAIS'] ?></td>
                                <td><?php echo $dat['DEPORTE'] ?></td>
                                <td><?php echo $dat['DIVISION'] ?></td>
                                <td><?php echo $dat['MARCA'] ?></td>
                                <td><?php echo $dat['ORO'] ?></td>
                                <td><?php echo $dat['PLATA'] ?></td>
                                <td><?php echo $dat['BRONCE'] ?></td>
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
</div>

<!-- /.container-fluid -->

<!--FIN del cont principal-->

<?php require_once "vistas/parte_inferior.php" ?>