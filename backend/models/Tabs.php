<?php

namespace backend\models;

use Yii;

class Tabs
{  
    public static function isActionActive(array $actArray) {
        $action = Yii::$app->controller->action->id;
        foreach ($actArray as $act) {
            if ($act == $action) {
                return 'nav-link active';
            }
        }
        return 'nav-link';
    }
}