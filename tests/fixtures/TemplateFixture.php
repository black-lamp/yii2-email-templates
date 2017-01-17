<?php
/**
 * @link https://github.com/black-lamp/yii2-email-templates
 * @copyright Copyright (c) 2016 Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace tests\fixtures;

use yii\test\ActiveFixture;

/**
 * Fixture for EmailTemplate model
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class TemplateFixture extends ActiveFixture
{
    /**
     * @inheritdoc
     */
    public $modelClass = 'bl\emailTemplates\models\entities\EmailTemplate';
    /**
     * @inheritdoc
     */
    public $dataFile = '@data/template.php';
}