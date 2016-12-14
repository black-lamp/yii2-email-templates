<?php
namespace tests\unit\models\forms;

use bl\emailTemplates\models\forms\CreateForm;
use bl\emailTemplates\models\forms\TemplateForm;

/**
 * Test case for CreateForm model
 *
 * @link https://github.com/black-lamp/yii2-email-templates
 * @license GNU Public License
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @copyright Copyright (c) Vladimir Kuprienko
 */
class CreateFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var \bl\emailTemplates\models\forms\CreateForm
     */
    protected $object;

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