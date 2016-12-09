<?php
return [
    'id' => 'email-templates-test',
    'class' => 'yii\console\Application',
    'basePath' => Yii::getAlias('@app'),

    'vendorPath' => Yii::getAlias('@vendor'),
    'runtimePath' => Yii::getAlias('@app/_output'),
    'bootstrap' => [],

    'components' => [
        'db' => require(__DIR__ . '/db.php')
    ],

    'params' => [],
];