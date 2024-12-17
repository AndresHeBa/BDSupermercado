<?php
// index.php
include 'header.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal - Supermercado</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }

        /* Encabezado */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #b2d8b2; /* Verde clarito */
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .logo img {
            height: 50px;
            width: auto;
        }

        nav {
            display: flex;
            gap: 20px;
        }

        nav a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #4CAF50;
        }

        /* Contenedor principal */
        .container {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
        }

        .main-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 10px;
        }

        .frase {
            margin-top: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #4CAF50;
        }

        /* Sección de componentes */
        .section {
            margin: 40px auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .card {
            width: 280px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
        }

        .card h3 {
            margin: 10px 0;
            font-size: 18px;
            color: #333;
        }

        .card p {
            font-size: 14px;
            color: #666;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            margin-top: 20px;
        }
    </style>
</head>
<body>


    <!-- Contenido principal -->
    <div class="container">
        <!-- Imagen principal con frase -->
        <img src="img/spm1.jpg" alt="Imagen de Supermercado" class="main-image">
        <p class="frase">"Calidad y frescura en cada rincón de tu hogar"</p>
    </div>

    <!-- Componentes: Sección de categorías -->
    <div class="section">
        <div class="card">
            <img src="img/frut.jpg" alt="Frutas">
            <h3>Frutas y Verduras</h3>
            <p>Productos frescos y de alta calidad todos los días.</p>
        </div>
        <div class="card">
            <img src="img/leche.jpg" alt="Lácteos">
            <h3>Lácteos y Huevos</h3>
            <p>La mejor selección para tu desayuno y comidas.</p>
        </div>
        <div class="card">
            <img src="img/cr.jpg" alt="Carnes">
            <h3>Carnes y Pescados</h3>
            <p>Cortes frescos y deliciosos para tus recetas.</p>
        </div>
        <div class="card">
            <img src="img/pan.jpg" alt="Panadería">
            <h3>Panadería</h3>
            <p>El pan más crujiente y delicioso del día.</p>
        </div>
    </div>
<br>
<br>

</body>
</html>