build:
	@echo "\033[92;1mDocker build...\033[0m"
	@docker-compose -f "./docker-compose.yml" build

	@echo "\033[92;1mDocker up...\033[0m"
	@docker-compose -f "./docker-compose.yml" up -d

	@echo "\033[92;1mComposer install...\033[0m"
	@docker-compose -f "./docker-compose.yml" run --rm php composer install

	@echo "\033[92;1mDatabase create...\033[0m"
	@docker-compose -f "./docker-compose.yml" run --rm php bin/console d:d:c

	@echo "\033[92;1mMake migration...\033[0m"
	@docker-compose -f "./docker-compose.yml" run --rm php bin/console d:m:m --no-interaction

	@echo "\033[92;1mFixtures load...\033[0m"
	@docker-compose -f "./docker-compose.yml" run --rm php bin/console d:f:l --no-interaction

	@echo "\033[92;1mDocker stop...\033[0m"
	@docker-compose -f "./docker-compose.yml" stop
.PHONY: build

up:
	@echo "\033[92;1mDocker up...\033[0m"
	@docker-compose -f "./docker-compose.yml" up -d
	@echo "Go to: http://localhost:81"
.PHONY: up

stop:
	@echo "\033[92;1mDocker stop...\033[0m"
	@docker-compose -f "./docker-compose.yml" stop
.PHONY: stop

remove:
	@echo "\033[92;1mDocker down...\033[0m"
	@docker-compose -f "./docker-compose.yml" down
.PHONY: remove
