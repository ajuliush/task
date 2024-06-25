# Laravel Project Installation Guide

This guide provides instructions to set up the Laravel project from the GitHub repository.

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/ajuliush/task.git
    ```
2. Navigate into the project directory:
    ```bash
    cd task/
    ```
3. Install the project dependencies:
    ```bash
    composer install
    ```
4. Copy the example environment file to a new `.env` file:
    ```bash
    cp .env.example .env
    ```
5. Update the `.env` file with your database credentials and other necessary configurations.
6. Generate a new application key:
    ```bash
    php artisan key:generate
    ```
7. Install npm dependencies:
    ```bash
    npm install
    ```
8. Compile the frontend assets:
    ```bash
    npm run dev
    ```
9. Run the database migrations and seed the database:
    ```bash
    php artisan migrate:fresh --seed
    ```
10. Start the Laravel development server:
    ```bash
    php artisan serve
    ```

By default, the application will be accessible at `http://localhost:8000`.

`Register end point `


` POST /api/register
    Content-Type: application/json

    {
    "name":"juliush",
    "email":"ajuliush2@gmail.com",
    "password":"password",
    "password_confirmation": "password"
 }`



  11. Register end point:
    ```bash
    
```

  12. Login endpoint:
    ```bash

    POST /api/login
    Content-Type: application/json

    {
        "email": "ajuliush2@gmail.com",
        "password": "password"
    }
```
     13. Start the Laravel development server:
    ```bash
        POST /api/logout
    Content-Type: application/json

```
