FROM php:8.2

CMD php artisan serve --host=0.0.0.0 --port=8000
EXPOSE 3306 8000