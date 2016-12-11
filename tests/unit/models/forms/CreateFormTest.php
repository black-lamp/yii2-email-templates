<?php
namespace bl\emailTemplates\tests\unit\models\forms;

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
     * @var \bl\emailTemplates\tests\UnitTester
     */
    protected $tester;

    public function testFormSave()
    {
        $model = new CreateForm([
            'key' => 'test',
            'languageId' => 1,
            'subject' => 'Subject test',
            'body' => 'Body test'
        ]);

        expect('Model should save form', $model->save())->true();
        expect('Model should not have errors', $model->hasErrors())->false();
    }
}