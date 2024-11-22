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
    $data = $resultado->fetch(PDO::FETCH_ASSOC); // Obtener solo una fila (la de la persona seleccionada)
} else {
    // Si no se pasa el id, redirigir o mostrar un mensaje de error
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
    .medal-icon { font-size: 24px; margin-right: 10px; }
    .medal-count { font-size: 24px; font-weight: bold; color: #0066cc; }
</style>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <nav class="nav">
                <div class="nav-items">
                    <div class="buttons">
                        <a href="tabla_persona.php?id=<?php echo $id; ?>" class="btn">← Volver</a>
                        <a href="tabla_persona.php?id=<?php echo $id; ?>" class="btn btn-primary">Información personal</a>
                    </div>
                </div>
                <a href="form_persona.php" class="btn btn-primary">

                    </svg>
                    Editar datos
                </a>
            </nav>
        </div>
        <div class="card-body">
            <?php if ($data): ?>
                <div class="">
                    <h1 class="athlete-name"><?php echo $data['PERSONA'] ?></h1>
                    <div class="medal-container">
                        <span class="medal-icon">🥇</span>
                        <span class="medal-count">3</span>
                    </div>
                </div>
                <details>
                    <summary>JUEGOS REGIONALES</summary>
                    <br>
                    <table>
                        <tr>
                            <td>
                                <img src="https://conpaas.einzelnet.com/services/sportsservice/api/media/287eadd638c36516c14a93bb9fcbedda760199b0"
                                    alt="Logo Juegos Bolivarianos" class="event-logo"></td>
                            <td><?php echo $data['EVENTO'] ?></td>
                            <td>🏅<?php echo $data['ORO'] ?></td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>julio 4<br>15:30 - 18:00</td>
                            <td><?php echo $data['DEPORTE'] ?><br><?php echo $data['DIVISION'] ?></td>
                            <!--td>Final<br>Grupo A</td--->
                            <td><?php echo $data['ORO'] ?></td>
                            <td>Oro<br>2022-07-04</td>
                            <td>🏅</td>
                        </tr>
                        <tr>
                            <td>julio 4<br>15:30 - 18:00</td>
                            <td><?php echo $data['DEPORTE'] ?><br><?php echo $data['DIVISION'] ?></td>
                            <td><?php echo $data['PLATA'] ?></td>
                            <td>Plata<br>2022-07-04</td>
                            <td>🏅</td>
                        </tr>
                        <tr>
                            <td>julio 4<br>15:30 - 18:00</td>
                            <td><?php echo $data['DEPORTE'] ?><br><?php echo $data['DIVISION'] ?></td>
                            <td><?php echo $data['BRONCE'] ?></td>
                            <td>Bronce<br>2022-07-04</td>
                            <td>🏅</td>
                        </tr>
                    </table>
                </details>

                <details>
                    <summary>JUEGOS OLÍMPICOS</summary>
                    <br>
                    <table>
                        <tr>
                            <td>
                                <img src="https://conpaas.einzelnet.com/services/sportsservice/api/media/549abe57336e3ade07771340f2187932133dfd15"
                                    alt="Logo Juegos Olímpicos" class="event-logo">
                                2021
                            </td>
                            <td>XXXII Juegos Olímpicos de Verano Tokio 2020</td>
                            <td>🏅</td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>agosto 1<br>05:50 - 07:40</td>
                            <td>Halterofilia<br>Mujeres 76kg</td>
                            <td>Final<br>Grupo A</td>
                            <td>1</td>
                            <td>263</td>
                            <td>Oro<br>2021-08-01</td>
                            <td>🏅</td>
                        </tr>
                    </table>
                </details>
            </div>
        <?php else: ?>
            <p>La persona no fue encontrada.</p>
        <?php endif; ?>
    </div>
</div>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php" ?>