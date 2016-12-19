<?php
/**
 * @link https://github.com/black-lamp/yii2-email-templates
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace tests\unit\components;

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
class TemplateManagerTest extends TestCase
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
                'class' => TranslationFixture::className(),
                'dataFile' => codecept_data_dir('translation.php')
            ]
        ];
    }

    public function _before()
    {
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
}