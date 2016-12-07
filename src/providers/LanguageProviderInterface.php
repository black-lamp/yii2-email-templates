<?php
namespace bl\emailTemplates\providers;

/**
 * Interface for language provider
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @link https://github.com/black-lamp/yii2-email-templates
 * @license https://opensource.org/licenses/GPL-3.0 GNU Public License
 */
interface LanguageProviderInterface
{
    /**
     * @return array where key it's a primary key and value it's language name
     * Example ['1' => 'English', '2' => 'Russian', ...]
     */
    public function getLanguages();
}