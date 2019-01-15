<?php

namespace app\actions\Rest;

use app\actions\BaseAction;

class Config extends BaseAction
{
    public function run(){

        return json_encode(
            (new $this->modelClass())->getConfigs()
        );
    }
}