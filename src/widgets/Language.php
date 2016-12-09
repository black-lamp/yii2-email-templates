<?php
namespace bl\emailTemplates\widgets;

use Yii;
use yii\base\Widget;

use bl\emailTemplates\providers\LanguageProviderInterface;

/**
 * Widget for rendering list of languages
 *
 * @property array $currentLanguage
 *
 * @link https://github.com/black-lamp/yii2-email-templates
 * @license GNU Public License
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @copyright Copyright (c) Vladimir Kuprienko
 */
class Language extends Widget
{
    /**
     * @var array
     */
    public $currentLanguage;

    /**
     * @inheritdoc
     */
    public function run()
    {
        /** @var LanguageProviderInterface $provider */
        $provider = Yii::$container->get(LanguageProviderInterface::class);

        return $this->render('languages', [
            'languages' => $provider->getLanguages(),
            'currentLanguage' => $this->currentLanguage
        ]);
    }
}
