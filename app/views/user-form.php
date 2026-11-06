<?php
/**
 * [TA7-1] VISTA: formulario de usuario
 *
 * Papel en MVC: la vista es lo que VE el usuario. Solo contiene HTML
 * (y como mucho un poco de PHP para mostrar datos). Ninguna lógica.
 *
 * Quién la muestra: el front controller public/index.php [TA7-2] la carga
 * con require cuando la petición NO trae ninguna acción (primera visita).
 *
 * Qué envía: al pulsar un botón, el navegador hace una NUEVA petición a
 * index.php con dos datos: "nombre" (el texto) y "action" (el botón pulsado).
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>TA7 - Front Controller</title>
</head>
<body>
    <h1>Saludo o despedida</h1>

    <!--
        action="index.php": a dónde se envía el formulario -> al front controller.
            Es una ruta relativa a la URL actual. Como la vista la muestra index.php,
            el navegador está en http://localhost:8000/, así que apunta a /index.php.
            (Nunca a ../app/...: el navegador no puede llegar fuera de public/.)

        method="get": los datos viajan en la URL, por ejemplo:
            index.php?nombre=Ane&action=saludar
            Así se ve claramente lo que llega al servidor. En PHP se leen con $_GET.
            (Con method="post" irían ocultos en el cuerpo de la petición y se
            leerían con $_POST; es lo habitual cuando se modifican datos.)
    -->
    <form action="index.php" method="get">

        <!-- for="nombre" enlaza la etiqueta con el input de id="nombre":
             al hacer clic en el texto, el cursor salta al campo. -->
        <label for="nombre">Nombre:</label>

        <!-- name="nombre" es la CLAVE con la que llegará el dato: $_GET['nombre'].
             required: el navegador no deja enviar el formulario vacío. -->
        <input type="text" id="nombre" name="nombre" required>

        <!-- Dos botones de envío con el MISMO name y distinto value.
             Solo se envía el botón pulsado, así que $_GET['action'] valdrá
             "saludar" o "despedirse". Así sabe el front controller qué
             método del controlador ejecutar [TA7-3]. -->
        <button type="submit" name="action" value="saludar">Saludar</button>
        <button type="submit" name="action" value="despedirse">Despedirse</button>

    </form>
</body>
</html>