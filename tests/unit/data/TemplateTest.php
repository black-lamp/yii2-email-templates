<?php
namespace bl\emailTemplates\tests\unit\data;

use bl\emailTemplates\data\Template;
use bl\emailTemplates\models\entities\EmailTemplateTranslation;

/**
 * Test case for Template class
 *
 * @link https://github.com/black-lamp/yii2-email-templates
 * @license GNU Public License
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @copyright Copyright (c) Vladimir Kuprienko
 */
class TemplateTest extends \Codeception\Test\Unit
{
    /**
     * @var \bl\emailTemplates\tests\UnitTester
     */
    protected $tester;

    /**
     * @var \bl\emailTemplates\data\Template
     */
    protected $object;

    public function _before()
    {
        $this->object = new Template(
            'Test {subject}',
            'Test {body}'
        );
    }

    public function testGetSubject()
    {
        $subject = $this->object->getSubject();
        expect('Method should return string', $subject)->internalType('string');
    }

    public function testGetBody()
    {
        $body = $this->object->getBody();
        expect('Method should return string', $body)->internalType('string');
    }

    public function testParseSubject()
    {
        $param = 'parsed subject';
        $this->object->parseSubject(['{subject}' => $param]);

        expect("Method should replace `{subject}` to `$param`", $this->object->getSubject())
            ->contains($param);
    }

    public function testParseBody()
    {
        $param = 'parsed body';
        $this->object->parseBody(['{body}' => $param]);

        expect("Method should replace `{body}` to `$param`", $this->object->getBody())
            ->contains($param);
    }

    public function testParse()
    {
        $object = new Template(
            'Test {subject}',
            'Test {body}'
        );

        $subjectParam = 'parsed subject';
        $bodyParam = 'parsed subject';
        $object->parse(['{subject}' => $subjectParam], ['{body}' => $bodyParam]);

        expect("Method should replace `{subject}` to `$subjectParam`", $object->getSubject())
            ->contains($subjectParam);
        expect("Method should replace `{body}` to `$bodyParam`", $object->getBody())
            ->contains($bodyParam);
    }

    public function testBuildTemplate()
    {
        $subject = 'Test subject';
        $body = 'Test body';

        $model = new EmailTemplateTranslation([
            'template_id' => 1,
            'language_id' => 1,
            'subject' => $subject,
            'body' => $body
        ]);

        $object = Template::buildTemplate($model);

        expect('Method must get subject from AR model', $object->getSubject())
            ->equals($subject);
        expect('Method must get body from AR model', $object->getBody())
            ->equals($body);
    }

    public function testBuildTemplates()
    {
        $subject = 'Test subject';
        $body = 'Test body';

        $models = [
            new EmailTemplateTranslation([
                'id' => 1,
                'template_id' => 1,
                'language_id' => 1,
                'subject' => $subject,
                'body' => $body
            ]),
            new EmailTemplateTranslation([
                'id' => 2,
                'template_id' => 2,
                'language_id' => 1,
                'subject' => $subject,
                'body' => $body
            ])
        ];

        /** @var Template[] $objects */
        $objects = Template::buildTemplates($models);

        expect('Method should return array', $objects)->internalType('array');
        expect('Array item should be a Template object', $objects[0])->internalType('object');

        expect('Objects in array should have subject from array of models', $objects[0]->getSubject())
            ->equals($subject);
        expect('Objects in array should have body from array of models', $objects[0]->getBody())
            ->equals($body);
    }
}