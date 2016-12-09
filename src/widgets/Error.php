<?php
namespace bl\emailTemplates\widgets;

use yii\base\Widget;

/**
 * Widget for rendering errors from model
 *
 * @property array $errors
 *
 * @link https://github.com/black-lamp/yii2-email-templates
 * @license GNU Public License
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @copyright Copyright (c) Vladimir Kuprienko
 */
class Error extends Widget
{
    /**
     * @var array
     */
    public $errors;

    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->render('errors', ['errors' => $this->errors]);
    }
}
