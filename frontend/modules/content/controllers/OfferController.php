<?php
declare(strict_types=1);

namespace frontend\modules\content\controllers;

use frontend\controllers\BaseController;
use frontend\modules\content\models\Offer;
use Yii;
use yii\web\NotFoundHttpException;

class OfferController extends BaseController
{
    public function actionIndex(): string
    {
        $activeOffers = Offer::getActiveOffer();
        if ($activeOffers) {
            return $this->render('index', ['offers' => $activeOffers]);
        }
        throw new NotFoundHttpException("Запрошенная страница не найдена");
    }

    public function actionView($slug)
    {
        $model = $this->findModelBySlug($slug);  
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    protected function findModelBySlug($slug)
    {
        $model = Offer::findOne(['slug' => $slug]);
        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}