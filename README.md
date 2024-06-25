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
 - ` Content-Type: application/json
Authorization: Bearer <your-token> `
-   `
"email":"ajuliush2@gmail.com",
"password":"password",
 `
  ## Lgout Endpoin
  - `method: post `
 - `api/logout`
 - ` Content-Type: application/json
Authorization: Bearer <your-token> `

## Product CDUR 

## Show all product Endpoin
- `method: get `
- `api/inventory/products`
- ` Content-Type: application/json
Authorization: Bearer <your-token> `

## Store product Endpoin
- `method: post `
- `api/inventory/product`
- ` Content-Type: application/json
Authorization: Bearer <your-token> `
-   `
 "name": "Sample Product",
    "sku": "PROD1234",
    "symbology": "ABC",
    "brand_id": 1,
    "category_id": 1,
    "warehouse_id": 1,
    "unit_id": 1,
    "price": 99.99,
    "qty": 100,
    "alert_qty": 10,
    "tax_method": "inclusive",
    "tax_id": 1,
    "has_stock": true,
    "has_expired_date": false,
    "expired_date": null,
    "details": "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
    "is_active": true,
    "attachments": [
        {
            "uploaded_user_id": 52,
            "url": "http://example.com/file1.pdf",
            "state": "active",
            "label": "Attachment 1",
            "file": "file1.pdf",
            "content_type": "application/pdf",
            "user": "user1"
        },
        {
            "uploaded_user_id": 52,
            "url": "http://example.com/file2.pdf",
            "state": "inactive",
            "label": "Attachment 2",
            "file": "file2.pdf",
            "content_type": "application/pdf",
            "user": "user2"
        }
    ]
 `
 ## Show product Endpoin
- `method: get `
- `api/inventory/product/{id}`
- ` Content-Type: application/json
Authorization: Bearer <your-token> `

## Update product Endpoin
- `method: put `
- `api/inventory/product/{id}`
- ` Content-Type: application/json
Authorization: Bearer <your-token> `
-   `
 {
    "name": "Sample 0000000 u",
    "sku": "PROD1234 0000000000",
    "symbology": "0000000",
    "brand_id": 10,
    "category_id": 10,
    "warehouse_id": 10,
    "unit_id": 10,
    "price": 90.99,
    "qty": 700,
    "alert_qty": 90,
    "tax_method": "exclusive",
    "tax_id": 10,
    "has_stock": true,
    "has_expired_date": false,
    "expired_date": null,
    "details": "Lorem ipsum dolor sit amet, consectetur adipiscing elit u.",
    "is_active": true,
    "attachments": [
        {
            "uploaded_user_id": 49,
            "url": "http://dddddddddd.com/file1.pdf",
            "state": "active",
            "label": "ddddddddddd 1",
            "file": "ddddddddddd.pdf",
            "content_type": "applicatioun/pdf",
            "user": "ddddddddddd"
        }
    ]
}
 `
  ## Delete product Endpoin
- `method: delete `
- `api/inventory/product/{id}`
- ` Content-Type: application/json
Authorization: Bearer <your-token> `