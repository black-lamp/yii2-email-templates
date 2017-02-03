<?php
/**
 * @link https://github.com/black-lamp/yii2-email-templates
 * @copyright Copyright (c) 2016 Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace tests\unit\components;

use tests\unit\DbTestCase;
use Yii;

use tests\unit\TestCase;
use tests\fixtures\TranslationFixture;

use bl\emailTemplates\data\Template;

/**
 * Test case for TemplateManager component
 *
 * @property \UnitTester $tester
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class TemplateManagerTest extends DbTestCase
{
    /**
     * @var \bl\emailTemplates\components\TemplateManager
     */
    private $object;


    /**
     * @inheritdoc
     */
    public function fixtures()
    {
        return [
            'translation' => [
                'class' => TranslationFixture::className()
            ]
        ];
    }

    public function _before()
    {
        parent::_before();

        $this->object = Yii::$app->get('templateManager');
    }

    public function testGetTemplate()
    {
        $template = $this->object->getTemplate('test', 1);

        $this->assertInstanceOf(Template::class, $template, 'Method should return Template class object');
    }

    public function testGetTemplates()
    {
        $templates = $this->object->getTemplates('test');

        $this->assertInternalType('array', $templates, 'Method should return array');
        $this->assertInstanceOf(Template::class, $templates[0], 'Array item should be a Template object');
    }

    public function testGetTemplateNull()
    {
        $template = $this->object->getTemplate('Nonexistent key', 1);

        $this->assertEquals(null, $template, 'Method should returns a null value');
    }

    public function testGetTemplatesNull()
    {
        $templates = $this->object->getTemplates('Nonexistent key', 1);

        $this->assertEquals(null, $templates, 'Method should returns a null value');
    }

    public function testGetByLangOrFirst()
    {
        $byKey = $this->object->getByLangOrFirst('test', 2);
        $this->assertInstanceOf(Template::class, $byKey, 'Method should return Template class object');
        $this->assertEquals('Тест темы', $byKey->getSubject(), 'Method should returns translation by lang');
        $this->assertEquals('Тест тела', $byKey->getBody(), 'Method should returns translation by lang');

        $first = $this->object->getByLangOrFirst('test', 7);
        $this->assertInstanceOf(Template::class, $first, 'Method should return Template class object');
        $this->assertEquals('Test subject', $first->getSubject(), 'Method should return a first translation');
        $this->assertEquals('Test body', $first->getBody(), 'Method should return a first translation');

        $null = $this->object->getByLangOrFirst('Nonexistent key', 1);
        $this->assertInternalType('null', $null, 'Method should returns null value');
    }
}