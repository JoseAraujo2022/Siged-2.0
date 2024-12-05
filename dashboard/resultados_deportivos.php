<?php require_once "vistas/parte_superior.php" ?>
<!--INICIO del cont principal-->
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
        r.ID_EVENTO, 
        r.ID_DEPORTE, 
        r.ID_PERSONA,
        r.FECHA_REGISTRO, 
        r.DIVISION,
        r.EQUIPO,
        r.ORO,
        r.PLATA,
        r.BRONCE,
        r.MARCA,

        CONCAT(a.PER_NOMBRES, ' ', a.PER_APELLIDOS) AS PERSONA,
        b.NOMBRE AS EVENTO,
        c.DEP_DESCRIPCION AS DEPORTE

    FROM 
        tb_resultados r
    JOIN 
        tb_personas a ON r.ID_PERSONA = a.PER_ID
    JOIN 
        tb_gev_evento b ON r.ID_EVENTO = b.ID_EVENTO
    JOIN 
       tb_deportes c ON r.ID_DEPORTE = c.DEP_ID

        WHERE r.ID_PERSONA = :id;
    ";
    $resultado = $conexion->prepare($consulta);
    $resultado->bindParam(':id', $id, PDO::PARAM_INT);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC); // Obtener todas las filas

    // Reagrupar resultados por ID_EVENTO
    $groupedData = [];
    foreach ($data as $row) {
        $evento = $row['ID_EVENTO'];
        if (!isset($groupedData[$evento])) {
            $groupedData[$evento] = [
                'EVENTO' => $row['EVENTO'],
                'DETALLES' => []
            ];
        }
        $groupedData[$evento]['DETALLES'][] = $row;
    }
} else {
    echo "No se especificó una persona.";
    exit;
}
?>
<style>
.medal { color: gold; margin-right: 5px; }
    details { margin-bottom: 20px; }
    summary { cursor: pointer; font-weight: bold; font-size: 20px; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
    .event-logo { width: 30px; height: 30px; margin-right: 10px; vertical-align: middle; }
    h1 { margin: 0 0 20px 0; }
    .bold { font-weight: bold; }

    /* Navigation Styles */
    .nav { display: flex; justify-content: space-between; align-items: center; }
    .nav-items { display: flex; gap: 20px; }
    .nav-item, .btn { text-decoration: none; color: black; }
    .btn { padding: 10px 15px; border: 1px solid #ccc; border-radius: 5px; }
    .btn-primary { background-color: #00a86b; color: white; border: none; border-radius: 4px; cursor: pointer; }

    /* Medal Section */
    .medal-card, .profile-container, .medal-container { background-color: white; border-radius: 8px; padding: 15px; }
    .medal-card, .medal-container { display: flex; justify-content: center; align-items: center; }
    .profile-container { box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); max-width: 600px; margin: auto; }
    .athlete-name { font-size: 24px; font-weight: bold; color: #333; text-align: center; margin-bottom: 15px; }
    .medal-icon { font-size: 31px; margin-right: 10px; vertical-align: middle;}
    .medal-iconos { font-size: 26px; margin-right: 10px; vertical-align: middle;}
    .medal-count { font-size: 24px; font-weight: bold; color: #0066cc; }
</style>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <nav class="nav">
                <div class="nav-items">
                    <div class="buttons">
                        <a href="tabla_persona.php?id=<?php echo $id; ?>" class="btn"><i class="fas fa-arrow-left"></i> Volver</a>
                        <a href="tabla_persona.php?id=<?php echo $id; ?>" class="btn btn-primary">Información personal</a>
                    </div>
                </div>
                <a href="form_persona.php" class="btn btn-primary">
                    Editar datos
                </a>
            </nav>
        </div>
        <div class="card-body">
            <?php if ($data): ?>
                <div>
                    <h1 class="athlete-name"><?php echo $data[0]['PERSONA'] ?></h1>
                    <div class="medal-container">
                        <span class="medal-icon">🥇</span>
                        <span class="medal-count"></span>
                    </div>
                </div>

                <!-- JUEGOS REGIONALES -->
                <details>
                    <summary>JUEGOS REGIONALES</summary>
                    <br>
                    <?php foreach ($groupedData as $evento => $info): ?>
                        <span><?php echo $info['EVENTO']; ?></span>
                        <table>
                            <tr>
                                <th>Deporte</th>
                                <th>Medallas</th>
                                <th>Fecha</th>
                            </tr>
                            <?php foreach ($info['DETALLES'] as $detalle): ?>
                                <tr>
                                    <td><?php echo $detalle['DEPORTE'] . " - " . $detalle['DIVISION']; ?></td>
                                    <td class="medal-iconos">
                                        <?php if ($detalle['ORO'] > 0) echo "🥇" . $detalle['ORO']; ?>
                                        <?php if ($detalle['PLATA'] > 0) echo "🥈" . $detalle['PLATA']; ?>
                                        <?php if ($detalle['BRONCE'] > 0) echo "🥉" . $detalle['BRONCE']; ?>
                                    </td>
                                    <td><?php echo $detalle['FECHA_REGISTRO']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <br>
                    <?php endforeach; ?>
                </details>

                <!-- JUEGOS OLÍMPICOS -->
                <details>
                    <summary>JUEGOS OLÍMPICOS</summary>
                    <br>
                    <!-- Similar estructura para Juegos Olímpicos -->
                </details>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php require_once "vistas/parte_inferior.php" ?>
