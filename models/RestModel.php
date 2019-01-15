<?php

namespace app\models;


use app\utils\constants\ModalContentTypes;
use yii\db\ActiveRecord;

class RestModel extends ActiveRecord
{

    const MODAL_HEADER_CONFIG = [];
    const MODAL_CONTENT_CONFIG = [];
    const MODAL_FOOTER_CONFIG = [];

    /**
     * Список атрибутов, которые будут отображаться в гриде.
     */
    const GRID_FIELDS           = [

    ];

    /**
     * Компоненты, которые используются для отрисовки поля в гриде Angular - заголовок колонки
     * Нужно описывать в каждой модели
     * По умолчанию пустой компонент отрисуется дефолтным GridBaseHeaderCellComponent
     * Важно!!! Не забывайте добавлять эти компоненты в DynamicComponentsMapping service в Angular
     */
    const GRID_HEADER_COMPONENTS     = [];

    /**
     * Компоненты, которые используются для отрисовки поля в гриде Angular - ячейка с данными
     * Нужно описывать в каждой модели
     * По умолчанию пустой компонент отрисуется дефолтным GridBaseColumnComponent
     * Важно!!! Не забывайте добавлять эти компоненты в DynamicComponentsMapping service в Angular
     */
    const GRID_CONTENT_COMPONENTS    = [];

    /**
     * Конфиги для фильтра в заголовке грида
     * Нужно описывать в каждой модели, если нужно.
     * По умолчанию нет никаких фильтров.
     */
    const GRID_FILTERS    = [];
    const GRID_PAGINATION    = [];

    protected function getHeaderComponent($field){
        return static::GRID_HEADER_COMPONENTS[$field] ?? '';
    }

    protected function getContentComponent($field){
        return static::GRID_CONTENT_COMPONENTS[$field] ?? '';
    }

    protected function getFilterConfig($field){
        return static::FILTERS_CONFIGS[$field] ?? [];
    }

    public function modalConfig(){
        $config = [
            'header' => static::MODAL_HEADER_CONFIG,
            'content' => static::MODAL_CONTENT_CONFIG,
            'footer' => static::MODAL_FOOTER_CONFIG
        ];
        if($config['content']['type'] === ModalContentTypes::FORM){
            $config['content']['formConfig'] = $this->getFormConfig();
        }
        return $config;
    }

    public function getConfigs(){
        $config = [
            'modal' => $this->modalConfig(),
            'grid' => $this->getGridConfig()
        ];

        return $config;
    }

    protected function getGridConfig(){
        return [
            'header' => static::GRID_HEADER_COMPONENTS,
            'content' => static::GRID_CONTENT_COMPONENTS,
            'columns' => static::GRID_FIELDS,
            'filters' => static::GRID_FILTERS,
            'pagination' => static::GRID_PAGINATION
        ];
    }
}