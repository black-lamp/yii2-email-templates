<?php
namespace bl\emailTemplates\tests\unit\providers;

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
     * @var \bl\emailTemplates\tests\UnitTester
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
        expect('Class must be instance of LanguageProviderInterface', $this->object)
            ->isInstanceOf(LanguageProviderInterface::class);
    }

    public function testGetLanguages()
    {
        $languages = $this->object->getLanguages();
        expect('Method should return array', $languages)->internalType('array');
    }

    public function testGetDefaultLanguage()
    {
        $defaultLanguage = $this->object->getDefault();
        expect('Method should return array', $defaultLanguage)->internalType('array');
    }

    public function testGetLanguageById()
    {
        $language = $this->object->getNameByID(1);
        expect('Method must return string', $language)->internalType('string');
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