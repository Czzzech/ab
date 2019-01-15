<?php
namespace app\components;

use yii\web\UrlManager;
use Yii;
class Manager extends UrlManager
{
    public $social;
    public $game;

    public function init() {
        parent::init();

        $language = Yii::$app->request->cookies->getValue('language');
        if(!$language) {
            Yii::$app->response->cookies->add(new \yii\web\Cookie([
                'name' => 'language',
                'value' => Yii::$app->language,
            ]));
        } else Yii::$app->language = $language;
    }

    public function currentAction() {
        $controller = Yii::$app->controller;
        return $this->ctrAction($controller->id, $controller->action->id);
    }

    public function ctrAction($ctr, $act) {
        return $this->createUrl([$ctr . '/' . $act]);
    }

    public function error($messages = []) {
        print json_encode($messages);
        Yii::$app->response->statusCode = 303;
        Yii::$app->end();
    }

    public function header($header, $value) {
        Yii::$app->response->headers->add($header, $value);
    }
}