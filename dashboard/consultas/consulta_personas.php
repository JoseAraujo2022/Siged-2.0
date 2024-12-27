<?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Obtener los parámetros enviados
$deporte = isset($_POST['deporte']) ? $_POST['deporte'] : '';
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$apellido = isset($_POST['apellidos']) ? $_POST['apellidos'] : '';


// Construir la consulta SQL
$sql = "SELECT 
            P.PER_ID, 
            P.PER_NOMBRES, 
            P.PER_APELLIDOS, 
            P.PER_CEDULA, 
            P.PER_FECHANACIMIENTO,
            P.PER_PAIS,
            P.PER_PROVINCIA,
            P.PER_CIUDAD_NACIMIENTO,
            P.PER_PROVREPRESENTA,
            P.PER_TIPO_SANGRE,
            P.PER_IDTIPO,
            P.PER_DEPORTE,
            P.PER_SEXO,
            P.PER_ESTADO,
            
            P.PER_PASAPORTE, 
            P.PER_FECH_VENCE_PASS, 
            P.PER_NACIONALIDAD,
            P.PER_FECH_VENCE_CED,

            P.PER_CIUDAD_RESIDE,
            P.PER_DIRECCION,
            P.PER_FONOCONVENCIONAL,
            P.PER_CELULAR,
            P.PER_NOMBRE_CONTACTO,
            P.PER_EMAIL,
            
            P.PER_ESCUELA,
            P.PER_COLEGIO,
            P.PER_SUPERIOR,
            P.PER_EDUCACION_OTROS,
            P.PER_IDIOMAS,
            
            D.DEP_DESCRIPCION AS DEPORTE

        FROM tb_personas P
        JOIN tb_deportes D ON P.PER_DEPORTE = D.DEP_ID
        WHERE 1"; // La condición WHERE 1 asegura que la consulta siempre sea válida

$params = []; // Array para almacenar los parámetros de búsqueda

// Agregar filtros solo si se reciben valores
if ($nombre != '') {
    $sql .= " AND P.PER_NOMBRES LIKE :nombre";
    $params[':nombre'] = "%$nombre%";
}
if ($apellido != '') {
    $sql .= " AND P.PER_APELLIDOS LIKE :apellido";
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

// Retornar los resultados en formato JSON
echo json_encode($resultados);
?>