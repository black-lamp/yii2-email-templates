<?php
/**
 * @link https://github.com/black-lamp/yii2-email-templates
 * @copyright Copyright (c) 2016 Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace bl\emailTemplates\models\entities;

use bl\multilang\behaviors\TranslationBehavior;
use yii\db\ActiveRecord;

use bl\emailTemplates\EmailTemplates;

/**
 * This is the model class for table "email_template".
 *
 * @property integer $id
 * @property string $key
 *
 * @property EmailTemplateTranslation[] $translations
 * @property EmailTemplateTranslation $translation
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
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

    public function behaviors()
    {
        return [
            'translation' => [
                'class' => TranslationBehavior::className(),
                'translationClass' => EmailTemplateTranslation::className(),
                'relationColumn' => 'template_id'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'  => EmailTemplates::t('model', 'ID'),
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

    /**
     * Get template id by key
     *
     * @param string $key Key of the template
     * @return false|null|string
     */
    public static function getIdByKey($key)
    {
        return static::find()
            ->select('id')
            ->where(['key' => $key])
            ->scalar();
    }
}
