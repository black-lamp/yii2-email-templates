Email templates module for Yii2
===============================
Module for adding email templates across dashboard

Installation
------------
#### Run command
```
composer require black-lamp/yii2-email-templates
```
or add
```json
"black-lamp/yii2-email-templates": "1.*.*"
```
to the require section of your composer.json.
#### Applying migrations
```
yii migrate --migrationPath=@vendor/black-lamp/yii2-email-templates/migrations
```
#### Add module to application config
Backend module for create, edit and delete email templates
```php
'modules' => [
     // ...
     'email-templates' => [
         'class' => bl\emailTemplates\EmailTemplates::className()
     ],
]
```
