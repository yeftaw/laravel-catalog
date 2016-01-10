## Laravel Simple Catalog

A simple catalog built with laravel 5.2

### Installation Instruction
Makes a bare clone of the external repository in a local directory
```
git clone https://github.com/yevta/laravel-catalog.git
cd laravel-catalog
```

Secondly do an installation using composer
```
composer install
```

After all dependencies are completely downloaded, copy .env.example to .env and generate key for the application
```
cp .env.example .env
php artisan key:generate
```

Dont forget to setting up an local database config inside .env. Then do a migration.
```
php artisan migrate --seed
```

Above command will do a migrating and seeding comand. Now serve the app and run locally.
```
php artisan serve
```
