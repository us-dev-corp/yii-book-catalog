<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string $title
 * @property int $year
 * @property string|null $description
 * @property string $isbn
 * @property string|null $photo
 *
 * @property AuthorsOfBooks[] $authorsOfBooks
 * @property Authors $authors
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'year', 'isbn'], 'required'],
            [['year'], 'integer'],
            [['description', 'photo'], 'string'],
            [['title', 'isbn'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'year' => 'Год выпуска',
            'description' => 'Описание',
            'isbn' => 'ISBN',
            'photo' => 'Изображение',
        ];
    }

    /**
     * Gets query for [[AuthorsOfBooks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorsOfBooks()
    {
        return $this->hasMany(AuthorsOfBooks::class, ['book' => 'id']);
    }

    /**
     * Получить всех авторов книги
     *
     * @return ActiveQuery
     */
    public function getAuthors(): ActiveQuery
    {
        return $this->hasMany(Authors::class, ['id' => 'author'])
            ->viaTable('authors_of_books', ['book' => 'id']);
    }
}
