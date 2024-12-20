<?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Obtener los parámetros enviados
$deporte = isset($_POST['deporte']) ? $_POST['deporte'] : '';
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$apellido = isset($_POST['apellidos']) ? $_POST['apellidos'] : '';

// Construir la consulta SQL
$sql = "SELECT PER_ID, PER_NOMBRES, PER_APELLIDOS, PER_CEDULA, PER_PASAPORTE, D.DEP_DESCRIPCION AS DEPORTE, PER_FECHANACIMIENTO
FROM tb_personas P
JOIN tb_deportes D ON P.PER_DEPORTE = D.DEP_ID
WHERE 1";  // La condición WHERE 1 asegura que la consulta siempre sea válida.

$params = [];  // Array para almacenar los parámetros de búsqueda

// Agregar filtros solo si se reciben valores
if ($nombre != '') {
    $sql .= " AND PER_NOMBRES LIKE :nombre";
    $params[':nombre'] = "%$nombre%";
}
if ($apellido != '') {
    $sql .= " AND PER_APELLIDOS LIKE :apellido";
    $params[':apellido'] = "%$apellido%";
}
if ($deporte != '') {
    $sql .= " AND D.DEP_ID = :deporte";
    $params[':deporte'] = (int) $deporte; // Aseguramos que el deporte sea tratado como entero
}

$stmt = $conexion->prepare($sql);

// Vincular los valores a los parámetros si no están vacíos
foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value);
}

$stmt->execute();
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($resultados);
?>
