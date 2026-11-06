<?php
/**
 * [TA7-5] MODELO: User
 *
 * Papel en MVC: el modelo representa los DATOS de la aplicación.
 * Aquí un "usuario" es solo un nombre y un texto (el mensaje generado).
 * No sabe nada de formularios ni de HTML: solo guarda información.
 *
 * Quién lo usa: UserController [TA7-4] crea objetos User con new User(...).
 */

// El namespace es el "apellido" de la clase: su nombre completo es App\Models\User.
// Sirve para que no choque con otra clase User (por ejemplo, de una librería).
// Por convención, el namespace sigue la ruta de carpetas: app/models -> App\Models.
namespace App\Models;

class User
{
    // Atributos que pide el enunciado.
    // - "public": se pueden leer desde fuera del objeto.
    //   ¡Importante! json_encode() [TA7-6] solo convierte los atributos PUBLIC.
    //   Si fueran private, el JSON saldría vacío: {}
    // - "string": tipo declarado (PHP 7.4+). Si alguien intenta guardar
    //   un array u otro tipo incompatible, PHP lanza un error en vez de aceptarlo en silencio.
    public string $nombre;   // nombre introducido en el formulario
    public string $texto;    // mensaje de saludo o despedida

    // Constructor: se ejecuta automáticamente al hacer new User(...).
    // Su trabajo es dejar el objeto "listo", con sus atributos rellenos.
    // OJO: __construct lleva DOS guiones bajos (es un "método mágico" de PHP).
    public function __construct(string $nombre, string $texto)
    {
        // $this es "este objeto". $this->nombre es el atributo;
        // $nombre (sin $this) es el parámetro que llega al constructor.
        $this->nombre = $nombre;
        $this->texto  = $texto;
    }
}