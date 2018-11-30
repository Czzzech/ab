<?php

namespace app\controllers;


use yii\rest\ActiveController;

class RestController extends ActiveController
{

    public function actionConfig(){
        return (new $this->modelClass())->fieldsConfigs();
    }

    public function actionModalcfg(){
        return (new $this->modelClass())->modalConfig();
    }
}