<?php

declare(strict_types=1);

namespace backend\modules\content\models;

use backend\modules\content\models\Premise;
use backend\modules\content\models\query\PremiseQuery;
use yii\helpers\ArrayHelper;

class Commercial extends Premise
{
    const TYPE = 'commercial';

    /**
     * @return void
     */
    public function init(): void
    {
        $this->premise_type = self::TYPE;
        parent::init();
    }

    /**
     * @return PremiseQuery
     */
    public static function find(): PremiseQuery
    {
        return new PremiseQuery(get_called_class(), ['premise_type' => self::TYPE]);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), [
            [['name'], 'unique', 'targetClass' => self::classname()],
        ]);
    }

    /**
     * @param $insert
     * @return bool
     */
    public function beforeSave($insert): bool
    {
        $this->premise_type = self::TYPE;
        return parent::beforeSave($insert);
    }
}
