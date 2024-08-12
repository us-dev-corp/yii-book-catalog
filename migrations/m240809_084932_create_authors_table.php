<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%authors}}`.
 */
class m240809_084932_create_authors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%authors}}', [
            'id' => $this->primaryKey(),
            'surname' => $this->string(128)->notNull(),
            'name' => $this->string(128)->notNull(),
            'patronymic' => $this->string(128),
        ], $tableOptions);

        $this->insert('authors', [
            'surname' => 'Сандерсон',
            'name' => 'Брендон',
            'patronymic' => '',
        ]);

        $this->insert('authors', [
            'surname' => 'Джордан',
            'name' => 'Роберт',
            'patronymic' => '',
        ]);

        $this->insert('authors', [
            'surname' => 'Гоголь',
            'name' => 'Николай',
            'patronymic' => 'Васильевич',
        ]);

        $this->insert('authors', [
            'surname' => 'Мартин',
            'name' => 'Роберт',
            'patronymic' => 'Сесил',
        ]);

        $this->insert('authors', [
            'surname' => 'Кристи',
            'name' => 'Агата',
            'patronymic' => '',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%authors}}');
    }
}
