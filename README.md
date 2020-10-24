
## Installation

``` bash
# clone the repo
$ git clone https://github.com/anas140/laravel-backend-api.git anas_test

# go into app's directory
$ cd anas_test

# install app's dependencies
$ composer install

# Copy file ".env.example", and change its name to ".env".Then in file ".env" replace this database configuration:

# In your .env file change database credentials 
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=anas_database
DB_USERNAME=root
DB_PASSWORD=root

# Create database  named anas_database in mysql

### Next step

``` bash
# in your app directory
# generate laravel APP_KEY
$ php artisan key:generate

# run database migration and seed
$ php artisan migrate

# run passport install to add passport 
$ php artisan passport:install

## Usage

``` bash
# start local server
$ php artisan serve

# Open Postman client app and test
[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/db051bac438eb2fadddf)


To use the latest published version, click the following button to import the SparkPost API as a collection:

[![Run in Postman](https://s3.amazonaws.com/postman-static/run-button.png)](https://app.getpostman.com/run-collection/5d9ae743a661a15d64bb)

# import the sample file products excel file in this directory
