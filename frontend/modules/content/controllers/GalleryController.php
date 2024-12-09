<?php
declare(strict_types=1);

namespace frontend\modules\content\controllers;

use frontend\controllers\BaseController;
use frontend\modules\catalog\models\House;
use frontend\modules\content\models\Gallery;
use Yii;
use yii\web\NotFoundHttpException;

class GalleryController extends BaseController
{
    public function actionIndex(): string
    {
        // $model = new Gallery();
        $houses = House::find()->active()->galleryOrdered()->all();

        return $this->render('index', [
            // 'model' => $model,
            'houses' => $houses
        ]);
    }

    public function actionView($id)
    {
        $house = $this->findModel($id);
        return $this->render('view', [
            'house' => $house,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = House::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}