<?php
/**
 * @license GNU Public License
 * @copyright Copyright (c) Vladimir Kuprienko
 * @link https://github.com/black-lamp/yii2-email-templates
 */

namespace tests\fixtures;

use yii\test\ActiveFixture;

/**
 * Fixture for EmailTemplateTranslation model
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class TranslationFixture extends ActiveFixture
{
    /**
     * @inheritdoc
     */
    public $modelClass = 'bl\emailTemplates\models\entities\EmailTemplateTranslation';
    /**
     * @inheritdoc
     */
    public $depends = [TemplateFixture::class];
    /**
     * @inheritdoc
     */
    public $dataFile = '@data/translation.php';
}