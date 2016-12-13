<?php
namespace tests\unit\models\forms;

use tests\fixtures\TemplateFixture;
use tests\fixtures\TranslationFixture;

use bl\emailTemplates\models\forms\EditForm;

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
    }

    public function testFormSave()
    {
        $model = new EditForm([
            'templateId' => 1,
            'languageId' => 1
        ]);

        $model->subject = "Modified template subject";
        $model->body = "Modified template body";

        $this->assertTrue($model->save(), 'Model should save modified data');
        $this->assertFalse($model->hasErrors(), 'Model should not have error');
    }
}