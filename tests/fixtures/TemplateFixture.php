<?php
/**
 * @license GNU Public License
 * @copyright Copyright (c) Vladimir Kuprienko
 * @link https://github.com/black-lamp/yii2-email-templates
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