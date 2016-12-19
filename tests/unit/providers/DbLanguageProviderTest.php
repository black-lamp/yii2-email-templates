<?php
/**
 * @link https://github.com/black-lamp/yii2-email-templates
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
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