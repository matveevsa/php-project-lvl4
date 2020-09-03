start:
	php artisan serve --host 0.0.0.0

setup:
	touch database/database.sqlite
	cp -n .env.example .env || true
	composer install
	php artisan migrate --seed
	php artisan key:generate
	npm install

deploy:
	git push heroku

lint:
	composer run-script phpcs -- --standard=PSR12 tests app

test:
	php artisan test

test-coverage:
	composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml
