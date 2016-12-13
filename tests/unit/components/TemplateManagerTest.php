<?php
namespace tests\unit\components;

use Yii;

use tests\fixtures\TemplateFixture;
use tests\fixtures\TranslationFixture;

use bl\emailTemplates\data\Template;

/**
 * Test case for TemplateManager component
 *
 * @link https://github.com/black-lamp/yii2-email-templates
 * @license GNU Public License
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @copyright Copyright (c) Vladimir Kuprienko
 */
class TemplateManagerTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var \bl\emailTemplates\components\TemplateManager
     */
    protected $object;

    public function _before()
    {
        $this->object = Yii::$app->get('templateManager');

        $this->tester->haveFixtures([
            'template' => [
                'class' => TemplateFixture::className(),
                'dataFile' => codecept_data_dir('template.php')
            ],
            'translation' => [
                'class' => TranslationFixture::className(),
                'dataFile' => codecept_data_dir('translation.php')
            ]
        ]);
    }

    public function testGetTemplate()
    {
        $template = $this->object->getTemplate('test', 1);

        $this->assertEquals(Template::class, get_class($template), 'Method should return Template class object');
    }

    public function testGetTemplates()
    {
        $templates = $this->object->getTemplates('test');

        $this->assertInternalType('array', $templates, 'Method should return array');
        $this->assertEquals(Template::class, get_class($templates[0]), 'Array item should be a Template object');
    }
}