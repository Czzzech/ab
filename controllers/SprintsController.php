<?php

namespace app\controllers;


class SprintsController extends RestController
{

    public function actions(){
        return [
            'index' => [
                'class' => 'app\actions\Rest\Index',
                'modelClass' => 'app\models\Sprints',
                'description' => \Yii::t('app', 'Получение всех спринтов'),
                'filtersMethods' => []
            ],
            'create' => [
                'class' => 'app\actions\Rest\Update',
                'modelClass' => 'app\models\Sprints',
                'description' => \Yii::t('app', 'Создание новых спринтов')
            ],
            'update' => [
                'class' => 'app\actions\Rest\Update',
                'modelClass' => 'app\models\Sprints',
                'description' => \Yii::t('app', 'Редактирование спринтов')
            ],
            'delete' => [
                'class' => 'app\actions\Rest\Delete',
                'modelClass' => 'app\models\Sprints',
                'description' => \Yii::t('app', 'Удаление спринтов')
            ]
        ];
    }
}