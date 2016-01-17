## Laravel - Auth App

To start run the following commands:

```
git clone https://github.com/nikolalj/auth
cd auth
composer install
npm install
```

Rename your .env.example to .env file and generate the APP_Key:

```
php artisan key:generate
```

Create the your database and specify variables for accessing it in the .env file. Then, run migrations:

```
php artisan migrate
```
