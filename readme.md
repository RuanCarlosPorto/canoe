Step by step to run the application

- Install vendor dependencies(https://getcomposer.org/download/): `composer install`
- Transform .env.example into .env: `cp .env.example .env`
- Create docker containers using laravel sail(https://laravel.com/docs/12.x/sail): `./vendor/bin/sail up`
- In another terminal tab, run the migrations: `./vendor/bin/sail artisan migrate`
- Install laravel keys: `./vendor/bin/sail artisan key:generate`
- Install npm dependencies: `npm install`
- Run vue frontend: `npm run dev`
- Access the application in the browser: `http://localhost:8000`