<?php

namespace app\actions\Rest;


use app\actions\BaseAction;
use yii\data\ActiveDataProvider;
use Yii;

class Index extends BaseAction
{
    public function run(){
        $requestParams = Yii::$app->getRequest()->getBodyParams();
        if (empty($requestParams)) {
            $requestParams = Yii::$app->getRequest()->getQueryParams();
        }

        $model = new $this->modelClass();
        $query = $model->find();
        if (!empty($this->filtersMethods)) {
            foreach ($this->filtersMethods as $filtersMethod) {
                if (method_exists($model, $filtersMethod)) {
                    $model->{$filtersMethod}($query, $this);
                }
            }
        }

        return \Yii::createObject([
            'class' => ActiveDataProvider::class,
            'query' => $query->asArray()->all(),
            'pagination' => [
                'params' => $requestParams,
            ],
            'sort' => [
                'params' => $requestParams,
            ]
        ]);
    }

}