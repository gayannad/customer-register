##Setup Instructions
  

Install dependencies
```
composer install
npm install
npm run watch
``` 

Copy .env file  for configurations

```
cp .env.example .env
```

Generate app key
```
php artisan key:generate
```

Database migration
```
php artisan migrate
```


Run the local test server

```
php artisan serve
```

