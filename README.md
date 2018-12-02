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

		$ git clone https://github.com/alexandre-mace/oc_p8.git
		$ cd oc_p8

*   Install dependencies.
		
		$ composer install

## Configuration
*   Customize the .env file

#### doctrine
```
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"
```

*   Create database 

		$ php bin/console doctrine:database:create

*   Get tables 

		$ php bin/console doctrine:make:migration
		$ php bin/console doctrine:migrations:migrate

*   Get data

		$ php bin/console doctrine:fixtures:load

## Tests
*   run this command in console  and results will show up in console

		$ ./bin/phpunit 
