<?php
use yii\helpers\Url;
use yii\helpers\Html;

use bl\emailTemplates\EmailTemplates;
use bl\emailTemplates\entities\EmailTemplate;

/**
 * View for Default controller
 *
 * @var yii\web\View $this
 * @var EmailTemplate $templates
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @link https://github.com/black-lamp/yii2-email-templates
 * @license https://opensource.org/licenses/GPL-3.0 GNU Public License
 */

$this->title = EmailTemplates::t('breadcrumbs', 'Email templates list');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1 class="text-center">
                <?= $this->title ?>
            </h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>
                            <?= EmailTemplates::t('backend', 'Key') ?>
                        </th>
                        <th>
                            <?= EmailTemplates::t('backend', 'Actions') ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($templates as $num => $template): ?>
                    <tr>
                        <td>
                            <?= $num ?>
                        </td>
                        <td>
                            <?= $template->key ?>
                        </td>
                        <td>
                            <?= Html::a(
                                EmailTemplates::t('backend', 'Edit'),
                                Url::toRoute(['edit', 'templateId' => $template->id]),
                                ['class' => 'btn btn-xs btn-warning']
                            ) ?>
                            <?= Html::a(
                                EmailTemplates::t('backend', 'Delete'),
                                Url::toRoute(['delete', 'templateId' => $template->id]),
                                ['class' => 'btn btn-xs btn-danger']
                            ) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?= Html::a(
                EmailTemplates::t('backend', 'Create new template'),
                Url::toRoute('create'),
                ['class' => 'btn btn-success pull-right']
            ) ?>
        </div>
    </div>
</div>
