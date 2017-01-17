<?php
/**
 * @link https://github.com/black-lamp/yii2-email-templates
 * @copyright Copyright (c) 2016 Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

use bl\emailTemplates\EmailTemplates;

/**
 * View rendering edit form
 *
 * @var \yii\web\View $this
 * @var array $_params_
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */

$this->title = EmailTemplates::t('breadcrumbs', 'Edit email template');
$this->params['breadcrumbs'][] = [
    'label' => EmailTemplates::t('breadcrumbs', 'Email templates list'),
    'url' => ['list']
];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', array_merge($_params_, ['btnTitle' => 'Edit'])) ?>
