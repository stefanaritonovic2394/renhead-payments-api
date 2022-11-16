## Renhead Payments API Project Setup (local)
- `git submodule add https://github.com/Laradock/laradock.git`
- `cd laradock/`
- `cp .env.example .env`
- `docker-compose up -d nginx mysql phpmyadmin redis workspace`
- `docker-compose exec --user=laradock workspace bash`
- `Manage your own .env file by .env.example`
- `composer install`
- `php artisan migrate:fresh --seed`
