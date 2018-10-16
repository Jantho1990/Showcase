# Change these to the values for your test MySQL DB
db_host="192.168.10.10"
db_port=3306
db_database=showcase_test_db
db_username=homestead
db_password=secret

if [ -d "./test-project" ]; then
    php ./reset-db.php $db_host $db_database $db_username $db_password
    rm -rf test-project
    echo "Removed old test project."
fi

php ./create-db.php $db_host $db_database $db_username $db_password
composer create-project laravel/laravel test-project 5.4.*
php ./edit-composer.php
cd test-project
sed -i '' "s/DB_HOST=127.0.0.1/DB_HOST=$db_host/g" .env
sed -i '' "s/DB_PORT=3306/DB_PORT=$db_port/g" .env
sed -i '' "s/DB_DATABASE=homestead/DB_DATABASE=$db_database/g" .env
sed -i '' "s/DB_USERNAME=homestead/DB_USERNAME=$db_username/g" .env
sed -i '' "s/DB_PASSWORD=secret/DB_PASSWORD=$db_password/g" .env
sed -i '' "s|// \$this->call(UsersTableSeeder::class);|\$this->call(UsersTableSeeder::class);|" ./database/seeds/DatabaseSeeder.php

sed -i '' 's/Laravel\\Tinker\\TinkerServiceProvider::class,/Laravel\\Tinker\\TinkerServiceProvider::class,\
        Showcase\\App\\Providers\\ShowcaseProvider::class,\
        Laracasts\\Flash\\FlashServiceProvider::class,/' ./config/app.php

cp ../UsersTableSeeder.php ./database/seeds/
composer require brokerexchange/showcase=dev-feature/namespace-showcase-routes
composer dump-autoload
echo "Pre auth"
php artisan make:auth
echo "Post auth"
npm install
cd ..
bash update-test-project.sh --migrations --rundev
echo "Test project built!"
echo "To fire it up, cd into the test project and use php artisan serve"