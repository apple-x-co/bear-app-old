<?php
declare(strict_types=1);

require dirname(__DIR__) . '/autoload.php';

// recover initial database
copy(dirname(__DIR__) . '/var/db/unit_test.dist.sqlite3', dirname(__DIR__) . '/var/db/unit_test.sqlite3');
