<?php
namespace bl\emailTemplates\entities;

use yii\db\ActiveRecord;

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
 * @link https://github.com/black-lamp/yii2-email-templates
 * @license https://opensource.org/licenses/GPL-3.0 GNU Public License
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
    public function rules()
    {
        return [
            [['template_id', 'language_id'], 'required'],
            [['template_id', 'language_id'], 'integer'],
            [['body'], 'string'],
            [['subject'], 'string', 'max' => 255],
            [
                ['template_id'], 'exist',
                'skipOnError' => true,
                'targetClass' => EmailTemplate::className(),
                'targetAttribute' => ['template_id' => 'id']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'template_id' => 'Template ID',
            'language_id' => 'Language ID',
            'subject' => 'Subject',
            'body' => 'Body',
        ];
    }

    public function getTemplate()
    {
        return $this->hasOne(EmailTemplate::className(), ['id' => 'template_id']);
    }
}
