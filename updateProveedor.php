<?php
    include 'mySQLConnection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recoger valores del formulario
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $codigoSucursal = !empty($_POST['codigoSucursal']) ? $_POST['codigoSucursal'] : "NULL"; // Manejo de valores NULL
        $tipoArticulo = $_POST['tipoArticulo'];
        $ciudad = $_POST['ciudad'];
        $direccion = $_POST['direccion'];

        $nombre = $conn->real_escape_string($nombre);
        $telefono = $conn->real_escape_string($telefono);
        $codigoSucursal = $codigoSucursal === "NULL" ? $codigoSucursal : $conn->real_escape_string($codigoSucursal);
        $tipoArticulo = $conn->real_escape_string($tipoArticulo);
        $ciudad = $conn->real_escape_string($ciudad);
        $direccion = $conn->real_escape_string($direccion);

        // Crear la consulta SQL
        $sql = "UPDATE proveedor SET 
                    Nombre = '$nombre', 
                    Telefono = '$telefono', 
                    CodigoSucursal = $codigoSucursal, 
                    TipoArticulo = '$tipoArticulo', 
                    Ciudad = '$ciudad', 
                    Direccion = '$direccion' 
                WHERE CodigoProveedor = $id";

        // Ejecutar la consulta
        if($conn->query($sql) === TRUE) {
            echo "Registro actualizado correctamente.";
        } else {
            echo "Error al actualizar: " . $conn->error;
        }

        // Cerrar la conexión
        $conn->close();
    }   
?>