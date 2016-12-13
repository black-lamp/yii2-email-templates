<?php
namespace tests\unit\providers;

use bl\emailTemplates\providers\ConfigLanguageProvider;
use bl\emailTemplates\providers\LanguageProviderInterface;

/**
 * Test case for ConfigLanguageProvider
 *
 * @link https://github.com/black-lamp/yii2-email-templates
 * @license GNU Public License
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @copyright Copyright (c) Vladimir Kuprienko
 */
class ConfigLanguageProviderTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var \bl\emailTemplates\providers\ConfigLanguageProvider
     */
    protected $object;

    /**
     * @inheritdoc
     */
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

    public function testInstanceOf()
    {
        $this->assertInstanceOf(LanguageProviderInterface::class, $this->object, 'Class must be instance of LanguageProviderInterface');
    }

    public function testGetLanguages()
    {
        $languages = $this->object->getLanguages();
        $this->assertInternalType('array', $languages, 'Method should return array');
    }

    public function testGetDefaultLanguage()
    {
        $defaultLanguage = $this->object->getDefault();
        $this->assertInternalType('array', $defaultLanguage, 'Method should return array');
    }

    public function testGetLanguageById()
    {
        $language = $this->object->getNameByID(1);
        $this->assertInternalType('string', $language, 'Method should return string');
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