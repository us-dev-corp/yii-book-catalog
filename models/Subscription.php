<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subscription".
 *
 * @property int $id
 * @property int $author
 * @property string $phone
 *
 * @property Authors $author0
 */
class Subscription extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subscription';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author', 'phone'], 'required'],
            [['author'], 'integer'],
            [['phone'], 'string', 'max' => 128],
            [['author'], 'exist', 'skipOnError' => true, 'targetClass' => Authors::class, 'targetAttribute' => ['author' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author' => 'Автор',
            'phone' => 'Телефон',
        ];
    }

    /**
     * Gets query for [[Author0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor0()
    {
        return $this->hasOne(Authors::class, ['id' => 'author']);
    }
}
