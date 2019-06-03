**BileMo is a REST API that provides a phone showcase.**



php bin/console doctrine:database:drop --force -n
php bin/console doctrine:database:create -n
php bin/console doctrine:schema:create -n
php bin/console doctrine:fix:load -n
