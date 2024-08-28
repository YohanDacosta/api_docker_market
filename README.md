# api_market
API REST MARKET
##### . frontend-market (react)
#####  . api_docker_market (php, symfony)
CONFIGURATIONS
###### 1. docker-compose up -d --build
        ######IMAGEN######              ######SERVICE######
        mariadb:10.5                      db
        nginx:stable-alpine               nginx
        api_docker_market-php             php
###### 2. docker-compose exec -it php bash
###### 3. composer update
######   3.1 ->  curl -sS https://get.symfony.com/cli/installer | bash
######   3.2 ->  mv /root/.symfony5/bin/symfony /usr/local/bin/symfony
###### 4. symfony server:start
###### 5. php bin/console doctrine:schema:update -- force
###### 6. php bin/console make:migration
###### 7. php bin/console doctrine:migrations:migrate


