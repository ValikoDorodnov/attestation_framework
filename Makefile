run:
	docker exec -it FRAMEWORK_PHP $(filter-out $@,$(MAKECMDGOALS))

debug:
	docker exec -it FRAMEWORK_PHP php -dxdebug.start_with_request=yes $(filter-out $@,$(MAKECMDGOALS))

test:
	docker exec -it FRAMEWORK_PHP ./vendor/bin/phpunit