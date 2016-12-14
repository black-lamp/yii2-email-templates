<?php
namespace tests\unit\providers;

use Yii;

use bl\emailTemplates\providers\LanguageProviderInterface;

/**
 * Test case for DbLanguageProviderTest
 *
 * @property \bl\emailTemplates\providers\LanguageProviderInterface $object
 *
 * @link https://github.com/black-lamp/yii2-email-templates
 * @license GNU Public License
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @copyright Copyright (c) Vladimir Kuprienko
 */
class DbLanguageProviderTest extends ProviderTestCase
{
    public function _before()
    {
        $this->object = Yii::$app->get('languageProvider');
    }
}