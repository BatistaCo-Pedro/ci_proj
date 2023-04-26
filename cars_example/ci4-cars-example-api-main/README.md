# CI4 RESTful API Example «Cars»

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).


## Installation

Update composer components
`composer update`


## Setup

1. Copy `env` to `.env` and tailor for your app, specifically the environment, baseURL and any database settings.

3. Create new database 
   `php spark db:create cars`

4. Migrate & seed database 
   `php spark migrate`

5. Optional: Seed example data
   `php spark db:seed Cars`


## Run

`php spark serve`


## Server Requirements

PHP version 7.4 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
