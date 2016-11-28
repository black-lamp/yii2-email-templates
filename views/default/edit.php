<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use backend\bl\EmailTemplates;
use backend\bl\entities\EmailTemplate;
use backend\bl\entities\EmailTemplateTranslation;

/**
 * View for Default controller
 *
 * @var \yii\web\View $this
 * @var EmailTemplate $template
 * @var EmailTemplateTranslation $translation
 * @var array $errors
 * @var array $languages
 * @var array $current_language
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @link https://github.com/black-lamp/yii2-email-templates
 * @license https://opensource.org/licenses/GPL-3.0 GNU Public License
 */

\yii\bootstrap\BootstrapAsset::register($this);

$this->title = EmailTemplates::t('breadcrumbs', 'Edit email template');

$this->params['breadcrumbs'][] = [
    'label' => EmailTemplates::t('breadcrumbs', 'Email templates list'),
    'url' => ['list']
];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1 class="text-center">
                <?= $this->title ?>
            </h1>
        <!-- Errors -->
            <?php if(!empty($errors)): ?>
                <?php foreach($errors as $error): ?>
                    <?php foreach($error as $message): ?>
                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <?= $message ?>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        <!-- /Errors -->
        <!-- Languages -->
            <div class="dropdown pull-right">
                <button type="button"
                        class="dropdown-toggle btn btn-xs btn-warning"
                        id="languages-menu"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="true">
                    <?= current($current_language) ?>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="languages-menu">
                    <?php foreach($languages as $id => $name): ?>
                        <?php if($id == key($current_language)) continue; ?>
                        <li>
                            <?= Html::a($name, Url::toRoute([
                                'edit',
                                'templateId' => $template->id,
                                'languageId' => $id
                            ])) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="clearfix"></div>
        <!-- /Languages -->
        <!-- Creation form -->
            <?php $form = ActiveForm::begin([
                'action' => Url::toRoute([
                    'edit',
                    'templateId' => $template->id,
                    'languageId' => key($current_language)
                ])
            ]) ?>
                <?= $form->field($translation, 'subject')
                         ->textInput() ?>
                <?= $form->field($translation, 'body')
                         ->textarea([
                             'rows' => 10
                         ]) ?>
                <?= $form->field($template, 'key')
                         ->textInput() ?>
                <?= Html::submitButton(
                    EmailTemplates::t('backend', 'Save'),
                    ['class' => 'btn btn-success pull-right']
                ) ?>
            <?php $form->end() ?>
        <!-- /Creation form -->
        </div>
    </div>
</div>
