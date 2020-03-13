### Instructions

Create a mini news website with CRUD operations for Admin and APIs to get all articles and one article.


### To run this project
* Clone the repository to your computer.
* Run `composer install && npm install` to install PHP and JS dependencies needed by the application,
* Copy `.env.example` to `.env` and set the `DB_DATABASE`, `DB_USERNAME` and `DB_PASSWORD` environment variables.
* Run `npm run dev` to compile JS assets.
* Run `php artisan migrate:fresh --seed` to migrate the database and seed it with some sample data.
* Run `php artisan serve` to serve the project using PHP's internal server. Skip this step if you wish to use another server.
