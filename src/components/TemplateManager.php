<?php
/**
 * @link https://github.com/black-lamp/yii2-email-templates
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace bl\emailTemplates\components;

use yii\base\Object;
use yii\db\ActiveQuery;

use bl\emailTemplates\data\Template;
use bl\emailTemplates\models\entities\EmailTemplate as TemplateEntity;

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
     * @return Template
     */
    public function getTemplate($key, $language_id)
    {
        /** @var TemplateEntity $template */
        $template = TemplateEntity::find()
            ->where(['key' => $key])
            ->with(['translations' => function($query) use($language_id) {
                /** @var ActiveQuery $query */
                $query->andWhere(['language_id' => $language_id]);
            }])
            ->one();

        return Template::buildTemplate($template->translations[0]);
    }

    /**
     * Getting email template models by key
     *
     * @param string $key
     * @return Template[]
     */
    public function getTemplates($key)
    {
        /** @var TemplateEntity $templates */
        $templates = TemplateEntity::find()
            ->where(['key' => $key])
            ->with('translations')
            ->one();

        return Template::buildTemplates($templates->translations);
    }
}