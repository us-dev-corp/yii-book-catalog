<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subscription}}`.
 */
class m240812_055834_create_subscription_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%subscription}}', [
            'id' => $this->primaryKey(),
            'author' => $this->integer()->notNull(),
            'phone' => $this->string(128)->notNull()
        ]);

        $this->addForeignKey(
            'fk-subscription-author_id',
            'subscription',
            'author',
            'authors',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%subscription}}');
    }
}
