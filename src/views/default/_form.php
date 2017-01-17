<?php
/**
 * @link https://github.com/black-lamp/yii2-email-templates
 * @copyright Copyright (c) 2016 Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use bl\emailTemplates\EmailTemplates;
use bl\emailTemplates\widgets\Language;
use bl\emailTemplates\widgets\Error;

use dosamigos\tinymce\TinyMce;

/**
 * Base view for rendering forms
 *
 * @var \yii\web\View $this
 * @var \bl\emailTemplates\models\forms\CreateForm $model
 * @var array $errors
 * @var array $currentLanguage
 * @var string $btnTitle
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */

\yii\bootstrap\BootstrapAsset::register($this);
?>

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
    <!-- Form -->
        <?php $form = ActiveForm::begin() ?>
            <?= $form->field($model, 'subject')
                     ->textInput() ?>
            <?= $form->field($model, 'body')
                ->widget(TinyMce::class, [
                    'options' => ['rows' => 20],
                    'language' => 'en_CA',
                    'clientOptions' => [
                        'plugins' => [
                            "advlist autolink lists link charmap preview anchor",
                            "searchreplace visualblocks fullscreen",
                            "insertdatetime media table contextmenu paste"
                        ],
                        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                    ]
                ]) ?>
            <?= $form->field($model, 'key')
                     ->textInput() ?>
            <?= Html::submitButton(
                EmailTemplates::t('backend', $btnTitle),
                ['class' => 'btn btn-success pull-right']
            ) ?>
        <?php $form->end() ?>
    <!-- /Form -->
    </div>
</div>
