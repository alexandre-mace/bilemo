<?php

require_once __DIR__ . '/vendor/composer/autoload_real.php';

passthru('php bin/console doctrine:database:drop --if-exists --force');
passthru('php bin/console doctrine:database:create');
passthru('php bin/console doctrine:schema:update --force');
passthru('php bin/console hautelook:fixtures:load -n');
return ComposerAutoloaderInite6730942bb35a73d247ed11ff14725d2::getLoader();
