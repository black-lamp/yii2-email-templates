<?php
namespace tests\unit\models\forms;

use tests\fixtures\TemplateFixture;
use tests\fixtures\TranslationFixture;

use bl\emailTemplates\models\forms\EditForm;
use bl\emailTemplates\models\forms\TemplateForm;

/**
 * Test case for EditForm model
 *
 * @link https://github.com/black-lamp/yii2-email-templates
 * @license GNU Public License
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @copyright Copyright (c) Vladimir Kuprienko
 */
class EditFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var \bl\emailTemplates\models\forms\EditForm
     */
    protected $object;

    /**
     * @inheritdoc
     */
    public function _before()
    {
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