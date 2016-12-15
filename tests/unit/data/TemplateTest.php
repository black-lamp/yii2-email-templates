<?php
/**
 * @license GNU Public License
 * @copyright Copyright (c) Vladimir Kuprienko
 * @link https://github.com/black-lamp/yii2-email-templates
 */

namespace tests\unit\data;

use tests\unit\TestCase;

use bl\emailTemplates\data\Template;
use bl\emailTemplates\models\entities\EmailTemplateTranslation;

/**
 * Test case for Template class
 *
 * @property \UnitTester $tester
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class TemplateTest extends TestCase
{
    /**
     * @var \bl\emailTemplates\data\Template
     */
    private $object;


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
        $this->assertInternalType('string', $subject, 'Method should return string');
    }

    public function testGetBody()
    {
        $body = $this->object->getBody();
        $this->assertInternalType('string', $body, 'Method should return string');
    }

    public function testParseSubject()
    {
        $param = 'parsed subject';
        $this->object->parseSubject(['{subject}' => $param]);

        $this->assertContains($param, $this->object->getSubject(), "Method should replace `{subject}` to `$param`");
    }

    public function testParseBody()
    {
        $param = 'parsed body';
        $this->object->parseBody(['{body}' => $param]);

        $this->assertContains($param, $this->object->getBody(), "Method should replace `{body}` to `$param`");
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

        $this->assertContains($subjectParam, $object->getSubject(), "Method should replace `{subject}` to `$subjectParam`");
        $this->assertContains($bodyParam, $object->getBody(), "Method should replace `{body}` to `$bodyParam`");
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

        $this->assertEquals($subject, $object->getSubject(), 'Method must get subject from AR model');
        $this->assertEquals($body, $object->getBody(), 'Method must get body from AR model');
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

        $this->assertInternalType('array', $objects, 'Method should return array');
        $this->assertInstanceOf(Template::class, $objects[0], 'Array item should be a Template object');

        $this->assertEquals($subject, $objects[0]->getSubject(), 'Objects in array should have subject from array of models');
        $this->assertEquals($body, $objects[0]->getBody(), 'Objects in array should have body from array of models');
    }
}