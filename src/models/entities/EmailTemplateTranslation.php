<?php
/**
 * @link https://github.com/black-lamp/yii2-email-templates
 * @copyright Copyright (c) 2016 Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace bl\emailTemplates\models\entities;

use yii\db\ActiveRecord;

use bl\emailTemplates\EmailTemplates;

/**
 * This is the model class for table "email_template_translation".
 *
 * @property integer $id
 * @property integer $template_id
 * @property integer $language_id
 * @property string $subject
 * @property string $body
 *
 * @property EmailTemplate $template
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class EmailTemplateTranslation extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'email_template_translation';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => EmailTemplates::t('model', 'ID'),
            'template_id' => EmailTemplates::t('model', 'Template ID'),
            'language_id' => EmailTemplates::t('model', 'Language ID'),
            'subject'     => EmailTemplates::t('model', 'Subject'),
            'body'        => EmailTemplates::t('model', 'Body'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemplate()
    {
        return $this->hasOne(EmailTemplate::className(), ['id' => 'template_id']);
    }
}
