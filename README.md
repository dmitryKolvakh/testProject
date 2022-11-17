# TEST Project

## Build Backend
```
cp .env.example .env
cp docker-compose.yml.example docker-compose.yml
docker-compose up -d
docker-compose exec php composer install
docker-compose exec php artisan migrate
```
## Seed to DB
```
docker-compose exec php artisan db:seed
```

## List route
GET -- http://localhost:8000/api/tokens 

Filter
GET --  http://localhost:8000/api/tokens?name=&description=&tag=&page=1

