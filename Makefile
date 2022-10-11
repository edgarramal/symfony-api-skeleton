SERVICE_NAME = 'symfony-skeleton_php_1'

composer c:
	docker exec -ti $(SERVICE_NAME) composer $(a)

composer-install ci:
	docker exec -ti $(SERVICE_NAME) composer install

composer cu:
	docker exec -ti $(SERVICE_NAME) composer update

composer-require cr:
	docker exec -ti $(SERVICE_NAME) composer require $(a)

composer-install ci:
	docker exec -ti $(SERVICE_NAME) composer install

weasyprint-service-test wst:
	docker exec -ti $(SERVICE_NAME) php /var/www/service/vendor/bin/phpunit tests

report-test rt:
	docker exec -ti $(SERVICE_NAME) php /var/www/service/vendor/bin/phpunit tests/Components/ReportComponentTest.php

test t:
	docker exec -ti $(SERVICE_NAME) php /var/www/service/vendor/bin/phpunit tests

phpstan:
	docker exec -ti $(SERVICE_NAME) php /var/www/service/vendor/bin/phpstan analyse src

phpcs:
	docker exec -ti $(SERVICE_NAME) php /var/www/service/vendor/bin/phpcs src

console:
	docker exec -ti $(SERVICE_NAME) php /var/www/service/bin/console $(a)

worker-incoming-consume wic:
	docker exec -ti $(SERVICE_NAME) php /var/www/service/bin/console messenger:consume incoming

php:
	docker exec -ti $(SERVICE_NAME) php $(a)