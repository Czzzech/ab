<?php

namespace app\models;

use Yii;
class FormSettings extends RestModel
{
    public static function tableName()
    {
        return 'form_settings';
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
            [['model'], 'string'],
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