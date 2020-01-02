## Dependency

- PHP 7.2
- MYSQL 5.7

## Installation
- Clone repository
- $ git clone https://github.com/btsema/BankingTestApp.git
- Run in your terminal
- $ composer install
- $ php artisan key:generate

## Setup
- Setup database connection in .env file ( Change .env.example file to .env)
- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=DB_NAME_HERE
- DB_USERNAME=DB_USERNAME_HERE
- DB_PASSWORD=DB_PASSWORD_HERE

Install node package manager NPM
$ npm install

Migrate tables with demo data
$ php artisan migrate:fresh --seed

Laravel 5 Files Folders Permission and Ownership Setup
$ cd /dir/of/laravel
$ chmod -R 777 ./storage ./bootstrap

You may need to use sudo on these commands if you get permission denied errors, i.e.:
$ sudo cd /path/to/banktransaction
$ sudo chmod -R 777 ./storage ./bootstrap

API route
http://your-local-domain/api/reporting

WEB routes
http://your-local-domain/login
http://your-local-domain/register
http://your-local-domain/reporting

Auth routes home
http://your-local-domain/home

## v1.0

- Database migration schema (users table, countries table, transactions table etc.)
- Creating models (User(Customer), Transaction etc.)
- SOLID principles
- Business Logic folder(app\Services)
- Implementing Query Object to perform required query operations
- Making WeeklyReport service (implementing some ReportService interface) for the business logic or business layer of the application
- Laravel Custom Logger (app/Utilities/CustomLogger))
- Implementing Locking
- Tests (Feature test - UpdateUserInSameTimeTest folder(tests/Feature), Unit test - MakeTransactionTest folder(tests/Feature))
- Database Factory pattern seeders (UsersSeeder, CountrySeeder, TransactionsSeeder)
- barryvdh/laravel-debugbar to manage and test all queries

## ER diagram
<img src="https://raw.githubusercontent.com/btsema/BankTestApp/master/er.png"/>
