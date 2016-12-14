<?php
return [
    'db' => require(__DIR__ . '/db.php'),

    'languageProvider' => [
        'class' => \bl\emailTemplates\providers\DbLanguageProvider::className(),
        'tableName' => 'language',
        'idField' => 'id',
        'nameField' => 'name'
    ],
    'templateManager' => [
        'class' => \bl\emailTemplates\components\TemplateManager::className()
    ],
];