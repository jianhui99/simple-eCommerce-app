# simple-eCommerce-app
This is a simple catalogue that demonstrates the understanding of querying from a RESTful API.


## Set Up Project

Clone project
```bash
clone the project to your local. 
PS:you need a LAMP environment to set up this project, example: XAMPP, WAMP or Laragon
```

Generate APP_KEY
```bash
php artisan key:generate 
```

Set up .env file
```bash
copy and paste the .env.example and rename to .env, and rename the DB connection to your local db credentials
```

Migrate database
```baash
php artisan migrate
```

Run project
```baash
php artisan serve
```