1. Open terminal in the root of this project and do following command:
~~~
install.sh
~~~
---OR ---
~~~
composer install
copy .env.example .env //or just copy the .env.example as .env
php artisan key:generate
~~~
2. Configure the .env file
3. do `php artisan migrate --seed`
##
