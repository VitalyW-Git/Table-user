<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string|null $surname
 * @property string $password
 * @property string $phone
 * @property string $email
 * @property int $created_at
 * @property int $updated_at
 */
class Users extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [ ['name', 'password', 'phone', 'email'], 'required', 'message' => 'Поле обязательно для заполнения!' ],
            [ ['name', 'surname', 'password', 'phone', 'email'], 'trim' ],
            [ 'email', 'email', 'message' => 'Неверный формат почтвого адреса!' ],
            [ ['email'], 'unique', 'message' => 'Пользователь с таким email уже зарегистрирован!' ],
            [ 'phone', 'match', 'pattern' => '/\+7 \(\d{3}\) \d{3} \d{2} \d{2}/', 'message' => 'Неверрный формат телефона!' ],
            [ ['surname'], 'safe' ],
        ];
//        return [
//            [['name', 'password', 'phone', 'email', 'created_at', 'updated_at'], 'required'],
//            [['created_at', 'updated_at'], 'integer'],
//            [['name', 'surname', 'password', 'email'], 'string', 'max' => 255],
//            [['phone'], 'string', 'max' => 11],
//            [['email'], 'unique'],
//        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'password' => 'Пароль',
            'phone' => 'Телефон',
            'email' => 'Email',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [[
            'class' => TimestampBehavior::className(),
            'attributes' => [
                ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
            ]
        ]];
    }
}
