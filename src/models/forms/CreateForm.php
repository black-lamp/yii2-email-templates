<?php
namespace bl\emailTemplates\models\forms;

use yii\base\Exception;

use bl\emailTemplates\models\entities\EmailTemplate;
use bl\emailTemplates\models\entities\EmailTemplateTranslation;

/**
 * Model for form create
 *
 * @property $key
 * @property $languageId
 * @property $subject
 * @property $body
 *
 * @link https://github.com/black-lamp/yii2-email-templates
 * @license GNU Public License
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @copyright Copyright (c) Vladimir Kuprienko
 */
class CreateForm extends TemplateForm
{
    /**
     * @inheritdoc
     */
    public function save()
    {
        if(!$this->validate()) {
            return false;
        }

        $template = new EmailTemplate();
        $template->key = $this->key;

        $translation = new EmailTemplateTranslation();
        $translation->language_id = $this->languageId;
        $translation->subject = $this->subject;
        $translation->body = $this->body;

        $transaction = EmailTemplate::getDb()->beginTransaction();
        try {
            $template->insert(false);
            $translation->template_id = $template->id;
            $translation->insert(false);

            $transaction->commit();
        }
        catch (Exception $ex) {
            $transaction->rollBack();
            throw $ex;
        }

        return true;
    }
}