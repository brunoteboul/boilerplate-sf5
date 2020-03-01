install:
		docker-compose up -d --build
		cp .env.dist .env
		sh bin/install.sh

ps:
	docker-compose ps

up:
	docker-compose up -d

stop:
	docker-compose stop

deploy:
	sh bin/deploy.sh

restart:
	stop up

clean:
		rm -rf data vendor
		docker-compose rm --stop --force
		docker volume prune -f || true
		docker network prune -f || true

ds-store:
	find . -name '.DS_Store' -type f -delete

npm-dev:
	docker-compose exec apache sh -c 'npm install'

npm-prod:
	docker-compose exec apache sh -c 'npm install --only=prod'

yarn-dev:
	docker-compose exec apache sh -c 'yarn encore dev'

yarn-watch:
	docker-compose exec apache sh -c 'yarn encore dev --watch'

yarn-prod:
	docker-compose exec apache sh -c 'yarn encore production --progress'

build-dev:
	docker-compose exec apache sh -c 'npm install'
	docker-compose exec apache sh -c 'yarn encore dev'

build-prod:
	docker-compose exec apache sh -c 'npm install --only=prod'
	docker-compose exec apache sh -c 'yarn encore production --progress'
