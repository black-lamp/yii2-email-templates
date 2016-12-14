Email templates module for Yii2
===============================
Module for adding templates for email letters across dashboard

[![Latest Stable Version](https://poser.pugx.org/black-lamp/yii2-email-templates/v/stable)](https://packagist.org/packages/black-lamp/yii2-email-templates)
[![Latest Unstable Version](https://poser.pugx.org/black-lamp/yii2-email-templates/v/unstable)](https://packagist.org/packages/black-lamp/yii2-email-templates)
[![License](https://poser.pugx.org/black-lamp/yii2-email-templates/license)](https://packagist.org/packages/black-lamp/yii2-email-templates)

Installation
------------
#### Run command
```
composer require black-lamp/yii2-email-templates
```
or add
```json
"black-lamp/yii2-email-templates": "2.*.*"
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
         'class' => bl\emailTemplates\EmailTemplates::className(),
         'languageProvider' => [
            'class' => bl\emailTemplates\providers\DbLanguageProvider::className(),
            'tableName' => 'language',
            'idField' => 'id',
            'nameField' => 'name'
         ]
     ],
]
```
`languageProvider` it's a class that implements [LanguageProviderInterface](https://github.com/black-lamp/yii2-email-templates/blob/master/src/providers/LanguageProviderInterface.php).
You can use language providers from this extension or create yours.
This extension has two language providers.

##### Database language provider configuration properties
| Option | Description | Type | Default |
|----|----|----|----|
|tableName|Name of table in database with languages|string|language|
|idField|Name of field in language table with primary key|string|id|
|idName|Name of field in language table with language name|string|name|

##### Config language provider configuration properties
| Option | Description | Type | Default |
|----|----|----|----|
|languages|Array with languages. Example `[1 => 'English', 2 => 'Russian']`|array|-|
|defaultLanguage|Array with default language. Array must contains one value. Example `[1 => 'English']`|array|-|

#### Add component to application config
Component for getting the templates from database
```php
'components' => [
    // ...
    'emailTemplates' => [
        'class' => bl\emailTemplates\components\TemplateManager::className()
    ],
]
```

Using
-----
1) Create the template with markers across dashboard

Email subject
> New message from {sitename}

Email body
> Hello, {username}!
>
> Text...
>
> Go to the link - {link}

2) Get template by key with component help
```php
$template = Yii::$app->templateManager->getTemplate('test', 1);
```
This method return a [Template](https://github.com/black-lamp/yii2-email-templates/blob/master/src/data/Template.php) object.

3) You should to parse the markers in email subject and email body
```php
    $template->parseSubject([
        '{sitename}' => $sitename
    ]);
    
    $template->parseBody([
        '{username}' => Yii::$app->user->identity->firstname,
        '{link}' => Url::toRoute(['/confirm', 'token' => $token], true)
    ]);
```

4) Now you can using this template
```php
Yii::$app->mailer->compose()
    // ...
    ->setSubject($template->subject)
    ->setHtmlBody($template->body)
    // ...
```
