<?php

namespace frontend\controllers;

use frontend\modules\catalog\models\Apartment;
use frontend\modules\catalog\models\Layout;
use frontend\modules\content\models\Gallery;
use frontend\modules\content\models\Stage;
use frontend\modules\content\models\Offer;

class SiteController extends BaseController
{

    /**
     * Главная страница
     * @return string
     */
    public function actionIndex(): string
    {
        $stageModel = new Stage();
        $apartmentModel = new Apartment();
        $layoutModel = new Layout();
        $offers = new Offer();
        $galleries = Gallery::find()->active()->all();
        return $this->render('index', [
            'offers' => $offers, 
            'galleries' => $galleries, 
            'stage' => $stageModel->getStage(), 
            'apartmentModel' => $apartmentModel,
            'layoutModel' => $layoutModel,
        ]);
    }

    /**
     * Политика обработки персональных данных
     * @return string
     */
    public function actionPolicy(): string
    {
        return $this->render('policy');
    }

    /**
     * Страница Контакты
     * @return string
     */
    public function actionContact(): string
    {
        return $this->render('contact');
    }
}
