<?php
namespace tests\unit\providers;

use bl\emailTemplates\providers\LanguageProviderInterface;

/**
 * Base test case for providers
 *
 * @link https://github.com/black-lamp/yii2-email-templates
 * @license GNU Public License
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @copyright Copyright (c) Vladimir Kuprienko
 */
class ProviderTestCase extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var \bl\emailTemplates\providers\ConfigLanguageProvider
     */
    protected $object;

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
}