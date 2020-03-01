### Why ?
---

### Requirements
---
- PHP 7.3
- Mysql 5.7.27
- NodeJs 12.16.1
- NPM 6.13.4
- Composer 1.9.3
- Yarn 1.22

### Usage
---

### Installation
---

```
make install
```

### Configuration
---

Surcharge de la configuration Docker :

```
cp docker-compose.override.yml.dist docker-compose.override.yml
```

Modification de la configuration d'environnement : 

```
cp .env.dist .env
```

### Project commands
---
* Install NPM and build assets (dev) : `make build-dev`
* Install NPM and build assets (prod) : `make build-prod`
* Yarn watch dev : `make yarn-watch`
* Yarn build (dev) : `make yarn-dev`
* Yarn build (prod) : `make yarn-prod`
* Clean .DS_Store : `make ds-store`

### Docker-compose commands
---
* Stop containers: `docker-compose stop`
* Run containers: `docker-compose up -d`
* Enter app container: `docker-compose exec apache bash`
* Show containers logs: `docker-compose logs`
* Show app streaming logs: `docker-compose logs -f --tail 500 apache`
* List all running containers: `docker ps`

### Troubleshooting
---

### FAQ
---

### Deployment
---

### Documentation
---

### Authors / Maintainers
---
- nono
