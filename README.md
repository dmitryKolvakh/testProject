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
GET -- http://localhost:8000/api/tokens-geo-search

Filter
GET --  http://localhost:8000/api/tokens?name=&description=&tag=&page=1
GET --  http://localhost:8000/api/tokens-geo-search?lat=17.774331&lng=-100.919018&radius=300
