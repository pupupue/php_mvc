# PHP Model View Controller mini-framework

A PHP MVC user authentication application framework from scratch. Implements [Twig] templating engine. 
## Requirements
* PHP 5.5+
* MySQL 5 database

## Installation
* Make sure you have Apache, PHP, MySQL installed.
* Clone this repo to your server.
* Activate mod_rewrite, route all traffic to application's www/public folder.
* Edit config.php and set your database credentials.
* Execute the SQL statements in the _install directory to setup database tables.

### Install Composer
Go to project folder and run the composer install command;

```bash
composer install
```

### Install Database
Import the SQL files from _install via phpmyadmin.

### Routing
* Routing logic can be found in Core/Router.php
* Routes can be setup in the front controller at public/index.php


