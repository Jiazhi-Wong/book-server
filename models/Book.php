<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_book".
 *
 * @property int $book_id
 * @property string $book_name
 * @property string $book_author
 * @property string $book_desc
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_book';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_name', 'book_author'], 'required'],
            [['book_name'], 'string', 'max' => 50],
            [['book_author'], 'string', 'max' => 20],
            [['book_desc'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'book_id' => 'Book ID',
            'book_name' => 'Book Name',
            'book_author' => 'Book Author',
            'book_desc' => 'Book Desc',
        ];
    }
}
