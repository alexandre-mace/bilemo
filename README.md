# BileMo

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/7fdb69ea6db94b97867beb640e660c57)](https://app.codacy.com/app/codacy_alexandre-mace/oc_p7?utm_source=github.com&utm_medium=referral&utm_content=alexandre-mace/oc_p7&utm_campaign=Badge_Grade_Dashboard)
[![Codacy Badge](https://api.codacy.com/project/badge/Coverage/606914a87f44449daddd7bb85c79cc2f)](https://www.codacy.com/app/codacy_alexandre-mace/oc_p7?utm_source=github.com&utm_medium=referral&utm_content=alexandre-mace/oc_p7&utm_campaign=Badge_Coverage)

Web Service with API REST, 7th project from OpenClassroom's class

## Requirements 
*   [MySQL](https://www.mysql.com/fr/)
*   [PHP](http://php.net/manual/fr/intro-whatis.php)
*   [Apache](https://www.apache.org/)

## Installation 
*   Clone the repository and open it.
``` bash
$ git clone https://github.com/alexandre-mace/oc_p8.git
$ cd oc_p8
```

*   Install dependencies.
``` bash
$ composer install
```

## Configuration

#### doctrine
*   Customize the .env file
```
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"
```

*   Create database 
``` bash
$ php bin/console doctrine:database:create
```

*   Get tables 
``` bash
$ php bin/console doctrine:make:migration
$ php bin/console doctrine:migrations:migrate
```
*   Get data
``` bash
$ php bin/console hautelook:fixtures:load
```

### LexikJWTAuthenticationBundle
* Generate the SSH keys
``` bash
$ mkdir config/jwt
$ openssl genrsa -out config/jwt/private.pem -aes256 4096
$ openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
```
* Create a phpunit.xml file at the project root and copy the phpunit.xml.dist information in it
* Customize it with the password used to generate the keys
```
<env name="PASSPHRASE" value="[your-passphrase]"/>
```
## Tests
* Configure the phpunit_bootstrap.php file at the project root by modifying his last line with the last line of vendor/autoload.php
*   run this command in console  and results will show up in console
``` bash
$ ./bin/phpunit 
```

