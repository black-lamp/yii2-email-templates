<?php
/**
 * @link https://github.com/black-lamp/yii2-email-templates
 * @copyright Copyright (c) 2016 Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace bl\emailTemplates;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\Module;

/**
 * EmailTemplates module definition class
 *
 * @property array $languageProvider
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class EmailTemplates extends Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'bl\emailTemplates\controllers';
    /**
     * @var array of configuration for language provider
     * Example
     * ```php
     * 'languageProvider' => [
     *      'class' => bl\emailTemplates\providers\DbLanguageProvider::className(),
     *      'tableName' => 'language',
     *      'idField' => 'id',
     *      'nameField' => 'name'
     * ]
     * ```
     */
    public $languageProvider;


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->registerDependencies();
    }

    /**
     * Add language provider to DI container
     */
    public function registerDependencies()
    {
        if(empty($this->languageProvider)) {
            throw new InvalidConfigException("Invalid configuration of '$this->id' module");
        }

        Yii::$container->set('bl\emailTemplates\providers\LanguageProviderInterface', $this->languageProvider);
    }

    /**
     * Wrapper for default method `Yii::t()`
     *
     * @param string $category
     * @param string $message
     * @param array $params
     * @param null $language
     * @return string returns result of `Yii::t()` method
     */
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('email.templates.' . $category, $message, $params, $language);
    }
}
