<?php
/**
 * Created by PhpStorm.
 * User: hjz
 * Date: 2018/11/16
 * Time: 上午12:47
 */

namespace app\models;

use Yii;
use yii\base\Model;

class EntryForm extends Model
{
    public $name;
    public $email;

    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            ['email', 'email'],
        ];
    }
}