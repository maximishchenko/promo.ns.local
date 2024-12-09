<?php

namespace frontend\controllers;

use Yii;
use frontend\controllers\BaseController;

class ErrorController extends BaseController
{

    /**
     * @return string|null
     */
    public function actionIndex(): ?string
    {
        $error = Yii::$app->response->statusCode;
        if ($error === 404) {
            return $this->render('page-not-found');
        }
        return null;
    }

    public function actionPageNotFound(): string
    {
        return $this->render('page-not-found');
    }

}
