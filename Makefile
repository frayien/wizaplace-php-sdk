

all: install lint stan test

install:
ifndef CIRCLE_BUILD_NUM
	composer install
else
	composer install --no-interaction --no-progress
endif

lint:
ifndef CIRCLE_BUILD_NUM
	./vendor/bin/phpcs
else
	mkdir -p ./phpcs/
	./vendor/bin/phpcs --report-full --report-junit=./phpcs/junit.xml
endif

stan:
ifndef CIRCLE_BUILD_NUM
	./vendor/bin/phpstan analyse -l 5 src
else
	./vendor/bin/phpstan --no-interaction --no-progress analyse -l 5 src
endif

test:
ifndef CIRCLE_BUILD_NUM
	./vendor/bin/phpunit --configuration ./phpunit.xml
else
	php ./vendor/bin/phpunit --configuration ./phpunit.xml
endif

delete-all-cassettes:
	cd tests/ && find . -name "*.yml" -type f -delete

generate-all-cassettes: delete-all-cassettes test

.PHONY: all install lint stan test delete-all-cassettes generate-all-cassettes
