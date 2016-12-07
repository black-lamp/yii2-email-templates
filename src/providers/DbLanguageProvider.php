<?php
namespace bl\emailTemplates\providers;

use yii\base\Object;
use yii\db\ActiveRecord;

/**
 * Database language provider
 *
 * @property string $arModel
 * @property integer $idField
 * @property string $nameField
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @link https://github.com/black-lamp/yii2-email-templates
 * @license https://opensource.org/licenses/GPL-3.0 GNU Public License
 */
class DbLanguageProvider extends Object implements LanguageProviderInterface
{
    /**
     * @var string Name of Active Record model
     */
    public $arModel;

    /**
     * @var string Name of field with primary key
     */
    public $idField;

    /**
     * @var string Name of field with language name
     */
    public $nameField;

    /**
     * @inheritdoc
     */
    public function getLanguages()
    {
        /** @var ActiveRecord $entity */
        $entity = $this->arModel;
        $languages = $entity::find()
            ->select([$this->idField, $this->nameField])
            ->all();

        $result = [];
        foreach ($languages as $language) {
            $result[$language->{$this->idField}] = $language->{$this->nameField};
        }

        return $result;
    }
}