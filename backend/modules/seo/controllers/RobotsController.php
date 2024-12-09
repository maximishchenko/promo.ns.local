<?php

namespace backend\modules\seo\controllers;
use backend\modules\seo\models\Robots;
use Yii;

class RobotsController extends \yii\web\Controller
{

    public function actionIndex()
    {
        $model = new Robots();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->RobotsWriteFile();
            Yii::$app->session->setFlash('success', Yii::t('app', 'Record changed'));
            return $this->refresh();
        } else {
            $model->createRobotsFile();
            $model->filecontent = $model->RobotsReadFile();
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }

}