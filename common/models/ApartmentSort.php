<?php

namespace common\models;

use Yii;

class ApartmentSort
{
    const SORT_ATTRIBUTE = 'sort';

    const AREA_ASC = 'totalArea';
    
    const AREA_DESC = '-totalArea';

    const AREA_ASC_TEXT = 'От меньшей к большей';

    const AREA_DESC_TEXT = 'От большей к меньшей';

    public $sortParam = null;

    public $queryParams = [];

    public function __construct()
    {
        $this->queryParams = Yii::$app->request->queryParams;
        $this->sortParam = (isset($this->queryParams[self::SORT_ATTRIBUTE]) && !empty($this->queryParams[self::SORT_ATTRIBUTE])) ? $this->queryParams[self::SORT_ATTRIBUTE] : null;
    }

    /**
     * Выбранный параметр сортировки
     *
     * @return string
     */
    public function getCurrentSortText(): string
    {
        return ($this->sortParam == self::AREA_DESC) ? self::AREA_DESC_TEXT : self::AREA_ASC_TEXT;
    }

    /**
     * Параметры выпадающего списка доступных вариантов сортировки
     *
     * @return string
     */
    public function getAvailableSortText(): string
    {
        return ($this->sortParam == self::AREA_DESC) ? self::AREA_ASC_TEXT : self::AREA_DESC_TEXT;
    }

    /**
     * Значение выпадающего списка доступных вариантов сортировки
     *
     * @return string
     */
    public function getAvailableSortParam(): string
    {
        $this->queryParams[self::SORT_ATTRIBUTE] = ($this->sortParam == self::AREA_DESC) ? self::AREA_ASC : self::AREA_DESC;
        return strtok($_SERVER["REQUEST_URI"],'?') . '?' . http_build_query($this->queryParams);
    }
}