## Installation

-   `https://github.com/ajuliush/task.git`
-   `cd task/`
-   `composer install`
-   `cp .env.example .env`
-   `update .env and set your database credentials`
-   `php artisan key:generate`
-   `npm install`
-   `npm run dev`
-   `php artisan migrate:fresh --seed`
-   `php artisan serve`

## Register, Login and Logout

## Register Endpoin
- `method: post `
- `api/register`
-   `
"name":"juliush",
"email":"ajuliush2@gmail.com",
"password":"password",
"password_confirmation": "password"
 `
 ## Login Endpoin
 - `method: post `
 - `api/login`
-   `
"email":"ajuliush2@gmail.com",
"password":"password",
 `
  ## Lgout Endpoin
  - `method: post `
 - `api/logout`
-   `
"email":"ajuliush2@gmail.com",
"password":"password",
 `
