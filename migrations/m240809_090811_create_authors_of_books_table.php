<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%authors_of_books}}`.
 */
class m240809_090811_create_authors_of_books_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%authors_of_books}}', [
            'id' => $this->primaryKey(),
            'author' => $this->integer()->notNull(),
            'book' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-authors_of_books-author_id',
            'authors_of_books',
            'author',
            'authors',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-authors_of_books-book_id',
            'authors_of_books',
            'book',
            'books',
            'id',
            'CASCADE'
        );

        $this->insert('authors_of_books', [
            'author' => 1,
            'book' => 1,
        ]);

        $this->insert('authors_of_books', [
            'author' => 2,
            'book' => 1,
        ]);

        $this->insert('authors_of_books', [
            'author' => 3,
            'book' => 2,
        ]);

        $this->insert('authors_of_books', [
            'author' => 4,
            'book' => 3,
        ]);

        $this->insert('authors_of_books', [
            'author' => 5,
            'book' => 4,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%authors_of_books}}');
    }
}
