# Mojito

## Setup

Clone this repository. 

In the cloned repository, run 

```sh
docker-compose up
```

Wait until all containers are started up.

Keep the terminal open, and open a new terminal where you can interact with the running containers. Make sure you change to the cloned repository again.

Install all packages

```sh
./composer-compose install
```

Import the database:

```sh
docker-compose exec -T mysql sh -c "mysql --user=mojito --password=mojito mojito" < tools/baseline.sql
```

Import the configuration

```sh
./drush-compose cr
./drush-compose cim -y
./drush-compose cr
```

## Usage

Navigate to http://localhost:5080/ and admire your running Drupal installation. 

If you want to login, you can navigatie to http://localhost:5080/user. In the baseline SQL there is a user with username `admin` and password `welcome1234`.