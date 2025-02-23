install:
	composer install

validate:
	composer validate

lint:
	composer exec --verbose phpcs -- --standard=PSR12 src bin

lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 src tests

dump:
	composer dump-autoload

gendiff:
	./bin/gendiff  tests/fixtures/file1.json tests/fixtures/file2.json

gendiff-yaml:
	./bin/gendiff tests/fixtures/testfile1.yaml tests/fixtures/testfile2.yml

test:
	composer exec --verbose phpunit tests

test-coverage:
	XDEBUG_MODE=coverage composer --verbose exec phpunit tests -- --coverage-clover build/logs/clover.xml

test-coverage-html:
	XDEBUG_MODE=coverage composer --verbose exec phpunit tests -- --coverage-html build/report.html

