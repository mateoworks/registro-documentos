# Proyecto Registro documentos - Instrucciones de Instalación

## Requisitos Previos

-   PHP >= 7.4
-   Composer
-   Node.js y npm
-   Servidor web (por ejemplo, Apache o Nginx)
-   Base de datos MySQL o compatible (nombre de la base de datos: documentos)
-   O el paquete Xampp o Laragon

## Pasos de Instalación

1. **Clonar el Repositorio:**

```
git clone https://github.com/mateoworks/registro-documentos
```

2. **Instalar Dependencias:**

```
cd registro-documentos
composer install
npm install
```

3. **Configurar el archivo .env:**

-   Copiar el archivo `.env.example` y renombrarlo a `.env`.
-   Configurar la conexión a la base de datos:
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=documentos
    DB_USERNAME=usuario
    DB_PASSWORD=contraseña
    ```
-   Generar la clave de la aplicación:
    ```
    php artisan key:generate
    ```

4. **Migrar la Base de Datos:**

```
php artisan migrate --seed
```

5. **Configurar URL y Almacenamiento:**

-   Configurar la URL en el archivo `.env`:
    ```
    APP_URL=http://localhost
    ```
-   Crear un enlace simbólico para el almacenamiento público:
    `   php artisan storage:link`

6.  **Ejecutar Servidor de Desarrollo:**

```
php artisan serve
```
