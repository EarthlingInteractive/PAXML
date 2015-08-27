default: run-unit-tests

.PHONY: \
	run-unit-tests \
	test-dependencies

vendor: composer.lock
	composer install
	touch "$@"

composer.lock: | composer.json
	composer install

run-unit-tests: vendor
	vendor/bin/phpunit --bootstrap vendor/autoload.php test

test-dependencies: vendor
