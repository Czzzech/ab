<?php

namespace app\controllers;


use yii\base\Controller;
use Yii;
use yii\web\Response;
use yii\filters\ContentNegotiator;

class RestController extends Controller
{
    public $_params = [];

    public function behaviors()
    {
        $behaviours =  parent::behaviors();
        $behaviours['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
                'application/xml' => Response::FORMAT_XML
            ]
        ];
        return $behaviours;
    }

    public function actions(){
        return [

        ];
    }

    public function redirect($url, $params = []) {
        if(Yii::$app->request->get('ajax')) {
            Yii::$app->response->statusCode = 303;
            if(empty($params['signals'])) {
                $params['signals'] = [];
            }
            $params['signals']['COMPONENTS.CONTENT.REDIRECT'] = ['url' => $url];
            Yii::$app->response->content = json_encode($params);
            return Yii::$app->response->content;
        } else Yii::$app->response->redirect($url);
    }

    public function render($view, $params = []) {
        $game_ajax = Yii::$app->request->get('ajax');
        if($game_ajax !== null) {
            $this->layout = 'ajax';
        }
        return parent::render($view, $params);
    }

    public function afterAction($action, $result) {
        if(isset($action->breadcrumbs)) {
            $header = [];
            foreach($action->breadcrumbs as $title => $_info) {
                $_header = ['title' => $title];

                if(!empty($_info['url'])) {
                    if(!Yii::$app->user->isCanUrl($_info['url'][0])) continue;
                    $_header['href'] = Yii::$app->urlManager->createUrl($_info['url']);
                    unset($_info['url']);
                }
                foreach($_info as $_key => $_value) {
                    $_header[$_key] = $_value;
                }
                $header[] = $_header;
            }
            if(count($header) > 0) {
                Yii::$app->urlManager->header(base64_encode(json_encode($header)));
            }
        }
        return $result;
    }

    public function deny($message) {
        Yii::$app->response->statusCode = 307;
        //$headers = Yii::$app->response->headers;
        Yii::$app->response->content = $message;
        return;
    }

    public static function getActionList(){
        $ctr = new static('test', 'test');
        $actions = [
            'title' => $ctr::TITLE,
            'list' => [],
        ];
        foreach($ctr->actions() as $action => $data){
            $actions['list'][$action] = empty($data['description']) ? 'empty' : $data['description'];
        }
        return $actions;
    }

    /// ajax actions
    public function formErrors($errors = []) {
        Yii::$app->response->statusCode = KitForm::STATUS_ERROR;
        return json_encode($errors);
    }

    public function alert($msg) {
        Yii::$app->response->statusCode = 303;
        return json_encode([
            'signals' => [
                'COMPONENTS.ALERT.OPEN' => [
                    'message' => $msg,
                    'type' => 'alert-danger'
                ]
            ]
        ]);
    }
}