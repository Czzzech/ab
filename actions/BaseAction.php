<?php
namespace app\actions;

use yii\base\Action;

class BaseAction extends Action
{
    public $description = 'Base Action';
    public $view = 'index';
    public $filtersMethods = [];
    public $permission = [];
    public $modelClass = null;

    public function run() {
        return $this->controller->render($this->view, [

        ]);
    }

}