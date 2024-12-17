<?php
include 'mySQLConnection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Venta</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Editar Venta</h1>

    <form method="POST" id="selectVenta">
        <label for="ventaId">Seleccionar venta:</label>
        <select name="codigoVenta" id="ventaId" required>
            <option value="">--Seleccione una venta--</option>
            <?php
            $sql = "SELECT CodigoVenta, NombreVendedor FROM venta";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['CodigoVenta'] . "'>" . $row['NombreVendedor'] . "</option>";
                }
            } else {
                echo "<option value=''>No hay ventas</option>";
            }
            ?>
        </select>
        <button type="submit">Editar</button>
    </form>

    <?php
    // Verificar si se recibió un ID por POST
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['codigoVenta']) && !empty($_POST['codigoVenta'])) {
        $id = $_POST['codigoVenta'];

        // Consulta para obtener los datos de la venta
        $sql = "SELECT * FROM venta WHERE CodigoVenta = $id";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nombreVendedor = $row['NombreVendedor'];
            $totalVenta = $row['TotalVenta'];
            $codigoSucursal = $row['CodigoSucursal'];
            $fecha = $row['Fecha'];
        } else {
            die("Venta no encontrada.");
        }
    } else {
        die("No se proporcionó un Código de Venta.");
    }

    // Cerrar la conexión
    $conn->close();
    ?>

    <!-- Formulario para editar una venta -->
    <form id="formVenta">
        <label for="nombreVendedor">Nombre del Vendedor:</label>
        <input type="text" id="nombreVendedor" name="nombreVendedor" value="<?php echo htmlspecialchars($nombreVendedor); ?>" required><br><br>

        <label for="totalVenta">Total de la Venta:</label>
        <input type="number" step="0.01" id="totalVenta" name="totalVenta" value="<?php echo htmlspecialchars($totalVenta); ?>" required><br><br>

        <label for="codigoSucursal">Código de Sucursal:</label>
        <input type="number" id="codigoSucursal" name="codigoSucursal" value="<?php echo htmlspecialchars($codigoSucursal); ?>"><br><br>

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" value="<?php echo htmlspecialchars($fecha); ?>" required><br><br>

        <!-- Campo oculto para el ID -->
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <button type="submit">Guardar Cambios</button>
    </form>

    <div id="responseMessage" style="margin-top:20px; color: green;"></div>

    <script>
        $(document).ready(function() {
            $('#formVenta').on('submit', function(e) {
                e.preventDefault(); // Evita el envío tradicional del formulario

                // Realizar la petición AJAX
                $.ajax({
                    url: 'updateVenta.php', // Archivo PHP que actualiza la venta
                    type: 'POST',
                    data: $(this).serialize(), // Envía los datos del formulario
                    success: function(response) {
                        $('#responseMessage').html(response); // Mensaje de éxito o error
                    },
                    error: function(xhr, status, error) {
                        $('#responseMessage').html('<span style="color: red;">Ocurrió un error: ' + error + '</span>');
                    }
                });
            });
        });
    </script>
</body>
</html>
