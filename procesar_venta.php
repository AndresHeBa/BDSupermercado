<?php
// procesar_venta.php
session_start();
require_once 'mySQLConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION['carrito'])) {
    try {
        $conn->begin_transaction();
        
        // Insertar la venta
        $vendedor = $_POST['vendedor'];
        $sucursal = $_POST['sucursal'];
        $total = 0;
        
        foreach ($_SESSION['carrito'] as $articulo) {
            $total += $articulo['precio'] * $articulo['cantidad'];
        }
        
        $sql = "INSERT INTO venta (NombreVendedor, TotalVenta, CodigoSucursal, Fecha) VALUES (?, ?, ?, CURDATE())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdi", $vendedor, $total, $sucursal);
        $stmt->execute();
        
        $venta_id = $conn->insert_id;
        
        // Insertar los detalles
        $sql = "INSERT INTO detallesventa (CodigoVenta, CodigoArticulo, CantidadArticulo) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        foreach ($_SESSION['carrito'] as $id => $articulo) {
            $stmt->bind_param("iii", $venta_id, $id, $articulo['cantidad']);
            $stmt->execute();
        }
        
        $conn->commit();
        
        // Limpiar el carrito
        unset($_SESSION['carrito']);
        
        echo "Venta realizada con éxito!";
        echo "<br><a href='formulario_busqueda.php'>Realizar otra venta</a>";
        
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error al procesar la venta: " . $e->getMessage();
    }
}
?>