## Cantinapp

Cantinapp is an application that allows you and your restaurant publish dishes and allow that your clients make orders through a website. 
The order is queued and in your cook, you can put a monitor to see what orders were make, change their states and to delivery orders
to your clients.

## Requirements
1. PHP 7.1+
2. MySQL 5.7+

## Installation

1. Clone the repo from URL: git clone https://github.com/sbarbosa115/cantinapp.git
2. Run composer to install dependencies:
    ```
    composer install
    ```
3. Run npm to generate assets.
    ```
    npm run development
    ```
4. Run migrations
    ```
    php artisan migrate
    ```
5. Put write permissions to public/letters folder.

## Tests
```
vendor/bin/phpunit
```

