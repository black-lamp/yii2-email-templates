<?php
/**
 * @link https://github.com/black-lamp/yii2-email-templates
 * @copyright Copyright (c) 2016 Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace bl\emailTemplates\data;

use bl\emailTemplates\models\entities\EmailTemplateTranslation;

/**
 * Model of email template
 *
 * @property string $subject
 * @property string $body
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class Template
{
    /**
     * @var string Subject of email
     */
    private $_subject;
    /**
     * @var string Body of email
     */
    private $_body;


    /**
     * Getter for `subject`
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->_subject;
    }

    /**
     * Getter for `body`
     *
     * @return string
     */
    public function getBody()
    {
        return $this->_body;
    }

    /**
     * Template constructor
     *
     * @param string $subject
     * @param string $body
     */
    public function __construct($subject, $body)
    {
        $this->_subject = $subject;
        $this->_body = $body;
    }

    /**
     * Parsing of email subject
     *
     * @param array $params of example
     * ```php
     * [
     *     '{link}' => 'https://github.com/black-lamp/yii2-email-templates'
     * ]
     * ```
     */
    public function parseSubject($params)
    {
        $this->_subject = self::parseTemplate($this->_subject, $params);
    }

    /**
     * Parsing of email body
     *
     * @param array $params of example
     * ```php
     * [
     *     '{link}' => 'https://github.com/black-lamp/yii2-email-templates',
     *      '{author}' => Yii::$app->user->email
     * ]
     * ```
     */
    public function parseBody($params)
    {
        $this->_body = self::parseTemplate($this->_body, $params);
    }


    /**
     * Parsing of template field
     *
     * @param array $subject_params
     * @param array $body_params
     * Array example
     * ```php
     * [
     *     '{link}' => 'https://github.com/black-lamp/yii2-email-templates',
     *      '{author}' => Yii::$app->user->email
     * ]
     * ```
     */
    public function parse($subject_params, $body_params)
    {
        $this->parseSubject($subject_params);
        $this->parseBody($body_params);
    }

    /**
     * Method for parsing string
     *
     * @param string $source Source string for parsing
     * @param array $params of example
     * ```php
     * [
     *     '{link}' => 'https://github.com/black-lamp/yii2-email-templates',
     *      '{author}' => Yii::$app->user->email
     * ]
     * ```
     * @return string
     */
    public static function parseTemplate($source, $params)
    {
        return strtr($source, $params);
    }

    /**
     * Builder for Template from Active Record model
     *
     * @param EmailTemplateTranslation $model
     * @return Template
     */
    public static function buildTemplate($model)
    {
        return new self($model->subject, $model->body);
    }

    /**
     * Builder for array of Template from Active Record model
     *
     * @param EmailTemplateTranslation[] $models
     * @return array
     */
    public static function buildTemplates($models)
    {
        $result = [];
        foreach($models as $model) {
            $result[] = self::buildTemplate($model);
        }

        return $result;
    }
}
