<?php
/**
 * @link https://github.com/black-lamp/yii2-email-templates
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace tests\unit\models\forms;

use tests\unit\DbTestCase;
use tests\unit\TestCase;
use tests\fixtures\TranslationFixture;

use bl\emailTemplates\models\forms\EditForm;
use bl\emailTemplates\models\forms\TemplateForm;

/**
 * Test case for EditForm model
 *
 * @property \UnitTester $tester
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class EditFormTest extends DbTestCase
{
    /**
     * @var \bl\emailTemplates\models\forms\EditForm
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

        $this->object = new EditForm([
            'templateId' => 1,
            'languageId' => 1
        ]);
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf(TemplateForm::class, $this->object, 'Form should extends TemplateForm');
    }

    public function testFormSave()
    {
        $this->object->subject = "Modified template subject";
        $this->object->body = "Modified template body";

        $this->assertTrue($this->object->save(), 'Model should save modified data');
        $this->assertFalse($this->object->hasErrors(), 'Model should not have error');
    }
}