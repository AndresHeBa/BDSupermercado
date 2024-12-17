<!-- AQUI NO VAN ESTILOS :))))))) -->

<?php
    // Conexión a la base de datos (utilizando mysqli)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "supermarket";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    // utf8
    $conn->set_charset("utf8");
?>

<!-- <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexión a Base de Datos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        h1 {
            color: #333;
            margin-top: 20px;
        }
        .container {
            margin: 50px auto;
            max-width: 500px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            padding: 20px;
        }
        .success {
            color: #4CAF50;
            font-weight: bold;
        }
        .error {
            color: #f44336;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Estado de la Conexión</h1>
    <div class="container">
        <?php if ($conn->connect_error): ?>
            <p class="error">❌ Conexión fallida: <?php echo $conn->connect_error; ?></p>
        <?php else: ?>
            <p class="success">✅ Conexión exitosa a la base de datos "<?php echo $dbname; ?>"</p>
        <?php endif; ?>
    </div>
</body>
</html> -->
