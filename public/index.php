<?php
/**
 * FRONT CONTROLLER (controlador frontal): public/index.php
 *
 * Es el ÚNICO punto de entrada de la aplicación: TODAS las peticiones del
 * navegador llegan aquí, y desde aquí se decide qué hacer con cada una.
 *
 * Recorrido completo de una petición:
 *   [TA7-1] vista (formulario)      -> el usuario escribe su nombre y pulsa un botón
 *   [TA7-2] AQUÍ: preparación       -> cargar clases y leer los datos recibidos
 *   [TA7-3] AQUÍ: enrutamiento      -> elegir el método del controlador
 *   [TA7-4] UserController          -> genera el texto
 *   [TA7-5] User (modelo)           -> guarda nombre + texto en un objeto
 *   [TA7-6] AQUÍ: serializar/mostrar -> json_encode() + var_dump()
 */

// =====================================================================
// [TA7-2] PREPARACIÓN: cargar lo necesario y leer la petición
// =====================================================================

// Raíz del proyecto: __DIR__ es la carpeta de este fichero (public);
// dirname() sube un nivel. Así las rutas no dependen de desde dónde se ejecute.
define('BASE_PATH', dirname(__DIR__));

// Cargar las clases a mano (todavía no usamos el autoload de Composer).
// - require: si el fichero no existe, error fatal (mejor parar que seguir a ciegas).
// - _once: si ya se cargó, no lo repite (declarar dos veces una clase es error).
// El orden importa: UserController usa User, así que el modelo va primero.
require_once BASE_PATH . '/app/models/User.php';
require_once BASE_PATH . '/app/controllers/UserController.php';

// Alias para escribir UserController en vez de App\Controllers\UserController.
use App\Controllers\UserController;

// Leer los datos que envía el formulario (method="get" -> array $_GET).
// ?? es el operador de fusión de null: si $_GET['action'] no existe,
// usa null en vez de dar un aviso de "Undefined array key".
$action = $_GET['action'] ?? null;
// trim() quita espacios al principio y al final ("  Ane " -> "Ane").
$nombre = trim($_GET['nombre'] ?? '');

// Primera visita (http://localhost:8000/ sin datos): no hay acción.
// Mostramos el formulario [TA7-1] y terminamos la ejecución con exit.
if ($action === null) {
    require BASE_PATH . '/app/views/user-form.php';
    exit;
}

// Nunca hay que fiarse del cliente: "required" en el HTML se puede saltar
// escribiendo la URL a mano (index.php?action=saludar). Validamos en el servidor.
if ($nombre === '') {
    http_response_code(400);   // 400 = Bad Request (petición incorrecta)
    echo 'Falta el nombre. <a href="index.php">Volver</a>';
    exit;
}

// =====================================================================
// [TA7-3] ENRUTAMIENTO: decidir qué método del controlador se ejecuta
// =====================================================================

$controller = new UserController();

// match (PHP 8) compara $action con cada opción usando === (valor Y tipo)
// y devuelve el resultado de la rama que coincide. Es como un switch,
// pero más corto, sin break y devolviendo un valor.
// Usar una lista cerrada de acciones es intencionado: solo se pueden
// ejecutar los métodos que nosotros permitimos.
$user = match ($action) {
    'saludar'    => $controller->saludar($nombre),       // [TA7-4]
    'despedirse' => $controller->despedirse($nombre),    // [TA7-4]
    default      => null,                                // acción desconocida
};

if ($user === null) {
    http_response_code(400);
    echo 'Acción no válida. <a href="index.php">Volver</a>';
    exit;
}

// =====================================================================
// [TA7-6] SERIALIZAR A JSON Y MOSTRAR
// =====================================================================

// Serializar = convertir el objeto en texto para poder mostrarlo,
// guardarlo o enviarlo. json_encode() lo convierte a formato JSON:
//   {"nombre":"Ane","texto":"Hola, soy Ane desde el método ..."}
// - Solo incluye los atributos PUBLIC del objeto (ver [TA7-5]).
// - JSON_UNESCAPED_UNICODE: deja las tildes tal cual. Sin esta opción,
//   "método" saldría como "m\u00e9todo".
$json = json_encode($user, JSON_UNESCAPED_UNICODE);

// var_dump() muestra tipo, tamaño y contenido: string(N) "...".
// <pre> conserva saltos de línea y espacios para que se lea bien en el navegador.
echo '<pre>';
var_dump($json);
echo '</pre>';
echo '<a href="index.php">Volver</a>';