<?php
/**
 * @link https://github.com/black-lamp/yii2-email-templates
 * @copyright Copyright (c) 2016 Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace bl\emailTemplates\components;

use yii\base\Object;

use bl\emailTemplates\data\Template;
use bl\emailTemplates\models\entities\EmailTemplate;
use bl\emailTemplates\models\entities\EmailTemplateTranslation;

/**
 * Component for work with email templates
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class TemplateManager extends Object
{
    /**
     * Getting email template model by key
     *
     * @param string $key
     * @param integer $language_id
     * @return null|Template
     */
    public function getTemplate($key, $language_id)
    {
        if ($template = EmailTemplateTranslation::findOne([
            'template_id' => EmailTemplate::getIdByKey($key),
            'language_id' => $language_id
        ])) {
            return Template::buildTemplate($template);
        }

        return null;
    }

    /**
     * Getting email template models by key
     *
     * @param string $key
     * @return null|Template[]
     */
    public function getTemplates($key)
    {
        /** @var EmailTemplateTranslation[] $templates */
        if ($templates = EmailTemplateTranslation::findAll([
            'template_id' => EmailTemplate::getIdByKey($key)
        ])) {
            return Template::buildTemplates($templates);
        }

        return null;
    }


    /**
     * Get template
     *
     * @param string $key
     * @param $languageId
     * @return Template|null
     */
    public function getByLangOrFirst($key, $languageId)
    {
        $templateId = EmailTemplate::getIdByKey($key);

        if ($template = EmailTemplateTranslation::findOne([
            'template_id' => $templateId,
            'language_id' => $languageId
        ])) {
            return Template::buildTemplate($template);
        }
        elseif ($templates = EmailTemplateTranslation::findAll([
            'template_id' => $templateId
        ])) {
            return Template::buildTemplate($templates[0]);
        }

        return null;
    }
}