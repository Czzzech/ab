<?php

namespace app\utils\constants;

/**
 * Class ModalContentTypes
 * @package app\utils\constants
 *
 * Класс содержит возможные варианты контента в модальном окне,
 * используется для разветвления в движке angular в компоненте components/modal-content/modal-content.component.ts (this.config.type)
 */
class ModalContentTypes
{
    const FORM   = 'form';
    const CUSTOM = 'custom';
}