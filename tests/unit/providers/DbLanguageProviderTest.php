<?php
/**
 * @license GNU Public License
 * @copyright Copyright (c) Vladimir Kuprienko
 * @link https://github.com/black-lamp/yii2-email-templates
 */

namespace tests\unit\providers;

use Yii;

/**
 * Test case for DbLanguageProviderTest
 *
 * @property \bl\emailTemplates\providers\LanguageProviderInterface $object
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class DbLanguageProviderTest extends ProviderTestCase
{
    public function _before()
    {
        $this->object = Yii::$app->get('languageProvider');
    }
}