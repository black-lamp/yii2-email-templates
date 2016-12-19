<?php
/**
 * View for \bl\emailTemplates\widgets\Error widget
 *
 * @var \yii\web\View $this
 * @var array $errors
 *
 * @link https://github.com/black-lamp/yii2-email-templates
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
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
