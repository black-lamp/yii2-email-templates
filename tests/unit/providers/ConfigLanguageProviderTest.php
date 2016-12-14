<?php
namespace tests\unit\providers;

use bl\emailTemplates\providers\ConfigLanguageProvider;

/**
 * Test case for ConfigLanguageProvider
 *
 * @property \bl\emailTemplates\providers\LanguageProviderInterface $object
 *
 * @link https://github.com/black-lamp/yii2-email-templates
 * @license GNU Public License
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @copyright Copyright (c) Vladimir Kuprienko
 */
class ConfigLanguageProviderTest extends ProviderTestCase
{
    public function _before()
    {
        $this->object = new ConfigLanguageProvider([
            'languages' => [
                1 => 'English',
                2 => 'Russian',
                3 => 'Ukrainian'
            ],
            'defaultLanguage' => [1 => 'English']
        ]);
    }

    public function testLanguageOptionException()
    {
        $this->setExpectedException('yii\base\InvalidConfigException');

        new ConfigLanguageProvider([
            'defaultLanguage' => [1 => 'English']
        ]);
    }

    public function testLanguageOptionException2()
    {
        $this->setExpectedException('yii\base\InvalidConfigException');

        new ConfigLanguageProvider([
            'languages' => 'Wrong configuration',
            'defaultLanguage' => [1 => 'English']
        ]);
    }

    public function testDefaultLanguageException()
    {
        $this->setExpectedException('yii\base\InvalidConfigException');

        new ConfigLanguageProvider([
            'languages' => [1 => 'English']
        ]);
    }

    public function testDefaultLanguageException2()
    {
        $this->setExpectedException('yii\base\InvalidConfigException');

        new ConfigLanguageProvider([
            'languages' => [1 => 'English'],
            'defaultLanguage' => 'Wrong configuration'
        ]);
    }
}