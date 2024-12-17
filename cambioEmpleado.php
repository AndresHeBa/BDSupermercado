<?php
    include 'mySQLConnection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Editar Empleado</h1>

    <form method="POST" id="selectEmpleado">
        <label for="empleadoId">Seleccionar empleado:</label>
        <select name="id" id="empleadoId" required>
            <option value="">--Seleccione un empleado--</option>
            <?php
            $sql = "SELECT CodigoEmpleado, Nombre FROM empleado";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['CodigoEmpleado'] . "'>" . $row['Nombre'] . "</option>";
                }
            } else {
                echo "<option value=''>No hay empleados</option>";
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
        $sql = "SELECT * FROM empleado WHERE CodigoEmpleado = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nombre = $row['Nombre'];
            $telefono = $row['Telefono'];
            $puesto = $row['Puesto'];
            $sueldo = $row['Sueldo'];
            $rfc = $row['RFC'];
            $codigoGerente = $row['CodigoGerente'];
            $codigoSucursal = $row['CodigoSucursal'];
        } else {
            echo "No se encontró el empleado.";
        }

        $conn->close();
    }
    ?>

    <?php if (!empty($id) && !empty($nombre)) : ?>
        <!-- Formulario para editar un empleado -->
        <form id="formEmpleado">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required><br><br>
            
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($telefono); ?>"><br><br>
            
            <label for="puesto">Puesto:</label>
            <input type="text" id="puesto" name="puesto" value="<?php echo htmlspecialchars($puesto); ?>"><br><br>
            
            <label for="sueldo">Sueldo:</label>
            <input type="number" step="0.01" id="sueldo" name="sueldo" value="<?php echo htmlspecialchars($sueldo); ?>"><br><br>
            
            <label for="rfc">RFC:</label>
            <input type="text" id="rfc" name="rfc" value="<?php echo htmlspecialchars($rfc); ?>"><br><br>
            
            <label for="codigoGerente">Código Gerente:</label>
            <input type="number" id="codigoGerente" name="codigoGerente" value="<?php echo htmlspecialchars($codigoGerente); ?>"><br><br>
            
            <label for="codigoSucursal">Código Sucursal:</label>
            <input type="number" id="codigoSucursal" name="codigoSucursal" value="<?php echo htmlspecialchars($codigoSucursal); ?>"><br><br>
            
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit">Guardar</button>
        </form>
    <?php endif; ?>

    <div id="responseMessage" style="margin-top:20px; color: green;"></div>

    <script>
        $(document).ready(function() {
            $('#formEmpleado').submit(function(e) {
                e.preventDefault();

                var form = $(this);
                var url = form.attr('action') || window.location.pathname;
                var method = form.attr('method') || 'POST';
                var data = form.serialize();

                $.ajax({
                    type: method,
                    url: 'updateEmpleado.php',
                    data: data,
                    success: function(response) {
                        $('#responseMessage').html(response);
                    }
                });
            });
        });
    </script>

</body>
</html>