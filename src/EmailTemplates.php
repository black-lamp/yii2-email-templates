<?php
namespace bl\emailTemplates;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\Module;
use yii\di\Container;

/**
 * EmailTemplates module definition class
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @link https://github.com/black-lamp/yii2-email-templates
 * @license https://opensource.org/licenses/GPL-3.0 GNU Public License
 */
class EmailTemplates extends Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'bl\emailTemplates\controllers';

    /**
     * @var array field of language entity
     * Example
     * ```php
     * 'languageProvider' => [
     *      'class' => bl\emailTemplates\providers\DbLanguageProvider::className(),
     *      'arModel' => bl\multilang\entities\Language::className(),
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

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('email.templates' . $category, $message, $params, $language);
    }
}
