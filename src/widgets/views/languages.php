<?php
use yii\helpers\Url;
use yii\helpers\Html;

/**
 * View for \bl\emailTemplates\widgets\Language widget
 *
 * @var \yii\web\View $this
 * @var array $languages
 * @var array $currentLanguage
 *
 * @link https://github.com/black-lamp/yii2-email-templates
 * @license GNU Public License
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @copyright Copyright (c) Vladimir Kuprienko
 */
?>

<div class="dropdown pull-right">
    <button type="button"
            class="dropdown-toggle btn btn-xs btn-warning"
            id="languages-menu"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="true">
        <?= current($currentLanguage) ?>
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="languages-menu">
        <?php foreach($languages as $id => $name): ?>
            <?php if($id == key($currentLanguage)) continue; ?>
            <li>
                <?= Html::a($name, Url::current(['languageId' => $id])) ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<div class="clearfix"></div>
