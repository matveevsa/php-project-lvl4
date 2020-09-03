start:
	php artisan serve --host 0.0.0.0

setup:
	env-prepare sqlite-prepare install key db-prepare

deploy:
	git push heroku

lint:
	composer run-script phpcs -- --standard=PSR12 tests app

test:
	php artisan test

install:
	composer install
	npm install

db-prepare:
	php artisan migrate --seed

reset-db:
	php artisan migrate:reset

test-coverage:
	composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml

env-prepare:
	cp -n .env.example .env || true

sqlite-prepare:
	touch database/database.sqlite

key:
	php artisan key:generate