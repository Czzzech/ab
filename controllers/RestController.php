<?php

namespace app\controllers;


use yii\rest\ActiveController;

class RestController extends ActiveController
{

    protected function verbs()
    {
        $verbs = parent::verbs();
        $verbs['config'] = ['GET', 'HEAD'];
        return $verbs;
    }

    public function actionConfig(){
        return (new $this->modelClass())->fieldsConfigs();
    }
}