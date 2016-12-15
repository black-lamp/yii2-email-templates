<?php
/**
 * @license GNU Public License
 * @copyright Copyright (c) Vladimir Kuprienko
 * @link https://github.com/black-lamp/yii2-email-templates
 */

namespace bl\emailTemplates\widgets;

use yii\base\Widget;

/**
 * Widget for rendering errors from model
 *
 * @property array $errors
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
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
