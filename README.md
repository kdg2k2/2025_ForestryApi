# run command with cmd or powershell
copy .env.example .env

composer install

php artisan db:drop

php artisan db:create

php artisan migrate:fresh --seed

php artisan optimize:clear

php artisan jwt:secret
