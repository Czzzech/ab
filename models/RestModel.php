<?php

namespace app\models;


use yii\db\ActiveRecord;

class RestModel extends ActiveRecord
{
    const FIELD_TEXT_FIELD      = 'TextField';
    const FIELD_DATE            = 'DateField';

    const TYPE_NUMBER           = 'number';
    const TYPE_STRING           = 'string';
    const TYPE_DATE             = 'Date';

    const MODAL_CONTENT_TYPE_FORM   = 'form';
    const MODAL_CONTENT_TYPE_CUSTOM = 'custom';

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
     * По умолчанию пустой компонент орисуется дефолтным GridBaseHeaderCellComponent
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
    const FILTERS_CONFIGS    = [];

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
        if($config['content']['type'] === self::MODAL_CONTENT_TYPE_FORM){
            $config['content']['formContent'] = $this->getFormConfig();
        }
        return $config;
    }

    public function fieldsConfigs(){
        $config = [];
        foreach (array_keys($this->attributes) as $field){
            $config[] = [
                'key' => $field,
                'header' => [
                    'component' => $this->getHeaderComponent($field),
                    'title' => $this->getAttributeLabel($field)
                ],
                'content' => [
                    'component' => $this->getContentComponent($field),
                ],
                'show' => in_array($field, static::GRID_FIELDS),
                'filters' => $this->getFilterConfig($field),
            ];
        }
        return $config;
    }
}