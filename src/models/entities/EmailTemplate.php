<?php
namespace bl\emailTemplates\models\entities;

use yii\db\ActiveRecord;

use bl\emailTemplates\EmailTemplates;

/**
 * This is the model class for table "email_template".
 *
 * @property integer $id
 * @property string $key
 *
 * @property EmailTemplateTranslation[] $translations
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @link https://github.com/black-lamp/yii2-email-templates
 * @license https://opensource.org/licenses/GPL-3.0 GNU Public License
 */
class EmailTemplate extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'email_template';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => EmailTemplates::t('model', 'ID'),
            'key' => EmailTemplates::t('model', 'Key'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(EmailTemplateTranslation::className(), ['template_id' => 'id']);
    }
}
