<p align="center"><img src="https://symfony.com/images/logos/header-logo.svg"></p>

# **Outil de suivi des collaborateurs et clients**

# **Features**
- Creation dasboard

# **Requirements**
- docker
- docker-compose
- NodeJs

# **SETUP**
#### Build the docker containers :

Ensure that docker and docker-compose are installed and the docker service is running

Then inside the docker folder, run

~~~
    docker-compose -f docker-compose.yml -f pma.yml build
~~~

#### Run the docker containers
Then simply execute

~~~
    docker-compose -f docker-compose.yml -f pma.yml up
~~~


~~~
    docker exec -it test-php composer install
~~~


#### Create scheme using migration command:
~~~
    docker exec -it test-php php bin/console doctrine:migrations:migrate
~~~

#### You will need to populate your database using fixtures for login.

Run:

~~~
    docker exec -it test-php php bin/console doctrine:fixtures:load
~~~

#### Install webpack
~~~
    npm install
~~~

And use the next credentials to login.

- Username : "admin@novity.io"
- Password : "admin123456"


##Test

web : http://127.0.0.1:8011/
phpmyadmin : http://127.0.0.1:4011/

**APPRECIE**

# **Credits**
[OSCC](https://github.com/hardnovity21/oscc) -  Project by Novity.

## License information
novity 2022
