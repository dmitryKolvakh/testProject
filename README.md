# TEST Project

## Build Backend
```
cp .env.example .env
cp docker-compose.yml.example docker-compose.yml
docker-compose up -d
docker exec -i testproject-myapp-1 composer install
docker exec -i testproject-myapp-1 php artisan migrate
```
## Seed to DB
```
docker exec -i testproject-myapp-1 php artisan db:seed
```

## List route
GET -- http://localhost:8000/api/tokens

Filter
GET --  http://localhost:8000/api/tokens?name=&description=&tag=&page=1

