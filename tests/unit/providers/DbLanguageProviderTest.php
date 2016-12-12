<?php
namespace bl\emailTemplates\tests\unit\providers;

use Yii;

use bl\emailTemplates\providers\LanguageProviderInterface;

/**
 * Test case for DbLanguageProviderTest
 *
 * @link https://github.com/black-lamp/yii2-email-templates
 * @license GNU Public License
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @copyright Copyright (c) Vladimir Kuprienko
 */
class DbLanguageProviderTest extends \Codeception\Test\Unit
{
    /**
     * @var \bl\emailTemplates\tests\UnitTester
     */
    protected $tester;

    /**
     * @var \bl\emailTemplates\providers\ConfigLanguageProvider
     */
    protected $object;

    public function _before()
    {
        $this->object = Yii::$app->get('languageProvider');
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
}