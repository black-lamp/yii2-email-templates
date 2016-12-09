<?php
use yii\db\Migration;

/**
 * Handles the creation of table `email_template_translation`.
 *
 * @link https://github.com/black-lamp/yii2-email-templates
 * @license GNU Public License
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @copyright Copyright (c) Vladimir Kuprienko
 */
class m161124_163834_create_email_template_translation_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('email_template_translation', [
            'id' => $this->primaryKey(),
            'template_id' => $this->integer()->notNull(),
            'language_id' => $this->integer()->notNull(),
            'subject' => $this->string(),
            'body' => $this->text()
        ]);

        $this->addForeignKey('email_template_translation-email_template-PK', 'email_template_translation',
            'template_id', 'email_template', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('email_template_translation-email_template-PK', 'email_template_translation');

        $this->dropTable('email_template_translation');
    }
}
