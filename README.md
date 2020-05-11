# PHP MVC Register, Login & Post 

A simple PHP MVC user authentication application framework from scratch. Implements [Twig] templating engine. This would be useful for small projects. It would really help if you understand the basics of object-oriented programming and MVC, and if you are capable of using the cmd line. This script isn't for beginners.

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

### Later implement?
* sass?
* images?
* react.js?
