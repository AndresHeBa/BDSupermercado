<?php
include 'mySQLConnection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Artículo</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Editar Artículo</h1>

    <!-- Formulario para seleccionar el artículo -->
    <form method="POST" id="selectArticleForm">
        <label for="articleId">Seleccionar artículo:</label>
        <select name="id" id="articleId" required>
            <option value="">--Seleccione un artículo--</option>
            <?php
            $sql = "SELECT CodigoArticulo, Nombre FROM articulo";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['CodigoArticulo'] . "'>" . $row['Nombre'] . "</option>";
                }
            } else {
                echo "<option value=''>No hay artículos</option>";
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
        $sql = "SELECT * FROM articulo WHERE CodigoArticulo = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nombre = $row['Nombre'];
            $precioCompra = $row['PrecioCompra'];
            $precioVenta = $row['PrecioVenta'];
            $codigoProveedor = $row['CodigoProveedor'];
            $tipoArticulo = $row['TipoArticulo'];
        } else {
            echo "No se encontró el artículo.";
        }

        $conn->close();
    }
    ?>

    <?php if (!empty($id) && !empty($nombre)) : ?>
        <!-- Formulario para editar un artículo -->
        <form id="formArticulo">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required><br><br>
            
            <label for="precioCompra">Precio de Compra:</label>
            <input type="number" step="0.01" id="precioCompra" name="precioCompra" value="<?php echo htmlspecialchars($precioCompra); ?>" required><br><br>
            
            <label for="precioVenta">Precio de Venta:</label>
            <input type="number" step="0.01" id="precioVenta" name="precioVenta" value="<?php echo htmlspecialchars($precioVenta); ?>" required><br><br>
            
            <label for="codigoProveedor">Código Proveedor:</label>
            <input type="number" id="codigoProveedor" name="codigoProveedor" value="<?php echo htmlspecialchars($codigoProveedor); ?>"><br><br>
            
            <label for="tipoArticulo">Tipo de Artículo:</label>
            <input type="text" id="tipoArticulo" name="tipoArticulo" value="<?php echo htmlspecialchars($tipoArticulo); ?>" required><br><br>
            
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit">Guardar Cambios</button>
        </form>
    <?php endif; ?>

    <div id="responseMessage" style="margin-top:20px; color: green;"></div>

    <script>
        $(document).ready(function() {
            $('#formArticulo').on('submit', function(e) {
                e.preventDefault(); // Evitar el envío tradicional del formulario
                
                $.ajax({
                    url: 'updateArticulo.php', // Archivo PHP que procesa la solicitud
                    type: 'POST',
                    data: $(this).serialize(), // Serializar los datos del formulario
                    success: function(response) {
                        $('#responseMessage').html(response); // Mostrar mensaje de éxito
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
