<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "users_auth".
 *
 * @property string $id
 * @property string $email
 * @property string $password
 * @property string $phone
 */
class UsersAuth extends User
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_auth';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password', 'phone'], 'required'],
            [['email', 'password'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 20],
            [['email'], 'unique'],
            [['phone'], 'unique'],
            [['access_token'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'phone' => 'Phone'
        ];
    }
}
