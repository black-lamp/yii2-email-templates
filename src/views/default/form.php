<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use bl\emailTemplates\EmailTemplates;
use bl\emailTemplates\widgets\Language;
use bl\emailTemplates\widgets\Error;

/**
 * Base view for rendering forms
 *
 * @var \yii\web\View $this
 * @var \bl\emailTemplates\models\forms\CreateForm $model
 * @var array $errors
 * @var array $currentLanguage
 * @var string $btnTitle
 *
 * @link https://github.com/black-lamp/yii2-email-templates
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */

\yii\bootstrap\BootstrapAsset::register($this);
?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1 class="text-center">
                <?= $this->title ?>
            </h1>
        <!-- Errors -->
            <?php if(!empty($errors)): ?>
                <?= Error::widget(['errors' => $errors]) ?>
            <?php endif; ?>
        <!-- /Errors -->
        <!-- Languages -->
            <?= Language::widget([
                'currentLanguage' => $currentLanguage
            ]) ?>
        <!-- /Languages -->
        <!-- Creation form -->
            <?php $form = ActiveForm::begin() ?>
                <?= $form->field($model, 'subject')
                         ->textInput() ?>
                <?= $form->field($model, 'body')
                         ->textarea([
                             'rows' => 10
                         ]) ?>
                <?= $form->field($model, 'key')
                         ->textInput() ?>
                <?= Html::submitButton(
                    EmailTemplates::t('backend', $btnTitle),
                    ['class' => 'btn btn-success pull-right']
                ) ?>
            <?php $form->end() ?>
        <!-- /Creation form -->
        </div>
    </div>
</div>
