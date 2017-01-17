<?php
/**
 * @link https://github.com/black-lamp/yii2-email-templates
 * @copyright Copyright (c) 2016 Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace bl\emailTemplates\models\forms;

use yii\base\Exception;

use bl\emailTemplates\models\entities\EmailTemplate;
use bl\emailTemplates\models\entities\EmailTemplateTranslation;

/**
 * Model for form create
 *
 * @property string $key
 * @property integer $languageId
 * @property string $subject
 * @property string $body
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
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