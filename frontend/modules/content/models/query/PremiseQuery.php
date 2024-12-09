<?php
declare(strict_types=1);

namespace frontend\modules\content\models\query;

use backend\modules\content\models\Commercial;
use backend\modules\content\models\Parking;
use backend\modules\content\models\query\PremiseQuery as backendPremiseQuery;
use backend\modules\content\models\Storage;
use frontend\traits\activeOfferedQueryTrait;

class PremiseQuery extends backendPremiseQuery
{
    use activeOfferedQueryTrait;

    /**
     * @return PremiseQuery
     */
    public function onlyCommercial(): PremiseQuery
    {
        return $this->andWhere(['premise_type' => Commercial::TYPE]);
    }

    /**
     * @return PremiseQuery
     */
    public function onlyStorage(): PremiseQuery
    {
        return $this->andWhere(['premise_type' => Storage::TYPE]);
    }

    /**
     * @return PremiseQuery
     */
    public function onlyParking(): PremiseQuery
    {
        return $this->andWhere(['premise_type' => Parking::TYPE]);
    }

    /**
     * @param $id
     * @return PremiseQuery
     */
    public function activeItem($id): PremiseQuery
    {
        return $this->andWhere(['id' => $id]);
    }

    /**
     * @param $id
     * @return PremiseQuery
     */
    public function stages($id): PremiseQuery
    {
        return $this->andWhere(['<>', 'id', $id]);
    }
}
