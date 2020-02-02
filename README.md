Assignment
==============


Step 1

Run `composer install`

Step 2

Config database

Step 3
I have written database migration so, 
Create Database : `php bin/console doctrine:database:create`

Step 4

Create Schema: `php bin/console doctrine:schema:update --force`

Step 5

Feed the database `php bin/console doctrine:fixtures:load`

Step 6

Run the application: `php bin/console server:start`

or you can place the folder in local server and open in the browser.

Test Cases

`./vendor/bin/simple-phpunit`


Note:
* Coupon stored in coupon table.
* Discount details are stored in the catergory table.
* Cart Total Value rounded for two decimal places.
* Since there are no any user registration, cart's books store using a unique id. 
when user close the browser, cart item will         be lose.

