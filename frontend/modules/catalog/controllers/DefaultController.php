<?php

namespace frontend\modules\catalog\controllers;

use frontend\modules\catalog\models\Apartment;
use frontend\modules\catalog\models\search\ApartmentSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new ApartmentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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
        // $model = Apartment::getDb()->cache(function() use ($slug) {
            // return Apartment::findOne(['slug' => $slug]);
        // }, Apartment::getCacheDuration(), Apartment::getCacheDependency());
        $model = Apartment::findOne(['slug' => $slug]);
        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
