reboot: env-init docker-down docker-up

docker-up:
	docker-compose up -d --build --remove-orphans

docker-down:
	docker-compose down -v --remove-orphans

env-init:
	rm -f .env && cp -n .env.example .env

run:
	docker exec -it FRAMEWORK_PHP $(filter-out $@,$(MAKECMDGOALS))

debug:
	docker exec -it FRAMEWORK_PHP php -dxdebug.start_with_request=yes $(filter-out $@,$(MAKECMDGOALS))

test:
	docker exec -it FRAMEWORK_PHP ./vendor/bin/phpunit
