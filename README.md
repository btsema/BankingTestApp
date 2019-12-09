## Introduction
With this test we want to get an idea of your proficiency in backend related web development technologies. We will give you a task specification below and you are free to use whatever PHP libraries, frameworks etc. you consider as useful to implement it together with SQL database (preferably MySQL or SQLite). You shall provide us with a hosted git repository of your resulting work including a readme file to describe the required steps to deploy it locally.

Task
Implement a REST API that shall be used internally, so no authentication is needed. Format shall be JSON. No front­end or graphical interface is needed.

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
- DB_DATABASE=homestead
- DB_USERNAME=homestead
- DB_PASSWORD=secret

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

Access it on
http://your-local-domain/
API Reporting

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
- Implementing Query Object (we could extract to the model - query scope, create a repository, or we could make a single-use query class as OptimisticLockingTransaction) to perform our complex query operations that can be changed often 
- Making WeeklyReport service (implementing some ReportService interface) for the business logic or business layer of the application
- Implementing Pessimistic vs Optimistic Locking ( https://medium.com/snapptech/pessimistic-vs-optimistic-locking-in-laravel-264ec0b1ba2 )
- Laravel Custom Logger (app/Utilities/CustomLogger))
- Tests (Feature test - UpdateUserInSameTimeTest folder(tests/Feature), Unit test - MakeTransactionTest folder(tests/Feature))
- Database Factory pattern seeders (UsersSeeder, CountrySeeder, TransactionsSeeder)
- barryvdh/laravel-debugbar to manage and test all queries

## ER diagram
<img src="https://raw.githubusercontent.com/btsema/BankTestApp/master/er.png"/>
