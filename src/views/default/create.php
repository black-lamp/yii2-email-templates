<?php
use bl\emailTemplates\EmailTemplates;

/**
 * View for rendering create form
 *
 * @var \yii\web\View $this
 * @var array $_params_
 *
 * @link https://github.com/black-lamp/yii2-email-templates
 * @license GNU Public License
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @copyright Copyright (c) Vladimir Kuprienko
 */


$this->title = EmailTemplates::t('breadcrumbs', 'Create email template');
$this->params['breadcrumbs'][] = [
    'label' => EmailTemplates::t('breadcrumbs', 'Email templates list'),
    'url' => ['list']
];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('form', array_merge($_params_, ['btnTitle' => 'Create'])) ?>
