EXEC_PHP    = php
EXEC_VENDOR = vendor/bin

SYMFONY     = symfony
COMPOSER    = composer

CONSOLE     = $(EXEC_PHP) bin/console

install: ## Install this project
install: .env.local vendor

server: ## Run webserver with this project
server: .env.local vendor
	$(SYMFONY) serve

.PHONY: install server

check: ## Launch all checks & lints
check: vendor
	$(COMPOSER) validate
	$(CONSOLE) lint:container
	$(CONSOLE) lint:twig templates --show-deprecations
	$(CONSOLE) lint:yaml config

cs-fix: ## apply php-cs-fixer fixes
cs-fix: vendor
	php-cs-fixer fix --using-cache=no --verbose --allow-risky=yes

.PHONY: check cs-fix

qa: ## Run all analyses & tests
qa: vendor
	$(EXEC_VENDOR)/deptrac
	$(EXEC_VENDOR)/phpstan analyse src --memory-limit 0
	bin/phpunit --testsuite full

test: ## Run unit tests only
test: vendor
	bin/phpunit

coverage: ## Run all tests with code coverage
coverage: vendor
	bin/phpunit --testsuite full --coverage-html var/report

.PHONY: test qa coverage

# rules based on files

vendor: composer.lock
	$(COMPOSER) install
	@touch --no-create vendor

.env.local:
	@echo "Please configure this project by editing .env.local"
	@exit 1

# generate help

.DEFAULT_GOAL := help
help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
.PHONY: help