<?php
/**
 * View for \bl\emailTemplates\widgets\Error widget
 *
 * @var \yii\web\View $this
 * @var array $errors
 *
 * @link https://github.com/black-lamp/yii2-email-templates
 * @license GNU Public License
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @copyright Copyright (c) Vladimir Kuprienko
 */
?>

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
