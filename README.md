# Demo Laravel app
This application is a demonstration of Laravel using MVC architecture with Blade/Breeze/Tailwind.css.
It implements most of the Laravel basic and advanced features. See the home page for details.

## Preparation
1. Create MySQL Database e.g. demo_laravel

2. Copy .env.dist to .env and replace values beginning with your_ for your environment.

3. Composer Install
```sh
composer install
```
4. npm install
```sh
npm install
```

5. Run migrations
```sh
php artisan migrate
```

6. Seed the database
```sh
php artisan db:seed
```

7. Create a symbolic link for storage
```sh
php artisan storage:link
```

## Running the application
1. Start the services
```sh
php artisan serve
```

```sh
npm run dev
```

```sh
php artisan queue:work
```

```sh
php artisan websockets:serve
```

2. Navigate to http://localhost:8000


3. Login with a user created in user seeder: database/seeders/UserSeeder.php. Default password is Demo1234 for allow users:

## License

The Demo Laravel app is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
