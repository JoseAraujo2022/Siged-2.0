<?php require_once "vistas/parte_superior.php" ?>
<!--INICIO del cont principal-->
<?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$totalOro = 0; // Variable para almacenar la sumatoria de medallas de oro
$totalPlata = 0; // Variable para almacenar la sumatoria de medallas de plata
$totalBronce = 0; // Variable para almacenar la sumatoria de medallas de bronce

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
        r.ORDEN,
        CONCAT(a.PER_NOMBRES, ' ', a.PER_APELLIDOS) AS PERSONA,
        b.NOMBRE AS EVENTO,
        c.DEP_DESCRIPCION AS DEPORTE,
        e.FECHA_INICIO AS FECH_INIT,
        f.ID_TIPOJUEGO AS TIPO_JUEGO,
        g.ID_PAIS AS PAIS,
        p.PAI_NOMBRE AS PAIS_NOMBRE,
        h.SEDES
    FROM 
        tb_resultados r
    JOIN 
        tb_personas a ON r.ID_PERSONA = a.PER_ID
    JOIN 
        tb_gev_evento b ON r.ID_EVENTO = b.ID_EVENTO
    JOIN 
        tb_deportes c ON r.ID_DEPORTE = c.DEP_ID
    JOIN 
        tb_gev_evento e ON r.ID_EVENTO = e.ID_EVENTO
    JOIN 
        tb_gev_evento f ON r.ID_EVENTO = f.ID_EVENTO
    JOIN 
        tb_gev_evento g ON r.ID_EVENTO = g.ID_EVENTO
    JOIN 
        tb_gev_evento h ON r.ID_EVENTO = h.ID_EVENTO
    JOIN 
        tb_pais p ON g.ID_PAIS = p.PAI_ID

    WHERE r.ID_PERSONA = :id
    ORDER BY e.FECHA_INICIO;  -- Ordena los resultados por la fecha de inicio
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

        // Sumar las medallas de oro
        $totalOro += $row['ORO'];
        //Sumar las medallas de plata
        $totalPlata += $row['PLATA'];
        //Sumar las medallas de bronce
        $totalBronce += $row['BRONCE'];
    }





    // Asegurar que los eventos estén ordenados por fecha
    usort($groupedData, function ($a, $b) {
        $fechaA = strtotime($a['DETALLES'][0]['FECH_INIT']);
        $fechaB = strtotime($b['DETALLES'][0]['FECH_INIT']);
        return $fechaA - $fechaB;
    });
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
    th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; word-wrap: break-word; }
    tr { display: flex; flex-wrap: wrap; }
    th, td { flex: 1; min-width: 150px; }
    th:first-child, td:first-child { flex: 2; }
    th:nth-child(2), td:nth-child(2) { flex: 1.5; }
    th:nth-child(3), td:nth-child(3) { flex: 2; }
    .event-logo { width: 30px; height: 30px; margin-right: 10px; vertical-align: middle; }
    h1 { margin: 0 0 20px 0; }
    .bold { font-weight: bold; }
    .nav { display: flex; justify-content: space-between; align-items: center; }
    .nav-items { display: flex; gap: 20px; }
    .nav-item, .btn { text-decoration: none; color: black; }
    .btn { padding: 10px 15px; border: 1px solid #ccc; border-radius: 5px; }
    .btn-primary { background-color: #00a86b; color: white; border: none; border-radius: 4px; cursor: pointer; }
    .medal-card, .profile-container, .medal-container { background-color: white; border-radius: 8px; padding: 15px; }
    .medal-card, .medal-container { display: flex; justify-content: center; align-items: center; }
    .profile-container { box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); max-width: 600px; margin: auto; }
    .athlete-name { font-size: 24px; font-weight: bold; color: #333; text-align: center; margin-bottom: 15px; }
    .evento { font-size: 20px; font-weight: bold; color: #514c4c; margin-left: 10px; }
    .medal-iconos { font-size: 26px; margin-right: 10px; vertical-align: middle; }
    .medal-icon { font-size: 35px; margin-right: 5px; vertical-align: middle; }
    .medal-count { font-size: 24px; font-weight: bold; color: #0066cc; margin-left: -2px; }
    .minusc { text-transform: lowercase; }
</style>


<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <nav class="nav">
                <div class="nav-items">
                    <div class="buttons">
                        <a href="tabla_persona.php?id=<?php echo $id; ?>" class="btn"><i class="fas fa-arrow-left"></i>
                            Volver</a>
                        <a href="tabla_persona.php?id=<?php echo $id; ?>" class="btn btn-primary">Información
                            personal</a>
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
                    <br>
                    <h1 class="athlete-name"><?php echo $data[0]['PERSONA'] ?></h1>
                    <div class="medal-container">
                        <?php if ($totalOro > 0): ?>
                            <span class="medal-icon">🥇</span>
                            <span class="medal-count"><?php echo $totalOro; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
                            <!-- Espacio entre medallas -->
                        <?php endif; ?>

                        <?php if ($totalPlata > 0): ?>
                            <span class="medal-icon">🥈</span>
                            <span class="medal-count"><?php echo $totalPlata; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
                            <!-- Espacio entre medallas -->
                        <?php endif; ?>

                        <?php if ($totalBronce > 0): ?>
                            <span class="medal-icon">🥉</span>
                            <span class="medal-count"><?php echo $totalBronce; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
                            <!-- Espacio entre medallas -->
                        <?php endif; ?>
                    </div>
                </div>

                <!-- JUEGOS REGIONALES -->
                <details>
                    <summary>JUEGOS REGIONALES</summary>
                    <br>
                    <?php
                    $encabezadosMostradosRegional = false; // Bandera para controlar los encabezados en Juegos Regionales
                
                    foreach ($groupedData as $evento => $info):
                        // Filtrar eventos que no sean de tipo regional (asumiendo que no tienen TIPO_JUEGO == 4)
                        $tipoJuego = isset($info['DETALLES'][0]['TIPO_JUEGO']) ? $info['DETALLES'][0]['TIPO_JUEGO'] : null;
                        if ($tipoJuego == 4) {
                            continue; // Si es tipo de juego 4 (Olímpicos), omitir este evento
                        }
                        ?>
                        <span class="evento"><?php echo $info['EVENTO']; ?></span>
                        <table>
                            <?php if (!$encabezadosMostradosRegional): // Mostrar encabezados solo una vez ?>
                                <tr style="color: #514c4c;">
                                    <th>Fecha</th>
                                    <th>Deporte</th>
                                    <th>Sede-País</th>
                                    <th>Posicion</th>
                                    <th>Marca</th>
                                    <th>Medallas</th>
                                </tr>
                                <?php $encabezadosMostradosRegional = true; // Marcar encabezados como mostrados ?>
                            <?php endif; ?>

                            <?php foreach ($info['DETALLES'] as $detalle): ?>
                                <tr>
                                    <td>
                                        <?php echo $detalle['FECH_INIT']; ?>
                                    </td>
                                    <td>
                                        <?php echo $detalle['DEPORTE']; ?>
                                        <br> <?php echo $detalle['DIVISION']; ?>
                                    </td>
                                    <td>
                                        <?php echo $detalle['SEDES']; ?>
                                        <br><?php echo $detalle['PAIS_NOMBRE']; ?>
                                    </td>
                                    <td><?php echo $detalle['ORDEN']; ?></td>
                                    <td><?php echo $detalle['MARCA']; ?></td>
                                    <td>
                                        <?php if ($detalle['ORO'] > 0)
                                            echo '<span class="medal-iconos">🥇</span><span class="custom-span">Oro</span>'; ?>
                                        <?php if ($detalle['PLATA'] > 0)
                                            echo '<span class="medal-iconos">🥈</span><span class="custom-span">Plata</span>'; ?>
                                        <?php if ($detalle['BRONCE'] > 0)
                                            echo '<span class="medal-iconos">🥉</span><span class="custom-span">Bronce</span>'; ?>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <br>
                    <?php endforeach; ?>

                </details>


                <!-- JUEGOS OLÍMPICOS -->
                <!-- JUEGOS OLÍMPICOS -->
                <?php
                $hasOlympicsData = false; // Bandera para verificar si hay datos de los Juegos Olímpicos
            
                // Verificar si hay eventos de tipo Juegos Olímpicos
                foreach ($groupedData as $evento => $info):
                    $tipoJuego = $info['DETALLES'][0]['TIPO_JUEGO'];
                    if ($tipoJuego == 4) {
                        $hasOlympicsData = true; // Si encontramos al menos un evento de los Juegos Olímpicos, activamos la bandera
                        break; // No es necesario continuar buscando, ya encontramos eventos olímpicos
                    }
                endforeach;
                ?>

                <?php if ($hasOlympicsData): ?>
                    <details>
                        <summary>JUEGOS OLÍMPICOS</summary>
                        <br>
                        <?php
                        $encabezadosMostrados = false; // Bandera para controlar si se han mostrado los encabezados
                
                        foreach ($groupedData as $evento => $info):
                            $tipoJuego = $info['DETALLES'][0]['TIPO_JUEGO'];
                            if ($tipoJuego != 4) {
                                continue; // Si no es tipo de juego 4, omitir este evento
                            }
                            ?>
                            <span class="evento"><?php echo $info['EVENTO']; ?></span>
                            <table>
                                <?php if (!$encabezadosMostrados): // Mostrar encabezados solo una vez ?>
                                    <tr style="color: #514c4c;">
                                        <th>Deporte</th>
                                        <th>País</th>
                                        <th>Marca</th>
                                        <th>Medallas</th>
                                    </tr>
                                    <?php $encabezadosMostrados = true; // Marcar encabezados como mostrados ?>
                                <?php endif; ?>

                                <?php foreach ($info['DETALLES'] as $detalle): ?>
                                    <tr>
                                        <td>
                                            <?php echo $detalle['DEPORTE']; ?>
                                            <br> <?php echo $detalle['DIVISION']; ?>
                                        </td>
                                        <td>
                                            <?php echo $detalle['SEDES']; ?>
                                            <br> <?php echo $detalle['PAIS_NOMBRE']; ?>
                                        </td>
                                        <td><?php echo $detalle['MARCA']; ?></td>
                                        <td>
                                            <?php if ($detalle['ORO'] > 0)
                                                echo '<span class="medal-iconos">🥇</span><span class="custom-span">Oro</span>'; ?>
                                            <?php if ($detalle['PLATA'] > 0)
                                                echo '<span class="medal-iconos">🥈</span><span class="custom-span">Plata</span>'; ?>
                                            <?php if ($detalle['BRONCE'] > 0)
                                                echo '<span class="medal-iconos">🥉</span><span class="custom-span">Bronce</span>'; ?>

                                            <br> <?php echo $detalle['FECH_INIT']; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                            <br>
                        <?php endforeach; ?>
                    </details>
                <?php endif; ?>

            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once "vistas/parte_inferior.php" ?>