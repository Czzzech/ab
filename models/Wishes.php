<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wishes".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property double $price
 * @property int $order
 * @property string $budget
 * @property string $user
 *
 * @property Budgets $budget0
 * @property UsersAuth $user0
 */
class Wishes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wishes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price', 'id'], 'number'],
            [['order', 'budget', 'user'], 'integer'],
            [['title'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 255],
            [['budget'], 'exist', 'skipOnError' => true, 'targetClass' => Budgets::class, 'targetAttribute' => ['budget' => 'id']],
            [['user'], 'exist', 'skipOnError' => true, 'targetClass' => UsersAuth::class, 'targetAttribute' => ['user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'price' => 'Price',
            'order' => 'Order',
            'budget' => 'Budget',
            'user' => 'User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBudget0()
    {
        return $this->hasOne(Budgets::class, ['id' => 'budget']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(UsersAuth::class, ['id' => 'user']);
    }
}
