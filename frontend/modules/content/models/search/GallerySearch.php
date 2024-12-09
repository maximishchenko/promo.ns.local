<?php
declare(strict_types=1);

namespace frontend\modules\content\models\search;

use yii\data\ActiveDataProvider;
use frontend\modules\content\models\Gallery;

class GallerySearch extends Gallery
{

    /**
     * @throws \Throwable
     */
    public function search($params): ActiveDataProvider
    {
        $query = Gallery::getDb()->cache(function() {
            return Gallery::find()->active()->ordered();
        }, Gallery::getCacheDuration(), Gallery::getCacheDependency());

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['sort'=>SORT_DESC]],
        ]);

        $this->load($params);

        return $dataProvider;
    }
}
