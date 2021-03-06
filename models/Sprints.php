<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sprintes".
 *
 * @property string $id
 * @property string $budget
 * @property string $start
 * @property double $spend
 *
 * @property Budgets $budget0
 * @property Wishes[] $wishes
 */
class Sprints extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sprints';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['budget', 'user'], 'required'],
            [['budget', 'user'], 'integer'],
            [['start'], 'safe'],
            [['spend'], 'number'],
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
            'id' => Yii::t('app', 'Идентификатор'),
            'budget' => Yii::t('app', 'Бюджет'),
            'start' => Yii::t('app', 'Начало периода'),
            'spend' => Yii::t('app', 'Потраченная сумма'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWishes()
    {
        return $this->hasMany(Wishes::class, ['sprint' => 'id']);
    }
}
