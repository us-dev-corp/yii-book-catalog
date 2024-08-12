<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "authors".
 *
 * @property int $id
 * @property string $surname
 * @property string $name
 * @property string|null $patronymic
 *
 * @property AuthorsOfBooks[] $authorsOfBooks
 */
class Authors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['surname', 'name'], 'required'],
            [['surname', 'name', 'patronymic'], 'string', 'max' => 12],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'surname' => 'Фамилия',
            'name' => 'Имя',
            'patronymic' => 'Отчество',
        ];
    }

    /**
     * Gets query for [[AuthorsOfBooks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorsOfBooks()
    {
        return $this->hasMany(AuthorsOfBooks::class, ['author' => 'id']);
    }

    public function getBooks(): ActiveQuery
    {
        return $this->hasMany(Books::class, ['id' => 'book'])
            ->viaTable('authors_of_books', ['author' => 'id']);
    }

    /**
     * Получить ФИО
     *
     * @return string
     */
    public function getFullName(): string
    {
        return trim($this->surname . ' ' . $this->name . ' ' . $this->patronymic ?? '');
    }

    /**
     * Получить подписчиков автора
     * 
     * @return mixed
     */
    public function getSubscribers()
    {
        return $this->hasMany(Subscription::class, ['author' => 'id']);
    }
}
