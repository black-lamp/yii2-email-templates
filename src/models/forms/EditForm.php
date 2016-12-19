<?php
/**
 * @link https://github.com/black-lamp/yii2-email-templates
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace bl\emailTemplates\models\forms;

use yii\base\Exception;

use bl\emailTemplates\models\entities\EmailTemplate;
use bl\emailTemplates\models\entities\EmailTemplateTranslation;

/**
 * Model for edit form
 *
 * @property string $key
 * @property integer $languageId
 * @property integer $templateId
 * @property string $subject
 * @property string $body
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class EditForm extends TemplateForm
{
    public $templateId;

    /**
     * @var EmailTemplate
     */
    protected $_template;
    /**
     * @var EmailTemplateTranslation
     */
    protected $_translation;


    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->_template = EmailTemplate::find()
            ->where(['id' => $this->templateId])
            ->one();

        $this->_translation = EmailTemplateTranslation::find()
            ->where([
                'template_id' => $this->templateId,
                'language_id' => $this->languageId
            ])
            ->one();

        $attrs = ['key' => $this->_template->key];
        if(!is_null($this->_translation)) {
            $attrs['subject'] = $this->_translation->subject;
            $attrs['body'] = $this->_translation->body;
        }

        $this->attributes = $attrs;
    }

    /**
     * @inheritdoc
     */
    public function save()
    {
        if(!$this->validate()) {
            return false;
        }

        $transaction = EmailTemplate::getDb()->beginTransaction();
        try {
            $this->_template->key = $this->key;
            $this->_template->update();

            if(is_null($this->_translation)) {
                $this->_translation = new EmailTemplateTranslation();
                $this->_translation->template_id = $this->templateId;
                $this->_translation->language_id = $this->languageId;
            }

            $this->_translation->subject = $this->subject;
            $this->_translation->body = $this->body;
            $this->_translation->save(false);

            $transaction->commit();
        }
        catch(Exception $ex) {
            $transaction->rollBack();
            throw $ex;
        }

        return true;
    }
}