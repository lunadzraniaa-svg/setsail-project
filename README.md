# Gadget Catalog

A gadget catalog app I built with Laravel. You can add, view, edit, and
delete gadgets, including their product photos.

## Features
- Add, view, edit, and delete gadgets (name, brand, price, description, image)
- Search gadgets by name or brand
- Paginated gadget list
- REST API at /api/gadgets
- MVC architecture with a MySQL database

## Tech Stack
- Laravel
- MySQL (via Laragon)
- Tailwind CSS

## Getting Started
1. Make sure PHP, Composer, and MySQL (Laragon) are installed, and start MySQL
2. Clone this repo and go into its folder
3. Run `composer install`
4. Copy the env file: `copy .env.example .env`
5. Run `php artisan key:generate`
6. Create a database named `setsail` in MySQL (for example with HeidiSQL)
7. Run `php artisan migrate`
8. Run `php artisan storage:link` so uploaded images display
9. Run `php artisan serve`
10. Open http://127.0.0.1:8000/gadgets in your browser

## API Endpoints
- GET /api/gadgets : get all gadgets
- GET /api/gadgets/{id} : get one gadget
- POST /api/gadgets : create a gadget
- PUT /api/gadgets/{id} : update a gadget
- DELETE /api/gadgets/{id} : delete a gadget