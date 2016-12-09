<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');
defined('VENDOR_DIR') or define('VENDOR_DIR', __DIR__ . '/../../..');

require_once(VENDOR_DIR . '/autoload.php');
require_once(VENDOR_DIR . '/yiisoft/yii2/Yii.php');

Yii::setAlias('@app', __DIR__);
Yii::setAlias('@vendor', VENDOR_DIR);