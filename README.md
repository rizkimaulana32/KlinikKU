<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Use Case Diagram

![alt text](DiagramUseCase.png)

## Installation

1. Clone the repository:

    ```bash
    https://github.com/rizkimaulana32/KlinikKU.git
    ```

2. Navigate to the project directory:

    ```bash
    cd KlinikKU
    ```

3. Install PHP dependencies:

    ```bash
    composer install
    ```

4. Copy the `.env.example` file to `.env` and configure your database:

    ```bash
    cp .env.example .env
    ```

    Then edit the `.env` file to match your database configuration.

5. Generate the application key:

    ```bash
    php artisan key:generate
    ```

6. Install DomPDF:

    ```bash
    composer require barryvdh/laravel-dompdf
    ```

7. Create a storage symlink:

    ```bash
    php artisan storage:link
    ```

8. Migrate the database and seed (if applicable):

    ```bash
    php artisan migrate --seed
    ```

9. Install npm dependencies and build assets:

    ```bash
    npm install
    ```

    ```bash
    npm run dev
    ```

10. Start the development server:

    ```bash
    php artisan serve
    ```

If you follow these steps, your application should be set up correctly.
