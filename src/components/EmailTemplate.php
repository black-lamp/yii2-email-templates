<?php
namespace bl\emailTemplates\components;

use yii\base\Object;
use yii\db\ActiveQuery;

use bl\emailTemplates\data\Template;
use bl\emailTemplates\entities\EmailTemplate as TemplateEntity;

/**
 * Component for work with email templates
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @link https://github.com/black-lamp/yii2-email-templates
 * @license https://opensource.org/licenses/GPL-3.0 GNU Public License
 */
class EmailTemplate extends Object
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

        $model = new Template(
            $template->translations[0]->subject,
            $template->translations[0]->body
        );

        return $model;
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

        $models = [];
        foreach($templates->translations as $template) {
            $models[] = new Template($template->subject, $template->body);
        }

        return $models;
    }
}