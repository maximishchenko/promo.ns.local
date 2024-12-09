<?php

declare(strict_types=1);

namespace backend\modules\content\models;

use backend\modules\content\models\Premise;
use backend\modules\content\models\query\PremiseQuery;
use yii\helpers\ArrayHelper;


class Parking extends Premise
{
    const TYPE = 'parking';

    public function init(): void
    {
        $this->premise_type = self::TYPE;
        parent::init();
    }

    public static function find(): PremiseQuery
    {
        return new PremiseQuery(get_called_class(), ['premise_type' => self::TYPE]);
    }

    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), [
            [['name'], 'unique', 'targetClass' => self::classname()],
        ]);
    }

    public function beforeSave($insert): bool
    {
        $this->premise_type = self::TYPE;
        return parent::beforeSave($insert);
    }
}
