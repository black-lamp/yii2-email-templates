<?php
/**
 * @license GNU Public License
 * @copyright Copyright (c) Vladimir Kuprienko
 * @link https://github.com/black-lamp/yii2-email-templates
 */

namespace tests\unit\providers;

use tests\unit\TestCase;

use bl\emailTemplates\providers\LanguageProviderInterface;

/**
 * Base test case for providers
 *
 * @property \UnitTester $tester
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class ProviderTestCase extends TestCase
{
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