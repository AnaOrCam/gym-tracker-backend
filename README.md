# Backend - Gym Traker

Este es el backend de la aplicación Gym Tracker, desarrollado con **Laravel 10**. Funciona como una **API RESTful** que permite gestionar usuarios, entrenamientos, ejercicios y sus relaciones.

## Requisitos

- PHP 8.1 o superior
- Composer
- MySQL/MariaDB
- Laravel 10
- Node.js y NPM (solo si vas a compilar assets de frontend de Laravel)

---

## Instalación

1. Clona este repositorio:

```bash
git clone https://github.com/AdrianCB27/gym-tracker-backend.git
cd gym-tracker-backend
```

2. Instala las dependencias:

```bash
composer install
```

3. Crea una copia del archivo `.env`:

```bash
cp .env.example .env
```

4. Configura las variables de entorno en `.env`, especialmente la conexión a la base de datos y de envío de correo:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gymtracker
DB_USERNAME=root
DB_PASSWORD=tu_contraseña
```


Para crear la estructura de la base de datos

```bash
php artisan migrate
```
---

## Endpoints de la API

Los endpoints están definidos en `routes/api.php`
