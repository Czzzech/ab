<?php

namespace app\actions\Rest;

use yii\rest\Action;

class Config extends Action
{
    public function run(){

        return \Yii::createObject([
            (new $this->modelClass())->getFieldsConfigs()
        ]);
    }
}