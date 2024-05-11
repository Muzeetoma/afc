 docker-compose down -v
 docker-compose up -d
 sleep 5
 docker exec -it afc-app /bin/bash -c "php artisan serve --host=0.0.0.0 --port=9007"
