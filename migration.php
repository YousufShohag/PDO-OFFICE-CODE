<?php

require_once 'vendor/autoload.php';

$migration = new App\Database\Migration(new App\Storage\DB);

$migration->run();
