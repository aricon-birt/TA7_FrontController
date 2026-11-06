# TA7_FrontController

Aplicación web en PHP con estructura **MVC** y un **controlador frontal** (*front controller*).
El usuario escribe su nombre, elige **Saludar** o **Despedirse**, y la aplicación encapsula el resultado en un objeto `User`, lo serializa a **JSON** y lo muestra con `var_dump()`.

> Módulo **DWES** (Desarrollo Web en Entorno Servidor) · UD02 · Tarea de Aprendizaje 7 — *Gestión con Front Controller*
> Creado a partir de la plantilla [MVC_PHP_Template](https://github.com/aricon-birt/MVC_PHP_Template) (TA6) con *Use this template*.

---

## Recorrido de una petición

El código está comentado con marcas `[TA7-n]` que siguen este recorrido. Para estudiarlo, lee los ficheros en este orden:

| Marca | Fichero | Qué ocurre |
|---|---|---|
| `[TA7-1]` | `app/views/user-form.php` | **Vista.** Formulario con el campo `nombre` y dos botones con `name="action"` y `value` `saludar` / `despedirse`. Envía por GET a `index.php`. |
| `[TA7-2]` | `public/index.php` | **Front controller: preparación.** Carga las clases con `require_once`, lee `$_GET['action']` y `$_GET['nombre']`. Sin acción → muestra el formulario. Valida que haya nombre. |
| `[TA7-3]` | `public/index.php` | **Enrutamiento.** Con `match` decide qué método de `UserController` ejecutar. Acción desconocida → error 400. |
| `[TA7-4]` | `app/controllers/UserController.php` | **Controlador.** `saludar()` y `despedirse()` construyen el texto y devuelven un `User`. No muestran nada. |
| `[TA7-5]` | `app/models/User.php` | **Modelo.** Clase `User` con los atributos públicos `nombre` y `texto`, rellenados por el constructor. |
| `[TA7-6]` | `public/index.php` | **Serializar y mostrar.** `json_encode($user, JSON_UNESCAPED_UNICODE)` y `var_dump()` del resultado. |

```
Navegador ──GET index.php?nombre=Ane&action=saludar──► public/index.php [TA7-2]
                                                          │ match [TA7-3]
                                                          ▼
                                            UserController::saludar() [TA7-4]
                                                          │ new User(...)
                                                          ▼
                                                     User [TA7-5]
                                                          │
Navegador ◄──── var_dump(json_encode($user)) ◄────────────┘ [TA7-6]
```

## Ficheros de la tarea

```
TA7_FrontController/
├── app/
│   ├── controllers/
│   │   └── UserController.php   [TA7-4] métodos saludar() y despedirse()
│   ├── models/
│   │   └── User.php             [TA7-5] atributos nombre y texto
│   └── views/
│       └── user-form.php        [TA7-1] formulario
└── public/
    └── index.php                [TA7-2] [TA7-3] [TA7-6] front controller
```

El resto de carpetas (`app/core`, `config`, `logs`, `vendor`…) proceden de la plantilla; su finalidad está explicada en el [README de MVC_PHP_Template](https://github.com/aricon-birt/MVC_PHP_Template#readme).

## Puesta en marcha

```bash
git clone https://github.com/aricon-birt/TA7_FrontController.git
cd TA7_FrontController
php -S localhost:8000 -t public
```

Abrir <http://localhost:8000>.

## Pruebas

| Petición | Resultado esperado |
|---|---|
| `/` | Formulario |
| `/index.php?nombre=Ane&action=saludar` | `string(...) "{"nombre":"Ane","texto":"Hola, soy Ane desde el método SALUDAR del controlador USER."}"` |
| `/index.php?nombre=Ane&action=despedirse` | `string(...) "{"nombre":"Ane","texto":"Soy Ane, Adios desde el método DESPEDIRSE del controlador USER."}"` |
| `/index.php?action=saludar` | 400 · "Falta el nombre" |
| `/index.php?nombre=Ane&action=borrar` | 400 · "Acción no válida" |

Comprobaciones por consola:

```bash
php -l app/models/User.php
php -r "require 'app/models/User.php'; require 'app/controllers/UserController.php'; var_dump((new App\Controllers\UserController())->saludar('Ane'));"
```

## Registro de cambios

| Versión | Fecha | Cambios |
|---|---|---|
| 0.1.0 | 2026-11-06 | Modelo `User`, `UserController` (saludar/despedirse), vista `user-form.php` y front controller con enrutamiento, validación y salida JSON. |

---

Autor: Álvaro Ricón
