<?php

namespace backend\modules\content\controllers;

use backend\modules\content\models\search\StageItemSearch;
use backend\modules\content\models\Stage;
use backend\modules\content\models\search\StageSearch;
use backend\modules\content\models\StageItem;
use Yii;
use yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class StageController extends Controller
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
                        'delete-image' => ['POST'],
                        // 'set-default-item' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $searchModel = new StageSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionCreate()
    {
        $model = new Stage();

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

    public function actionDeleteImage(int $id)
    {
        $model = $this->findModel($id);
        $file = $model->getPath(Stage::UPLOAD_PATH, $model->image);
        $model->removeSingleFileIfExist($file);
        $model->image = null;
        $model->save();
        Yii::$app->session->setFlash('danger', Yii::t('app', 'Record deleted'));
        return $this->redirect(Yii::$app->request->referrer);
    }    

    public function actionItems($id)
    {
        $model = $this->findModel($id);
        $searchModel = new StageItemSearch();
        $dataProvider = $searchModel->search($id, $this->request->queryParams);

        return $this->render('stage_items/item_index', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreateItem($id)
    {
        $model = $this->findModel($id);
        $itemModel = new StageItem();
        $itemModel->stage_id = $id;

        if ($this->request->isPost) {
            if ($itemModel->load($this->request->post()) && $itemModel->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Record added'));
                return $this->redirect(['update-item', 'itemId' => $itemModel->id]);
            }
        } else {
            $itemModel->loadDefaultValues();
        }

        return $this->render('stage_items/item_create', [
            'model' => $model,
            'itemModel' => $itemModel,
        ]);
    }

    public function actionUpdateItem($itemId)
    {
        
        $itemModel = $this->findItemModel($itemId);

        if ($this->request->isPost && $itemModel->load($this->request->post()) && $itemModel->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Record changed'));
            return $this->refresh();
        }

        return $this->render('stage_items/item_update', [
            'itemModel' => $itemModel,
        ]);
    }

    public function actionDeleteItem($itemId)
    {
        $model = $this->findItemModel($itemId);
        $model->delete();
        Yii::$app->session->setFlash('danger', Yii::t('app', 'Record deleted'));

        return $this->redirect(['items', 'id' => $model->stage_id]);
    }

    public function actionSetDefaultItem($id)
    {
        $configManager = Yii::$app->get('configManager');
        $configManager->setItemValues(['contentMainStage' => $id]);
        $configManager->saveValues();
        Yii::$app->session->setFlash('success', Yii::t('app', 'Stage updated'));
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionClearStage()
    {
        $configManager = Yii::$app->get('configManager');
        $configManager->setItemValues(['contentMainStage' => ""]);
        $configManager->saveValues();
        Yii::$app->session->setFlash('warning', Yii::t('app', 'Stage disabled'));
        return $this->redirect(Yii::$app->request->referrer);
    }

    protected function findModel($id)
    {
        if (($model = Stage::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    protected function findItemModel($itemId)
    {
        if (($model = StageItem::findOne(['id' => $itemId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
