<?php

namespace app\controllers;

class WishesController extends RestController
{
    public function actions(){
        return [
            'index' => [
                'class' => 'app\actions\Rest\Index',
                'modelClass' => 'app\models\Wishes',
                'description' => \Yii::t('app', 'Получение всех желаний'),
                'filtersMethods' => []
            ],
            'create' => [
                'class' => 'app\actions\Rest\Update',
                'modelClass' => 'app\models\Wishes',
                'description' => \Yii::t('app', 'Создание новых желаний')
            ],
            'update' => [
                'class' => 'app\actions\Rest\Update',
                'modelClass' => 'app\models\Wishes',
                'description' => \Yii::t('app', 'Редактирование желаний')
            ],
            'delete' => [
                'class' => 'app\actions\Rest\Delete',
                'modelClass' => 'app\models\Wishes',
                'description' => \Yii::t('app', 'Удаление желаний')
            ],
            'config' => [
                'class' => 'app\actions\Rest\Config',
                'modelClass' => 'app\models\Wishes',
                'description' => \Yii::t('app', 'Получение конфига вьюхи грида или вьюхи формы желания')
            ]
        ];
    }
}