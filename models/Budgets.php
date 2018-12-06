<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "budgets".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $period
 * @property string $start
 * @property string $user
 *
 * @property UsersAuth $user0
 * @property Wishes[] $wishes
 */
class Budgets extends RestModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'budgets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['period', 'user', 'id'], 'integer'],
            [['start', 'user'], 'required'],
            [['start'], 'safe'],
            [['title'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 255],
            [['user'], 'exist', 'skipOnError' => true, 'targetClass' => UsersAuth::className(), 'targetAttribute' => ['user' => 'id']],
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
            'period' => 'Period',
            'start' => 'Start',
            'user' => 'User',
        ];
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
        return $this->hasMany(Wishes::class, ['budget' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSprints()
    {
        return $this->hasMany(Sprints::class, ['sprint' => 'id']);
    }
}
