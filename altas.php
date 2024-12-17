<?php
// Conexión a la base de datos
include 'mySQLConnection.php';
$conn->set_charset("utf8");

// Comprobar qué formulario se envió
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['formulario'])) {
    $formulario = $_POST['formulario'];

    switch ($formulario) {
        case "articulo":
            $nombreArticulo = $_POST['nombreArticulo'];
            $precioCompra = !empty($_POST['precioCompra']) ? $conn->real_escape_string($_POST['precioCompra']) : "NULL";
            $precioVenta = !empty($_POST['precioVenta']) ? $conn->real_escape_string($_POST['precioVenta']) : "NULL";
            $codigoProveedor = !empty($_POST['codigoProveedor']) ? $conn->real_escape_string($_POST['codigoProveedor']) : "NULL";
            // $tipoArticulo = !empty($_POST['tipoArticulo']) ? $conn->real_escape_string($_POST['tipoArticulo']) : "NULL";
            $tipoArticulo = !empty($_POST['tipoArticulo']) ? "'" . $conn->real_escape_string($_POST['tipoArticulo']) . "'" : "NULL";

            $sql = "INSERT INTO articulo (Nombre, PrecioCompra, PrecioVenta, CodigoProveedor, TipoArticulo) 
                    VALUES ('$nombreArticulo', $precioCompra, $precioVenta, $codigoProveedor, $tipoArticulo)";
            break;

        case "empleado":
            $nombreEmpleado = $_POST['nombreEmpleado'];
            $telefono = $_POST['telefono'];
            $puesto = $_POST['puesto'];
            $sueldo = $_POST['sueldo'];
            $rfc = $_POST['rfc'];
            $codigoGerente = !empty($_POST['codigoGerente']) ? $conn->real_escape_string($_POST['codigoGerente']) : "NULL";
            $codigoSucursal = !empty($_POST['codigoSucursal']) ? $conn->real_escape_string($_POST['codigoSucursal']) : "NULL";

            $sql = "INSERT INTO empleado (Nombre, Telefono, Puesto, Sueldo, RFC, CodigoGerente, CodigoSucursal) 
                    VALUES ('$nombreEmpleado', '$telefono', '$puesto', '$sueldo', '$rfc', $codigoGerente, $codigoSucursal)";
            break;

        case "proveedor":
            $nombreProveedor = $_POST['nombreProveedor'];
            $telefonoProveedor = $_POST['telefonoProveedor'];
            $codigoSucursalP = !empty($_POST['codigoSucursalP']) ? $conn->real_escape_string($_POST['codigoSucursalP']) : "NULL";
            $tipoArticuloP = !empty($_POST['tipoArticuloP']) ? "'" . $conn->real_escape_string($_POST['tipoArticuloP']) : "NULL";
            $ciudad = !empty($_POST['ciudad']) ? "'" . $conn->real_escape_string($_POST['ciudad']) : "NULL";
            $direccionP = !empty($_POST['direccionP']) ? "'" . $conn->real_escape_string($_POST['direccionP']) : "NULL";

            $sql = "INSERT INTO proveedor (Telefono, Nombre, CodigoSucursal, TipoArticulo, Ciudad, Direccion) 
                    VALUES ('$telefonoProveedor', '$nombreProveedor', $codigoSucursalP, $tipoArticuloP, $ciudad, $direccionP)";
            break;

        case "sucursal":
            $CodigoGerente = !empty($_POST['codigoGerente']) ? "'" . $conn->real_escape_string($_POST['codigoGerente']) : "NULL";
            $CodigoProveedor = !empty($_POST['codigoProveedor']) ? "'" . $conn->real_escape_string($_POST['codigoProveedor']) : "NULL";
            $Ciudad = $_POST['Ciudad'];
            $Direccion = $_POST['Direccion'];
            $CP = $_POST['CP'];

            $sql = "INSERT INTO sucursal (CodigoGerente, CodigoProveedor, Ciudad, Direccion, CP) 
                    VALUES ($CodigoGerente, $CodigoProveedor, '$Ciudad', '$Direccion', '$CP')";
            break;

        default:
            echo "Formulario no reconocido.";
            exit;
    }

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "<script type='text/javascript'>
        alert('Registro exitoso en la tabla $formulario.');
        window.location.href = 'altas.html';  
      </script>";
    } else {
        echo "<script type='text/javascript'>
        alert('Error al registrar en $formulario: " . $conn->error . "');
        window.location.href = 'altas.html';  
      </script>";
    }
} else {
    echo "No se recibió un formulario válido.";
}

// Cerrar la conexión
$conn->close();
?>
