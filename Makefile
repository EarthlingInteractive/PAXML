default: run-unit-tests

.PHONY: \
	run-unit-tests

vendor: composer.lock
	composer install

composer.lock: | composer.json
	composer install

run-unit-tests: vendor
	vendor/bin/phpunit --bootstrap vendor/autoload.php test
