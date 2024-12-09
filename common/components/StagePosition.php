<?php


namespace common\components;

use Yii;

class StagePosition
{
    const POSITION_ROUND = 'round';

    const POSITION_LIST = 'list';

    public static function getStagePositionsArray(): array
    {
        return [
            static::POSITION_ROUND => Yii::t('app', 'Stage Positino Round'),
            static::POSITION_LIST => Yii::t('app', 'Stage Positino List'),
        ];
    }
}