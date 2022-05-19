# simple-eCommerce-app
This is a simple catalogue that demonstrates the understanding of querying from a RESTful API.

### Client portal
This client portal includes user login, register, add product, submit order function

### Admin portal
This admin portal includes manage product, user order function

- fetch product from live endpoint
go to manage product page (admin/wp-products), and click the [ Synchronize Products ] button to fetch the products 

## Installation

1. Clone the repo and `cd` into it. (git clone https://github.com/jianhui99/simple-eCommerce-app.git)
1. `composer install`
1. Rename or copy `.env.example` file to `.env`
1. `php artisan key:generate`
1. Set your database credentials in your `.env` file
1. `php artisan migrate`
1. `php artisan db:seed`
1. `npm install`
1. `npm run dev`
1. `php artisan serve`. This will migrate the database
1. Visit `localhost:8000` in your browser
2. Visit `/admin` if you want to access the laravel admin backend. Username: admin, Password: admin.
