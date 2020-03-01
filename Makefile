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

restart: stop up

clean:
		rm -rf data vendor
		docker-compose rm --stop --force
		docker volume prune -f || true
		docker network prune -f || true

