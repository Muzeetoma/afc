 docker-compose down -v
 docker-compose up -d
 sleep 7
 docker exec -it afc-app /bin/bash -c "php artisan migrate && php artisan db:seed && php artisan serve --host=0.0.0.0 --port=9007"