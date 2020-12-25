# Movies Rating API
API Laravel with the objective of evaluating films from an intreternment and cinema company

### Setting

Edit  `.env` file:

`DB_CONNECTION=mysql`

`DB_HOST=db`

`DB_PORT=3306`

`DB_DATABASE=movies_rating_api`

`DB_USERNAME=root`

`DB_PASSWORD=root`




### Run in the docker container

Run the following commands from the application root.

`docker-compose up -d --build`

`docker exec -it movies-rating-api_app_1 bash`

`composer install`

`php artisan migrate`

`php artisan key:generate`

`php artisan db:seed --class=MoviesSeeder`

`chmod 777 -R *`

`http://localhost:8080/api/movie/index`



> You can import the **`/postman/Movies-rating-api.postman_collection.json`** file to test the API.
