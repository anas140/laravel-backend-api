
## Installation

``` bash
# clone the repo
$ git clone https://github.com/anas140/laravel-backend-api.git anas_test

# go into app's directory
$ cd anas_test

# install app's dependencies
$ composer install
```

### Copy file ".env.example", and change its name to ".env".Then in file ".env" replace this database configuration:

### In your .env file change database credentials 
* DB_CONNECTION=mysql
* DB_HOST=127.0.0.1
* DB_PORT=3306
* DB_DATABASE=anas_database
* DB_USERNAME=root
* DB_PASSWORD=root

### Create database  named anas_database in mysql

### Next step


# in your app directory
``` bash
# generate laravel APP_KEY
$ php artisan key:generate

# run database migration and seed
$ php artisan migrate

# run passport install to add passport 
$ php artisan passport:install
```
## Usage

``` bash
# start local server
$ php artisan serve
```
### Open Postman client app and test
[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/db051bac438eb2fadddf)

### import the sample products excel file (producrs.xlsx) in this directory
### add athorization token in each requests except login and register 
### add request header `Accept: application/json` in each request
