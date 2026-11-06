# MVC_PHP_Template

Plantilla base para aplicaciones web en PHP siguiendo el patrón **Modelo-Vista-Controlador (MVC)**.
Sirve como punto de partida para futuros proyectos y se irá ampliando mediante *pull requests* a medida que surjan nuevas necesidades.

> Módulo **DWES** (Desarrollo Web en Entorno Servidor) · UD02 · Tarea de Aprendizaje 6 — *Creación de una estructura MVC*

---

## ¿Qué es MVC?

MVC separa la aplicación en tres responsabilidades:

| Capa | Qué hace | Dónde vive |
|---|---|---|
| **Modelo** | Representa y gestiona los datos (consultas a BD, validaciones de datos). | `app/models` |
| **Vista** | Lo que ve el usuario: plantillas HTML con el mínimo PHP imprescindible. | `app/views` |
| **Controlador** | Recibe la petición, pide los datos al modelo y decide qué vista mostrar. Hace de intermediario. | `app/controllers` |

Flujo de una petición:

```
Navegador ──► public/index.php ──► Enrutador (app/core) ──► Controlador
                                                              │    ▲
                                                              ▼    │
                                                            Modelo (datos)
                                                              │
                                                              ▼
Navegador ◄──────────────────────── HTML ◄──────────────── Vista
```

## Estructura del proyecto

```
MVC_PHP_Template/
├── app/
│   ├── controllers/   Controladores
│   ├── models/        Modelos
│   ├── views/         Vistas
│   └── core/          Núcleo: enrutador, controlador base y componentes esenciales
├── config/
│   └── config.php     Configuración general (nombre de la app, BD...)
├── logs/              Registro de eventos y errores (opcional; su contenido no se sube)
├── public/            ÚNICA carpeta accesible desde el navegador
│   ├── css/
│   ├── js/
│   ├── img/
│   └── index.php      Punto de entrada único (front controller)
├── vendor/            Dependencias de Composer (se genera con `composer install`)
├── composer.json      Definición del proyecto y sus dependencias
├── .gitignore
└── README.md
```

### Finalidad de cada carpeta

- **`app/controllers`** — Un controlador por sección de la aplicación (p. ej. `HomeController`, `ProductoController`). Cada método atiende una acción.
- **`app/models`** — Clases que acceden a los datos y aplican las reglas sobre ellos. No generan HTML.
- **`app/views`** — Archivos de presentación. Reciben los datos ya preparados por el controlador.
- **`app/core`** — Clases base del framework propio: enrutador (decide qué controlador atiende cada URL), controlador base, conexión a base de datos…
- **`public`** — Raíz del servidor web. Solo lo que está aquí es accesible por URL; el resto del código queda protegido fuera del alcance del navegador.
- **`config`** — Configuración de la aplicación y del entorno. Las credenciales reales van en `config/config.local.php`, que **no** se sube a GitHub.
- **`vendor`** — Librerías externas instaladas con Composer. No se versiona su contenido: se reconstruye con `composer install`.
- **`logs`** — Ficheros de registro para depuración y monitorización.

> Las carpetas vacías contienen un fichero `.gitkeep` porque Git no guarda carpetas vacías.

## Requisitos

- PHP 8.2 o superior (incluido en XAMPP)
- [Composer](https://getcomposer.org) (opcional por ahora; necesario cuando se añadan dependencias)
- Git

## Puesta en marcha

```bash
git clone https://github.com/aricon-birt/MVC_PHP_Template.git
cd MVC_PHP_Template
composer install                      # genera vendor/
php -S localhost:8000 -t public       # servidor de desarrollo de PHP
```

Abrir <http://localhost:8000>. El parámetro `-t public` hace que `public/` sea la raíz web, igual que se configuraría en Apache.

## Flujo de trabajo con Git

Cada cambio en la estructura se hace en una rama propia y se integra mediante *pull request*:

```bash
git checkout -b nombre-del-cambio
# ...cambios...
git add .
git commit -m "Descripción del cambio"
git push -u origin nombre-del-cambio
# En GitHub: Compare & pull request → Merge
git checkout main
git pull
```

## Registro de cambios

| Versión | Fecha | Cambios |
|---|---|---|
| 0.1.0 | 2026-11-01 | Estructura base MVC: carpetas `app/{controllers,models,views,core}`, `public`, `config`, `vendor`, `logs`; `public/index.php` mínimo; `config/config.php`; `composer.json`; `.gitignore`. |

## Próximas mejoras (futuros PR)

- [ ] Enrutador en `app/core/Router.php`
- [ ] Controlador base en `app/core/Controller.php` con método para cargar vistas
- [ ] Primer controlador y vista de ejemplo (`HomeController` + `app/views/home.php`)
- [ ] Autocarga de clases PSR-4 con Composer
- [ ] Conexión a base de datos (PDO) en `app/core`
- [ ] Gestión de errores y escritura en `logs/`

---

