<?php
ini_set('display_errors', 0);

define('APP_DIR', __DIR__.'/app');
define('ROOT_DIR', __DIR__);

require_once 'app/bootstrap.php';

$app = new Bootstrap();
$app->run();