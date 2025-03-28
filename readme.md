Step by step to run the application

- Install vendor dependencies(https://getcomposer.org/download/): `composer install`
- Transform .env.example into .env: `cp .env.example .env`
- Install laravel sail if you do not have it yet((https://laravel.com/docs/12.x/sail)): `composer require laravel/sail --dev`
- Run your docker desktop or be sure your docker is running
- Be sure nothing is using default mysql port (3306)
- Create docker containers using laravel sail: `./vendor/bin/sail up`
- In another terminal tab, run migrations: `./vendor/bin/sail artisan migrate`
- Install laravel keys: `./vendor/bin/sail artisan key:generate`
- Install npm dependencies: `npm install`
- Run vue frontend: `npm run dev`
- Access the application in the browser: `http://localhost:8000`

* ER Diagram is present in graph.png file