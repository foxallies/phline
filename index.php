<?php

use \FOXALLIES\Framework;

require __DIR__ . '/vendor/autoload.php';

$splObjectStorage = new SplObjectStorage();

(new Framework())->start();
