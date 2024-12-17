<?php
include 'mySQLConnection.php';
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Sucursal</title>
    <link rel="stylesheet" href="est/cambios.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h1>Editar Sucursal</h1>

    <form method="POST" id="selectSucursal">
        <label for="sucursalId">Seleccionar sucursal:</label>
        <select name="codigoSucursal" id="sucursalId" required>
            <option value="">--Seleccione una sucursal--</option>
            <?php
            $sql = "SELECT CodigoSucursal, Ciudad FROM sucursal";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['CodigoSucursal'] . "'>" . $row['Ciudad'] . "</option>";
                }
            } else {
                echo "<option value=''>No hay sucursales</option>";
            }
            ?>
        </select>
        <button type="submit">Editar</button>
    </form>

    <?php
    // Verificar si se recibió un ID por POST
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['codigoSucursal'])  && !empty($_POST['codigoSucursal'])) {
        $id = $_POST['codigoSucursal'];

        // Consulta para obtener los datos de la sucursal
        $sql = "SELECT * FROM sucursal WHERE CodigoSucursal = $id";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $codigoGerente = $row['CodigoGerente'];
            $codigoProveedor = $row['CodigoProveedor'];
            $ciudad = $row['Ciudad'];
            $direccion = $row['Direccion'];
            $cp = $row['CP'];
        } else {
            die("Sucursal no encontrada.");
        }
    } else {
        die("No se proporcionó un Código de Sucursal.");
    }
    ?>

    <!-- Formulario para editar una sucursal -->
    <form id="formSucursal">
        <label for="codigoGerente">Código Gerente:</label>
        <input type="number" id="codigoGerente" name="codigoGerente" value="<?php echo htmlspecialchars($codigoGerente); ?>"><br><br>

        <label for="codigoProveedor">Código Proveedor:</label>
        <input type="number" id="codigoProveedor" name="codigoProveedor" value="<?php echo htmlspecialchars($codigoProveedor); ?>"><br><br>

        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="ciudad" value="<?php echo htmlspecialchars($ciudad); ?>"><br><br>

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($direccion); ?>"><br><br>

        <label for="cp">Código Postal:</label>
        <input type="text" id="cp" name="cp" value="<?php echo htmlspecialchars($cp); ?>"><br><br>

        <!-- Campo oculto para el ID -->
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <button type="submit">Guardar Cambios</button>
    </form>

    <div id="responseMessage" style="margin-top:20px; color: green;"></div>

    <table>
        <tr>
            <th>Codigo Sucursal</th>
            <th>Codigo Gerente</th>
            <th>Codigo Proveedor</th>
            <th>Ciudad</th>
            <th>Direccion</th>
            <th>CP</th>
        </tr>
        <?php
        $sql = "SELECT * FROM sucursal";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["CodigoSucursal"] . "</td>";
                echo "<td>" . $row["CodigoGerente"] . "</td>";
                echo "<td>" . $row["CodigoProveedor"] . "</td>";
                echo "<td>" . $row["Ciudad"] . "</td>";
                echo "<td>" . $row["Direccion"] . "</td>";
                echo "<td>" . $row["CP"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </table>

    <script>
        $(document).ready(function() {
            $('#formSucursal').on('submit', function(e) {
                e.preventDefault(); // Evita el envío tradicional del formulario

                // Realizar la petición AJAX
                $.ajax({
                    url: 'updateSucursal.php', // Archivo PHP que actualiza la sucursal
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