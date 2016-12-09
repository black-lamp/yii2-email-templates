<?php
use yii\db\Migration;

/**
 * Handles the creation of table `email_template`.
 *
 * @link https://github.com/black-lamp/yii2-email-templates
 * @license GNU Public License
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @copyright Copyright (c) Vladimir Kuprienko
 */
class m161124_163823_create_email_template_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('email_template', [
            'id' => $this->primaryKey(),
            'key' => $this->string(255)->notNull()->unique()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('email_template');
    }
}
