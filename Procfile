web: vendor/bin/heroku-php-apache2 public/
release: php artisan migrate:fresh
worker: php artisan queue:work --queue=email
