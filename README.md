<p align="center"><img src="https://symfony.com/images/logos/header-logo.svg"></p>

# **Outil de suivi des collaborateurs et clients**

# **Features**
- Personnalisation tableau de bord

# **Requirements**
- PHP >= 8.1
- Symfony >6.*
- MySQL

# **Credits**
[OSCC](https://github.com/hardnovity21/oscc) -  initié par l'equipe Unit manager et développé par Toky et Hardinah. Architecte Toky Ralala.

## License information
novity 2022

# **SETUP**
1 - Install all dependencies :

~~~
    composer install
~~~


2 - Create database using the next command:
~~~
    php bin/console doctrine:schema:create
~~~

3 - Create scheme using migration command:
~~~
    php bin/console doctrine:migrations:migrate
~~~

4 - You will need to populate your database using fixtures for login.

Run:

~~~
    php bin/console doctrine:fixtures:load
~~~

And use the next credentials to login.

- Username : "admin@novity.io"
- Password : "admin12345"

**APPRECIE**
