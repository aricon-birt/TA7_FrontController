<?php
/**
 * [TA7-4] CONTROLADOR: UserController
 *
 * Papel en MVC: el controlador es el INTERMEDIARIO. Recibe lo que pide el
 * usuario (ya "traducido" por el front controller), aplica la lógica
 * y usa el modelo para guardar el resultado.
 *
 * Quién lo usa: el front controller public/index.php [TA7-3] decide cuál
 * de los dos métodos llamar según el botón pulsado.
 * A quién usa: al modelo User [TA7-5], creando un objeto con new User(...).
 */

// Namespace siguiendo la carpeta: app/controllers -> App\Controllers.
namespace App\Controllers;

// "use" crea un ALIAS: a partir de aquí, escribir User equivale a App\Models\User.
// Sin esta línea, PHP buscaría App\Controllers\User (el namespace actual) y fallaría.
// OJO: "use" NO carga el fichero User.php. Solo abrevia el nombre.
// Quien carga los ficheros es el front controller con require_once [TA7-2].
use App\Models\User;

class UserController
{
    /**
     * Acción "saludar": se ejecuta cuando el usuario pulsa el botón Saludar.
     *
     * @param string $nombre  Nombre escrito en el formulario.
     * @return User           Objeto con el nombre y el mensaje de saludo.
     */
    public function saludar(string $nombre): User
    {
        // Comillas DOBLES: PHP sustituye {$nombre} por su valor (interpolación).
        // Con comillas simples saldría literalmente el texto {$nombre}.
        $texto = "Hola, soy {$nombre} desde el método SALUDAR del controlador USER.";

        // Encapsular: en vez de devolver dos variables sueltas,
        // devolvemos UN objeto que agrupa los dos datos.
        return new User($nombre, $texto);
    }

    /**
     * Acción "despedirse": se ejecuta cuando el usuario pulsa el botón Despedirse.
     *
     * @param string $nombre  Nombre escrito en el formulario.
     * @return User           Objeto con el nombre y el mensaje de despedida.
     */
    public function despedirse(string $nombre): User
    {
        $texto = "Soy {$nombre}, Adios desde el método DESPEDIRSE del controlador USER.";
        return new User($nombre, $texto);
    }
}