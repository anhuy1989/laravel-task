<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>


## About Laravel-Task

Laravel-Task is a simple task web application include: user roles and permissions (acl) using laravel-permission and laravel 6.0

- [spatie/laravel-permission](https://github.com/spatie/laravel-permission).

## Set up local environment
Copy `.env.example` to `.env` file

Update mail setting in .env: Using mailtrap or gmail smtp to activate sending mail
```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=****
MAIL_PASSWORD=****
MAIL_ENCRYPTION=null
```

Create database then update in .env:

```
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=task_app
DB_USERNAME=root
DB_PASSWORD=root

```
At the root project folder, run those commands below:

- Install libraries from composer:
```
composer install
```

- Install UI from npm:

```
npm install && npm run dev
```


- Migrate database 
```
php artisan migrate
```

- Run database seeder
```
php artisan db:seed
```

- Run built-in PHP server in the root folder

```
php artisan serve

```

Go to url: [http://localhost:8000/](http://localhost:8000/). to check Task App.

Admin account: admin@gmail.com/123456

**Thank you and have fun :)**


## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
