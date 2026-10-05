# E-Commerce REST API - Laravel 12

Una API RESTful completa y segura construida con Laravel 12 para la gestión de una plataforma de comercio electrónico. Este proyecto incluye autenticación robusta mediante tokens, gestión del catálogo de productos, procesamiento de órdenes con control de inventario y una pasarela de pagos integrada.

## Características Principales

* **Autenticación JWT:** Registro, inicio y cierre de sesión seguros utilizando `php-open-source-saver/jwt-auth`.
* **Gestión de Productos (CRUD):** Endpoints para listar, crear, visualizar, actualizar y eliminar productos del catálogo.
* **Procesamiento de Órdenes:** Creación de carritos de compra que reducen automáticamente el stock del inventario disponible.
* **Pasarela de Pagos (Stripe):** Integración con el SDK de Stripe (v22) para procesar los cobros de las órdenes generadas.
* **Documentación Interactiva:** Interfaz gráfica generada con Swagger (OpenAPI) para explorar y probar los endpoints de forma nativa.

## Tecnologías y Requisitos

* **PHP:** >= 8.2
* **Framework:** Laravel 12
* **Base de Datos:** MySQL
* **Autenticación:** JWT (JSON Web Tokens)
* **Pagos:** Stripe PHP SDK
* **Documentación:** L5-Swagger

## Instalación y Configuración

Sigue estos pasos para levantar el proyecto en un entorno local:

1. **Clonar el repositorio:**
   ```bash
   git clone <tu-enlace-de-github>
   cd ecommerce-api

   Instalar dependencias de Composer:

Bash
composer install
Configurar el entorno:
Copia el archivo de ejemplo para crear tu propio entorno y configura las variables de conexión a la base de datos MySQL y las credenciales de Stripe.

Bash
cp .env.example .env
Generar claves del sistema:

Bash
php artisan key:generate
php artisan jwt:secret
Ejecutar las migraciones:

Bash
php artisan migrate
Generar la documentación de la API:

Bash
php artisan l5-swagger:generate
Iniciar el servidor local:

Bash
php artisan serve
📖 Documentación de la API (Swagger)
Una vez que el servidor esté corriendo, puedes acceder a la documentación interactiva y probar todas las rutas directamente desde el navegador ingresando a:

 http://127.0.0.1:8000/api/documentation

Estructura de Rutas Principales
Públicas:

POST /api/register - Registro de usuario

POST /api/login - Inicio de sesión (Devuelve Token JWT)

GET /api/products - Ver catálogo de productos

GET /api/products/{id} - Ver detalle de un producto

Protegidas (Requieren Header Authorization: Bearer {token}):

POST /api/products - Crear producto

POST /api/orders - Generar una orden de compra

GET /api/orders - Ver historial de compras del usuario

POST /api/payments/process - Procesar pago con Stripe
