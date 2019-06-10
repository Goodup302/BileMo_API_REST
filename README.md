
BileMo is a REST API that provides a phone showcase.
This site is created on the base of Symfony4 framework with [API Platform](https://api-platform.com/).

[![Maintainability](https://api.codeclimate.com/v1/badges/381e899303628747d77d/maintainability)](https://codeclimate.com/github/Goodup302/BileMo_API_REST/maintainability)

**The resources documents is in "documents" folder**

How to Install project
------

1. Get files

    ```shell
    git clone https://github.com/Goodup302/BileMo_API_REST.git
    composer install -o
    php bin/console cache:clear -e prod -n --no-debug
    ```
    
    Create .env.local file adne enter this:
    APP_ENV=prod
    DATABASE_URL=mysql://root:root@127.0.0.1:3306/bilemo

2. Generate BDD

    ```shell
    php bin/console doctrine:database:create -n
    php bin/console doctrine:schema:create -n
    ```
    
3. Generate the SSH keys for JWT auth

    Go to root of your project and start these commands
    ```shell
    mkdir -p config/jwt
    openssl genrsa -out config/jwt/private.pem -aes256 4096
    openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
    ```
    Next, enter passphrase in .env.local file
    (ex: JWT PASSPHRASE:admin)

Reset Fixtures
------
```shell
php bin/console doctrine:database:drop --force -n
php bin/console doctrine:database:create -n
php bin/console doctrine:schema:create -n
php bin/console doctrine:fix:load -n
```