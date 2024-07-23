<?php
/* @autor Braulio Ruiz */
include '../../class/autoload.php';

$categoria = new Categorias();
$categorias = $categoria->obtenerTodas();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Categorías ..:: SiberOs ::..</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
</head>

<body>
    <a href="../../index.php">
        <header>
            <img src="../../assets/img/logo.png" alt="Logo de la Empresa" class="logo">
            <h1>Listado de Categorías</h1>
        </header>
    </a>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $cat) : ?>
                    <tr>
                        <td><?php echo $cat['id']; ?></td>
                        <td><?php echo $cat['nombre']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="categorias.html" class="nav-link">Agregar nuevas categorías</a>
        <p>Creado por Braulio Ruiz Niñoles</p>
    </div>
    <script src="../../assets/js/main.js"></script>
</body>

</html>