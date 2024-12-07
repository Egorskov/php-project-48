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
	./bin/gendiff file1.json /Users/egorgorskov/file2.json

