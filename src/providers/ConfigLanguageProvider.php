<?php
/**
 * @link https://github.com/black-lamp/yii2-email-templates
 * @copyright Copyright (c) 2016 Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace bl\emailTemplates\providers;

use yii\base\InvalidConfigException;
use yii\base\Object;

/**
 * Config language provider
 *
 * Example:
 * ```php
 * 'languageProvider' => [
 *      'class' => bl\emailTemplates\providers\ConfigLanguageProvider::className(),
 *      'languages' => [
 *          1 => 'English',
 *          2 => 'Russian'
 *          // ...
 *      ],
 *      'defaultLanguage' => [1 => 'English']
 * ]
 * ```
 *
 * @property array $languages
 * @property array $defaultLanguage

 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class ConfigLanguageProvider extends Object implements LanguageProviderInterface
{
    /**
     * @var array of languages
     */
    public $languages;

    /**
     * @var array with default language
     */
    public $defaultLanguage;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $className = $this->className();

        if(empty($this->languages)) {
            throw new InvalidConfigException("Option `language` in $className cannot be blank");
        }
        elseif(!is_array($this->languages)) {
            throw new InvalidConfigException("Option `language` in $className must be array");
        }

        if(empty($this->defaultLanguage)) {
            throw new InvalidConfigException("Option `defaultLanguage` in $className cannot be blank");
        }
        elseif(!is_array($this->defaultLanguage)) {
            throw new InvalidConfigException("Option `defaultLanguage` in $className must be array");
        }
    }

    /**
     * @inheritdoc
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * @inheritdoc
     */
    public function getDefault()
    {
        return $this->defaultLanguage;
    }

    /**
     * @inheritdoc
     */
    public function getNameByID($id)
    {
        return $this->languages[$id];
    }
}