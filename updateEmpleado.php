<?php

include 'mySQLConnection.php';  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger valores del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $puesto = $_POST['puesto'];
    $sueldo = $_POST['sueldo'];
    $rfc = $_POST['rfc'];
    $codigoGerente = $_POST['codigoGerente'];
    $codigoSucursal = $_POST['codigoSucursal'];

    // Escapar los valores para evitar inyecciones SQL
    $nombre = $conn->real_escape_string($nombre);
    $telefono = $conn->real_escape_string($telefono);
    $puesto = $conn->real_escape_string($puesto);
    $sueldo = $conn->real_escape_string($sueldo);
    $rfc = $conn->real_escape_string($rfc);
    $codigoGerente = $conn->real_escape_string($codigoGerente);

    // Verificar si CodigoSucursal debe ser NULL
    if (empty($codigoSucursal)) {
        $codigoSucursal = "NULL"; // Valor literal NULL para SQL
    } else {
        $codigoSucursal = "'" . $conn->real_escape_string($codigoSucursal) . "'";
    }

    // Crear la consulta SQL
    $sql = "UPDATE empleado SET 
                Nombre = '$nombre', 
                Telefono = '$telefono', 
                Puesto = '$puesto', 
                Sueldo = $sueldo, 
                RFC = '$rfc', 
                CodigoGerente = $codigoGerente, 
                CodigoSucursal = $codigoSucursal 
            WHERE CodigoEmpleado = $id";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Registro actualizado correctamente.";
    } else {
        echo "Error al actualizar: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>
