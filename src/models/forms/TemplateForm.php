<?php
namespace bl\emailTemplates\models\forms;

use yii\base\Model;

/**
 * Base class of model for forms
 *
 * @property string $key
 * @property integer $languageId
 * @property string $subject
 * @property string $body
 *
 * @link https://github.com/black-lamp/yii2-email-templates
 * @license GNU Public License
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @copyright Copyright (c) Vladimir Kuprienko
 */
abstract class TemplateForm extends Model
{
    /**
     * @var string Key of template
     */
    public $key;

    /**
     * @var integer Language of email template
     */
    public $languageId;

    /**
     * @var string Subject of email template
     */
    public $subject;

    /**
     * @var string Body of email template
     */
    public $body;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            [['key'], 'string', 'max' => 255],

            [['languageId'], 'required'],
            [['languageId'], 'integer'],

            [['subject'], 'string', 'max' => 255],

            [['body'], 'string'],
        ];
    }

    /**
     * Method for saving model to database
     * @return boolean returns `true` if successfully saved
     * `false` if not saved
     */
    abstract public function save();
}