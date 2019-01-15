<?php

namespace app\utils\constants;

/**
 * Class Fields
 * @package app\utils\constants
 * Содержит текстовки соответствующие классам компонентов на стороне front (angular).
 * Так фронтендный движок понимает каким компонентом отрисовывать то или иное поле.
 * Все эти компоненты находятся в /angular/src/app/components/fields/
 *
 */
class Fields
{
    const TEXT_FIELD      = 'TextFieldComponent';
    const TEXT_AREA       = 'TextAreaComponent';
    const DATE            = 'DateFieldComponent';
}