<?php

// Conexión a la base de datos
include 'mySQLConnection.php';
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

function buscarArticulo($id, $conn) {
    $sql = "SELECT * FROM articulo WHERE CodigoArticulo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar'])) {
    $id = $_POST['codigo_articulo'];
    $cantidad = $_POST['cantidad'];
    
    $articulo = buscarArticulo($id, $conn);
    
    if ($articulo) {
        // Agregar al carrito
        if (!isset($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id] = [
                'nombre' => $articulo['Nombre'],
                'precio' => $articulo['PrecioVenta'],
                'cantidad' => $cantidad
            ];
        } else {
            $_SESSION['carrito'][$id]['cantidad'] += $cantidad;
        }
    }
}
?>

<!-- formulario_busqueda.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Buscar Artículo</title>
</head>
<body>
    <h2>Agregar Artículo a la Venta</h2>
    <form method="POST" action="">
        <label>Código de Artículo:</label>
        <input type="number" name="codigo_articulo" required>
        <label>Cantidad:</label>
        <input type="number" name="cantidad" min="1" required>
        <input type="submit" name="buscar" value="Agregar al Carrito">
    </form>

    <h3>Artículos en el Carrito:</h3>
    <table border="1">
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Subtotal</th>
        </tr>
        <?php
        $total = 0;
        foreach ($_SESSION['carrito'] as $id => $articulo) {
            $subtotal = $articulo['precio'] * $articulo['cantidad'];
            $total += $subtotal;
            ?>
            <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo $articulo['nombre']; ?></td>
                <td><?php echo $articulo['cantidad']; ?></td>
                <td>$<?php echo number_format($articulo['precio'], 2); ?></td>
                <td>$<?php echo number_format($subtotal, 2); ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="4">Total:</td>
            <td>$<?php echo number_format($total, 2); ?></td>
        </tr>
    </table>

    <?php if (!empty($_SESSION['carrito'])) { ?>
        <form method="POST" action="procesar_venta.php">
            <label>Nombre del Vendedor:</label>
            <input type="text" name="vendedor" required>
            <label>Sucursal:</label>
            <select name="sucursal" required>
                <?php
                $sql = "SELECT CodigoSucursal, Ciudad FROM sucursal";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['CodigoSucursal'] . "'>" . $row['Ciudad'] . "</option>";
                }
                ?>
            </select>
            <input type="submit" value="Completar Venta">
        </form>
    <?php } ?>
</body>
</html>

