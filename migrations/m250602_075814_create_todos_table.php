<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%todos}}`.
 */
class m250602_075814_create_todos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%todos}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'status' => $this->integer()->notNull()->defaultValue(0),
        ]);


        $this->addForeignKey(
            'fk-todos-user_id',
            '{{%todos}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-todos-user_id', '{{%todos}}');
        $this->dropTable('{{%todos}}');
    }
}
