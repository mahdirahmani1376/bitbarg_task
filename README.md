# Bitbarg task

## project description
this is an implementation of an project which users can create and assign tasks
to other users

## Setup
- clone the repo and run the following commands
```sh
cp .env .env.example
docker compose up -d --build
docker exec -it bitbarg_task-php-1 composer install
docker exec -it bitbarg_task-php-1 php artisan migrate --seed
```
## Postman link
https://cloudy-station-989745.postman.co/workspace/bitbarg~5cf9583f-f230-4c74-802b-9b7c639846e8/collection/20361896-9326dcb1-c9ad-4892-bb10-94bec396e4bf?action=share&creator=20361896
## How to test the application in PostMan
1. Login the User via the "User/Login" request and set the token global variable
2. Create a task
3. You can assign users to a task with the Assign users method
4. Assigned users can mark the task as completed with the complete task method
## Porject description based on task
#####User Authentication and Authorization
- For roles i have used the spatie permissions library which is a very complete tool
 the available roles are admin and user
- For checking permission of users to different sections i used Policies located in the 
 App\Policies namespace
- Authentication is scafolded with sanctum that is built-in laravel
- Caching is done by redis on index routes for getting users and tasks code can be found on UserController->index() and TaskController->index() method
- Logging is availabe via the acivity_logs table which stores all the data before and after a model change including the user that changed it for store,update,delete routes



