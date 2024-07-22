
# Laragames

This Laravel 11 project uses Laravel Sail, Redis, Sanctum and Postgresql. It's project regarding managing a game platform. Current implementation provides APIs of basic user functionalities like register, login, logout and get logged in user data. Also, it provides information of daily leaderboard and api to update score of loggedin user so that we can check api and cache service is working fine.


## Requirements
- Composer
- Docker

Note: First installtion will take time as it will setup whole project and install project dependencies.

## Installation

### 1. Clone the repository

```sh
git clone https://github.com/jeet1293/laragames.git
cd laragames
```

### 2. Install dependencies

```sh
composer install
```

### 3. Set up environment variables

```sh
cp .env.example .env

php artisan key:generate
```

Note: Please create database and make necessary changes in the .env file

### 4. Start the container

```sh
./vendor/bin/sail up -d
```

### 5. Migration and seeding

```sh
./vendor/bin/sail artisan migrate --seed
```

### 6. APIs testing

```sh
Postman collection is added in the folder `public/postman`
```
