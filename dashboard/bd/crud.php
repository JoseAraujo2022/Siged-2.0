<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir datos del formulario
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $cedula = $_POST['cedula'];
    $pasaporte = $_POST['pasaporte'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $pais_nacimiento = $_POST['pais_nacimiento'];
    $provincia_nacimiento = $_POST['provincia_nacimiento'];
    $ciudad_nacimiento = $_POST['ciudad_nacimiento'];
    $genero = $_POST['genero'];
    $tipo_sangre = $_POST['tipo_sangre'];
    $tipo_persona = $_POST['tipo_persona'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $celular = $_POST['celular'];
    $nombre_contacto = $_POST['nombre_contacto'];
    $ciudad_reside = $_POST['ciudad_reside'];
    $direccion = $_POST['direccion'];
    $primaria = $_POST['primaria'];
    $secundaria = $_POST['secundaria'];
    $superior = $_POST['superior'];
    $otros_estudios = $_POST['otros_estudios'];
    $idiomas = $_POST['idiomas'];
    $venc_pasaporte = $_POST['venc_pasaporte'];
    $venc_cedula = $_POST['venc_cedula'];
    $deporte = $_POST['deporte'];
    $estado = $_POST['estado'];
    $nacionalidad = $_POST['nacionalidad'];
    $provincia_representa = $_POST['provincia_representa'];

    // Obtener el último PER_ID de la base de datos
    $consulta = "SELECT MAX(PER_ID) AS last_id FROM tb_personas";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $ultimo_id = $resultado->fetch(PDO::FETCH_ASSOC)['last_id'];
    
    // Calcular el próximo PER_ID
    $nuevo_id = $ultimo_id + 1;

    // Insertar los datos en la base de datos
    $consulta_insert = "INSERT INTO tb_personas 
                        (PER_ID, PER_NOMBRES, PER_APELLIDOS, PER_CEDULA, PER_PASAPORTE, PER_FECHANACIMIENTO, 
                         PER_CIUDAD_NACIMIENTO, PER_PROVINCIA, PER_PAIS, PER_SEXO, PER_TIPO_SANGRE, PER_IDTIPO, PER_EMAIL, 
                         PER_FONOCONVENCIONAL, PER_CELULAR, PER_NOMBRE_CONTACTO, PER_CIUDAD_RESIDE, PER_DIRECCION, 
                         PER_ESCUELA, PER_COLEGIO, PER_SUPERIOR, PER_EDUCACION_OTROS, PER_IDIOMAS, PER_FECH_VENCE_PASS, 
                         PER_FECH_VENCE_CED, PER_DEPORTE, PER_ESTADO, PER_NACIONALIDAD, PER_PROVREPRESENTA) 
                        VALUES 
                        (:PER_ID, :PER_NOMBRES, :PER_APELLIDOS, :PER_CEDULA, :PER_PASAPORTE, :PER_FECHANACIMIENTO, 
                         :PER_CIUDAD_NACIMIENTO, :PER_PROVINCIA, :PER_PAIS, :PER_SEXO, :PER_TIPO_SANGRE, :PER_IDTIPO, :PER_EMAIL, 
                         :PER_FONOCONVENCIONAL, :PER_CELULAR, :PER_NOMBRE_CONTACTO, :PER_CIUDAD_RESIDE, :PER_DIRECCION, 
                         :PER_ESCUELA, :PER_COLEGIO, :PER_SUPERIOR, :PER_EDUCACION_OTROS, :PER_IDIOMAS, :PER_FECH_VENCE_PASS, 
                         :PER_FECH_VENCE_CED, :PER_DEPORTE, :PER_ESTADO, :PER_NACIONALIDAD, :PER_PROVREPRESENTA)";

    $stmt = $conexion->prepare($consulta_insert);
    $stmt->bindParam(':PER_ID', $nuevo_id);
    $stmt->bindParam(':PER_NOMBRES', $nombres);
    $stmt->bindParam(':PER_APELLIDOS', $apellidos);
    $stmt->bindParam(':PER_CEDULA', $cedula);
    $stmt->bindParam(':PER_PASAPORTE', $pasaporte);
    $stmt->bindParam(':PER_FECHANACIMIENTO', $fecha_nacimiento);
    $stmt->bindParam(':PER_CIUDAD_NACIMIENTO', $ciudad_nacimiento);
    $stmt->bindParam(':PER_PROVINCIA', $provincia_nacimiento);
    $stmt->bindParam(':PER_PAIS', $pais_nacimiento);
    $stmt->bindParam(':PER_SEXO', $genero);
    $stmt->bindParam(':PER_TIPO_SANGRE', $tipo_sangre);
    $stmt->bindParam(':PER_IDTIPO', $tipo_persona);
    $stmt->bindParam(':PER_EMAIL', $email);
    $stmt->bindParam(':PER_FONOCONVENCIONAL', $telefono);
    $stmt->bindParam(':PER_CELULAR', $celular);
    $stmt->bindParam(':PER_NOMBRE_CONTACTO', $nombre_contacto);
    $stmt->bindParam(':PER_CIUDAD_RESIDE', $ciudad_reside);
    $stmt->bindParam(':PER_DIRECCION', $direccion);
    $stmt->bindParam(':PER_ESCUELA', $primaria);
    $stmt->bindParam(':PER_COLEGIO', $secundaria);
    $stmt->bindParam(':PER_SUPERIOR', $superior);
    $stmt->bindParam(':PER_EDUCACION_OTROS', $otros_estudios);
    $stmt->bindParam(':PER_IDIOMAS', $idiomas);
    $stmt->bindParam(':PER_FECH_VENCE_PASS', $venc_pasaporte);
    $stmt->bindParam(':PER_FECH_VENCE_CED', $venc_cedula);
    $stmt->bindParam(':PER_DEPORTE', $deporte);
    $stmt->bindParam(':PER_ESTADO', $estado);
    $stmt->bindParam(':PER_NACIONALIDAD', $nacionalidad);
    $stmt->bindParam(':PER_PROVREPRESENTA', $provincia_representa);

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Registro agregado correctamente.',
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error al agregar el registro.',
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Faltan datos obligatorios.',
    ]);
}
?>
