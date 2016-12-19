<?php
/**
 * @link https://github.com/black-lamp/yii2-email-templates
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace tests\unit\models\forms;

use tests\unit\TestCase;

use bl\emailTemplates\models\forms\CreateForm;
use bl\emailTemplates\models\forms\TemplateForm;

/**
 * Test case for CreateForm model
 *
 * @property \UnitTester $tester
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class CreateFormTest extends TestCase
{
    /**
     * @var \bl\emailTemplates\models\forms\CreateForm
     */
    private $object;


    public function _before()
    {
        $this->object = new CreateForm([
            'key' => 'test-template',
            'languageId' => 1,
            'subject' => 'Subject test',
            'body' => 'Body test'
        ]);
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf(TemplateForm::class, $this->object, 'Form should extends TemplateForm');
    }

    public function testFormSave()
    {
        $this->assertTrue($this->object->save(), 'Model should save form');
        $this->assertFalse($this->object->hasErrors(), 'Model should not have errors');
    }
}