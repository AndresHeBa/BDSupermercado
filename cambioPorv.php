<?php
include 'mySQLConnection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proveedores</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Editar Proveedores</h1>

    <!-- Formulario para seleccionar el proveedor -->
    <form method="POST" id="selectProveedorForm">
        <label for="proveedorId">Seleccionar proveedor:</label>
        <select name="id" id="proveedorId" required>
            <option value="">--Seleccione un proveedor--</option>
            <?php
            $sql = "SELECT CodigoProveedor, Nombre FROM proveedor";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['CodigoProveedor'] . "'>" . $row['Nombre'] . "</option>";
                }
            } else {
                echo "<option value=''>No hay proveedores</option>";
            }

            
            ?>
        </select>
        <button type="submit">Editar</button>
    </form>

    <br>

    <?php
    // Verificar si se ha recibido el ID por POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];
        $sql = "SELECT * FROM proveedor WHERE CodigoProveedor = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nombre = $row['Nombre'];
            $telefono = $row['Telefono'];
            $codigoSucursal = $row['CodigoSucursal'];
            $tipoArticulo = $row['TipoArticulo'];
            $ciudad = $row['Ciudad'];
            $direccion = $row['Direccion'];
        } else {
            echo "No se encontró el proveedor.";
        }

        $conn->close();
    }
    ?>

    <?php if (!empty($id) && !empty($nombre)) : ?>
        <!-- Formulario para editar un proveedor -->
        <form id="formProveedor">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required><br><br>
            
            <label for="telefono">Telefono:</label>
            <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($telefono); ?>" required><br><br>
            
            <label for="codigoSucursal">Codigo de Sucursal:</label>
            <input type="number" id="codigoSucursal" name="codigoSucursal" value="<?php echo htmlspecialchars($codigoSucursal); ?>" ><br><br>
            
            <label for="tipoArticulo">Tipo de Articulo:</label>
            <input type="text" id="tipoArticulo" name="tipoArticulo" value="<?php echo htmlspecialchars($tipoArticulo); ?>" required><br><br>
            
            <label for="ciudad">Ciudad:</label>
            <input type="text" id="ciudad" name="ciudad" value="<?php echo htmlspecialchars($ciudad); ?>" required><br><br>
            
            <label for="direccion">Direccion:</label>
            <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($direccion); ?>" required><br><br>
            
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit">Guardar</button>
        </form>
    <?php endif; ?>

    <div id="responseMessage" style="margin-top:20px; color: green;"></div>

    <script>
        $(document).ready(function() {
            $('#formProveedor').submit(function(e) {
                e.preventDefault();

                var form = $(this);
                var url = 'updateProveedor.php';

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: form.serialize(),
                    success: function(data) {
                        $('#responseMessage').html(data);
                    }
                });
            });
        });
    </script>
</body>
</html>