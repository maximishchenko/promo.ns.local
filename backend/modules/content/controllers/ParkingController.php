<?php

namespace backend\modules\content\controllers;

use backend\modules\content\models\Parking;
use backend\modules\content\models\search\ParkingSearch;
use backend\modules\content\controllers\PremiseController;
use backend\modules\content\models\Premise;
use backend\modules\content\models\search\PremiseSearch;
use yii\web\NotFoundHttpException;
use Yii;

class ParkingController extends PremiseController
{
    public function actionIndex()
    {
        $model = new Parking();
        $query = Parking::find();
        $searchModel = new PremiseSearch();
        $dataProvider = $searchModel->search($query, $this->request->queryParams);

        return $this->render('index', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Parking();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Record added'));
                return $this->redirect(['update', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    protected function findModel($id): Premise
    {
        if (($model = Parking::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
