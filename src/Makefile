# —— Inspiré par ———————————————————————————————————————————————————————————————
# http://fabien.potencier.org/symfony4-best-practices.html
# https://speakerdeck.com/mykiwi/outils-pour-ameliorer-la-vie-des-developpeurs-symfony?slide=47
# https://blog.theodo.fr/2018/05/why-you-need-a-makefile-on-your-project/

# Configuration ————————————————————————————————————————————————————————————————————————
SHELL         = bash
PROJECT       = mentorapp
EXEC_PHP      = php
REDIS         = redis-cli
GIT           = git
SYMFONY       = $(EXEC_PHP) bin/console
SYMFONY_BIN   = symfony
COMPOSER      = composer
DOCKER        = docker-compose
.DEFAULT_GOAL = help

## —— 🦍 Le Makefile de MentorApp 🦍 ———————————————————————————————————
help: ## Produit cet écran d'aide
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

wait: ## Dormir 5 secondes
	sleep 5

## —— Composer 🧙‍♂️ ————————————————————————————————————————————————————————————
install: composer.lock ## Installer les vendors en fonction du fichier composer.lock actuel
	$(COMPOSER) install --no-progress --no-suggest --prefer-dist --optimize-autoloader

update: composer.json ## Mettre à jour les vendors selon le fichier composer.json
	$(COMPOSER) update

## —— Symfony 🎵 ———————————————————————————————————————————————————————————————
sf: ## Liste de toutes les commandes Symfony
	$(SYMFONY)

cc: ## Effacez le cache.
	$(SYMFONY) c:c

warmup: ## Réchauffer le cache
	$(SYMFONY) cache:warmup

fix-perms: ## Correction des permissions de tous les fichiers var
	chmod -R 777 var/*

assets: purge ## Installer les actifs avec des liens symboliques dans le dossier public
	$(SYMFONY) assets:install public/ --symlink --relative

purge: ## Purger le cache et les journaux
	rm -rf var/cache/* var/logs/*

## —— Binaire Symfony 💻 ————————————————————————————————————————————————————————
bin-install: ## Télécharger et installer le binaire dans le projet (le fichier est ignoré)
	curl -sS https://get.symfony.com/cli/installer | bash
	mv ~/.symfony/bin/symfony .

cert-install: symfony ## Installer les certificats HTTPS locaux
	$(SYMFONY_BIN) server:ca:install

serve: ## Servez l'application avec le support HTTPS
	$(SYMFONY_BIN) serve --daemon --port=8000

unserve: ## Arrêtez le serveur web
	$(SYMFONY_BIN) server:stop

## —— Docker 🐳 ————————————————————————————————————————————————————————————————
up: docker-compose.yaml ## Démarrer le hub des dockers (MySQL, redis, adminer, head, Kibana)
	$(DOCKER) -f docker-compose.yaml up -d

docker-build: docker-compose.yaml ## UP+rebuild l'image de l'application
	$(DOCKER) -f docker-compose.yaml up -d --build

down: docker-compose.yaml ## Arrêtez le hub des dockers
	$(DOCKER) down --remove-orphans

dpsn: ## Liste des conteneurs Docker pour le projet
	$(DOCKER) images
	@echo "--------------------------------------------------------------------------------------------------------------"
	docker ps -a | grep "sb-"
	@echo "--------------------------------------------------------------------------------------------------------------"

bash: ## Se connecter au conteneur de l'application
	docker container exec -it sb-app bash

## —— Project 🐝 ———————————————————————————————————————————————————————————————
run: up wait reload serve ## Démarrer le docker, charger les équipements et démarrer le serveur web

reload: load-fixtures ## Recharger les fixtures

abort: down unserve ## Stop docker et le serveur binaire Symfony

cc-redis: ## Vider toutes les caches Redis
	$(REDIS) -p 6389 flushall

commands: ## Afficher toutes les commandes dans l'espace de noms du projet
	$(SYMFONY) list $(PROJECT)

load-fixtures: ## Construire la BD, contrôler la validité du schéma, charger les fixtures et vérifier le statut de la migration
	$(SYMFONY) doctrine:cache:clear-metadata
	$(SYMFONY) doctrine:database:create --if-not-exists
	$(SYMFONY) doctrine:schema:drop --force
	$(SYMFONY) doctrine:schema:create
	$(SYMFONY) doctrine:schema:validate
	$(SYMFONY) doctrine:fixtures:load -n

init-snippet: ## Initialiser un nouvel extrait
	$(SYMFONY) $(PROJECT):init-snippet

## —— Tests ✅ —————————————————————————————————————————————————————————————————
test: phpunit.xml ## Lancer les principaux tests fonctionnels et unitaires
	./vendor/bin/phpunit --testsuite=main --stop-on-failure

test-external: phpunit.xml ## Lancer des tests impliquant des ressources externes (API, services...)
	./vendor/bin/phpunit --testsuite=external --stop-on-failure

test-all: phpunit.xml ## Lancer tous les tests
	./vendor/bin/phpunit --stop-on-failure

## —— Normes de codage ✨ ——————————————————————————————————————————————————————
cs: codesniffer stan ## lint - Lancer la vérification du style et l'analyse statique

codesniffer: ## Exécution de php_codesniffer uniquement
	./vendor/squizlabs/php_codesniffer/bin/phpcs --standard=phpcs.xml -n -p src/

stan: ## Exécuter PHPStan uniquement
	./vendor/bin/phpstan analyse -l max --memory-limit 1G -c phpstan.neon src/

psalm: ## Exécuter psalm uniquement
	./vendor/bin/psalm --show-info=false

init-psalm: ## Initialiser un nouveau fichier de configuration de psalm pour un niveau donné, il doit être décrémenté pour avoir des règles plus strictes
	rm ./psalm.xml
	./vendor/bin/psalm --init src/ 3

cs-fix: ## Lancez php-cs-fixer et corrigez le code.
	./vendor/bin/php-cs-fixer fix src/

## —— Déploiement & Prod 🚀 —————————————————————————————————————————————————————————
deploy: ##  Déploiement complet sans interruption avec EasyDeploy
	$(SYMFONY) deploy -v

env-check: ## Vérifiez les principales variables ENV du projet
	printenv | grep -i app_

le-renew: ## Renouvellement Let's Encrypt des certificats HTTPS
	certbot --apache -d mentor.app -d www.mentor.app

## —— Yarn 🐱 / JavaScript —————————————————————————————————————————————————————
dev: ## Reconstruire des assets pour le développement de l'environnement
	yarn install
	yarn run encore dev

watch: ## Surveiller les fichiers et créer des ressources lorsque cela est nécessaire pour le développement de l'environnement
	yarn run encore dev --watch

build: ## Construire des assets pour la production
	yarn run encore production

lint: ## Analyse des fichiers Js
	npx eslint assets/js --fix
