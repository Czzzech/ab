<?php

namespace app\controllers;

class BudgetsController extends RestController
{
    public function actions(){
        return [
            'index' => [
                'class' => 'app\actions\Rest\Index',
                'modelClass' => 'app\models\Sprints',
                'description' => \Yii::t('app', 'Получение всех бюджетов'),
                'filtersMethods' => []
            ],
            'create' => [
                'class' => 'app\actions\Rest\Update',
                'modelClass' => 'app\models\Sprints',
                'description' => \Yii::t('app', 'Создание новых бюджетов')
            ],
            'update' => [
                'class' => 'app\actions\Rest\Update',
                'modelClass' => 'app\models\Sprints',
                'description' => \Yii::t('app', 'Редактирование бюджетов')
            ],
            'delete' => [
                'class' => 'app\actions\Rest\Delete',
                'modelClass' => 'app\models\Sprints',
                'description' => \Yii::t('app', 'Удаление бюджетов')
            ]
        ];
    }
}