<?php

namespace backend\modules\catalog\controllers;

use backend\modules\catalog\models\Apartment;
use backend\modules\catalog\models\Entrance;
use backend\modules\catalog\models\Layout;
use backend\modules\catalog\models\search\ApartmentSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

class ApartmentController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $searchModel = new ApartmentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Apartment();

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

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Record changed'));
            return $this->refresh();
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('danger', Yii::t('app', 'Record deleted'));

        return $this->redirect(['index']);
    }
    

    public function actionDeleteImage(int $id): Response
    {
        $model = $this->findModel($id);
        $file = $model->getPath(Apartment::UPLOAD_PATH, $model->image);
        echo $file;
        $model->removeSingleFileIfExist($file);
        $model->image = null;
        $model->save();
        Yii::$app->session->setFlash('danger', Yii::t('app', 'Record deleted'));
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionFloorList($id)
    {
        $layout = Layout::find()->where(['id' => $id])->one();

        echo "<option value=''>-</option>";
        if($layout){
            for ($i = $layout->entrance->getFirstFloorNumber(); $i <= $layout->entrance->count_floors; $i++) {
                echo "<option value='". $i ."'>" . $i . "</option>";
            }
        }

    }

    protected function findModel($id)
    {
        if (($model = Apartment::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
