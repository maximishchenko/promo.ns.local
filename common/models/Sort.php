<?php

declare(strict_types=1);

namespace common\models;


class Sort
{
    const DEFAULT_SORT_VALUE = 500;

    public static function getBackendDefaultSort(): array
    {
        return ['id'=>SORT_DESC];
    }
}