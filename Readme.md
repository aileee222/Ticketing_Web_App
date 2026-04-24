## A Ticketing Web App using Laravel framework and Docker Compose


### Features : 
- **Dashboard :** tickets and projects preview, ticket statuses, charts (in progress)
- **Ticket list :** sortable by Description, Comment, Owner, Duration, Status
- **Project list :** sortable by Description, Comment, Owner, Duration, Status
- **Calendar :** view and create events
- **Trash :** trash for tickets and projects
- **Profile :** user information
- **Help :** visual only

![alt text](image.png)

![alt text](image-1.png)

## Prerequisites
#### 1. Make sure to have Docker Compose installed on your machine.

## Installation
### Inside the project directory
#### 1. Create data folders
> mkdir -p data/laravel data/redis
#### 2. Set permissions for the database
> sudo chown -R www-data:www-data src
#### 3. Start the containers
> docker compose up -d
#### 4. Initialize the data
> docker compose exec app php artisan migrate:fresh --seed



## Disclaimer
### This project was for educationnal purpose only, it's not perfect, it still needs improvements.