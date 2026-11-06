<?php
// Punto de entrada único: todas las peticiones entran por aquí.
// Más adelante cargará el enrutador de app/core.

define('BASE_PATH', dirname(__DIR__));   // carpeta raíz del proyecto

$config = require BASE_PATH . '/config/config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($config['app_name']) ?></title>
</head>
<body>
    <h1><?= htmlspecialchars($config['app_name']) ?></h1>
    <p>La estructura MVC está en marcha.</p>
</body>
</html>