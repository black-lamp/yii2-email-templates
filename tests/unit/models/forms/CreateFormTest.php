<?php
namespace tests\unit\models\forms;

use bl\emailTemplates\models\forms\CreateForm;

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

    public function testFormSave()
    {
        $model = new CreateForm([
            'key' => 'test-template',
            'languageId' => 1,
            'subject' => 'Subject test',
            'body' => 'Body test'
        ]);

        $this->assertTrue($model->save(), 'Model should save form');
        $this->assertFalse($model->hasErrors(), 'Model should not have errors');
    }
}