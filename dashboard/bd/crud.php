<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$apellidos = (isset($_POST['apellidos'])) ? $_POST['apellidos'] : '';
$deporte = (isset($_POST['deporte'])) ? $_POST['deporte'] : '';
$fecha_nacimiento = (isset($_POST['fecha_nacimiento'])) ? $_POST['fecha_nacimiento'] : '';
$provincia = (isset($_POST['provincia'])) ? $_POST['provincia'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

// Opciones para manipulación de datos
switch ($opcion) {
    case 1: // Alta
        $consulta = "INSERT INTO tb_personas (PER_NOMBRES, PER_APELLIDOS, PER_FECHANACIMIENTO, PER_DEPORTE, PER_PROVINCIA) VALUES ('$nombre', '$apellidos', '$fecha_nacimiento', '$deporte', '$provincia')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 2: // Editar
        $consulta = "UPDATE tb_personas SET PER_NOMBRES = '$nombre', PER_APELLIDOS = '$apellidos', PER_FECHANACIMIENTO = '$fecha_nacimiento', PER_DEPORTE = '$deporte', PER_PROVINCIA = '$provincia' WHERE PER_ID = '$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 3: // Borrar
        $consulta = "DELETE FROM tb_personas WHERE PER_ID = '$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
}
?>
