<?php
include 'mySQLConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger valores del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precioCompra = $_POST['precioCompra'];
    $precioVenta = $_POST['precioVenta'];
    $codigoProveedor = !empty($_POST['codigoProveedor']) ? $_POST['codigoProveedor'] : "NULL"; // Manejo de valores NULL
    $tipoArticulo = $_POST['tipoArticulo'];

    $nombre = $conn->real_escape_string($nombre);
    $precioCompra = $conn->real_escape_string($precioCompra);
    $precioVenta = $conn->real_escape_string($precioVenta);
    $codigoProveedor = $codigoProveedor === "NULL" ? $codigoProveedor : $conn->real_escape_string($codigoProveedor);
    $tipoArticulo = $conn->real_escape_string($tipoArticulo);

    // Crear la consulta SQL
    $sql = "UPDATE articulo SET 
                Nombre = '$nombre', 
                PrecioCompra = $precioCompra, 
                PrecioVenta = $precioVenta, 
                CodigoProveedor = $codigoProveedor, 
                TipoArticulo = '$tipoArticulo' 
            WHERE CodigoArticulo = $id";

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
