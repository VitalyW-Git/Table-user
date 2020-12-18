<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

use yii\web\Application;

// (new yii\web\Application($config))->run();

$app = new Application($config);
Application::setTimeZone('Europe/Moscow');
$app->formatter->datetimeFormat = 'php:Y-m-d H:i:s';
$app->run();
