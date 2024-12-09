<?php

namespace backend\modules\content\controllers;

use backend\modules\content\models\Document;
use backend\modules\content\models\DocumentCategory;
use backend\modules\content\models\search\DocumentCategorySearch;
use backend\modules\content\models\search\DocumentSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class DocumentController extends Controller
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
        $searchModel = new DocumentCategorySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new DocumentCategory();

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
      

    public function actionDocuments($id)
    {
        $model = $this->findModel($id);
        $searchModel = new DocumentSearch();
        $dataProvider = $searchModel->search($id, $this->request->queryParams);

        return $this->render('document/index', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreateDocument($id)
    {
        $model = $this->findModel($id);
        $documentModel = new Document();
        $documentModel->category_id = $id;

        if ($this->request->isPost) {
            if ($documentModel->load($this->request->post()) && $documentModel->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Record added'));
                return $this->redirect(['update-document', 'documentId' => $documentModel->id]);
            }
        } else {
            $documentModel->loadDefaultValues();
        }

        return $this->render('document/create', [
            'model' => $model,
            'documentModel' => $documentModel,
        ]);
    }

    public function actionUpdateDocument($documentId)
    {
        
        $documentModel = $this->findDocumentModel($documentId);

        if ($this->request->isPost && $documentModel->load($this->request->post()) && $documentModel->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Record changed'));
            return $this->refresh();
        }

        return $this->render('document/update', [
            'documentModel' => $documentModel,
        ]);
    }

    public function actionDeleteDocument($documentId)
    {
        $model = $this->findDocumentModel($documentId);
        $model->delete();
        Yii::$app->session->setFlash('danger', Yii::t('app', 'Record deleted'));

        return $this->redirect(['documents', 'id' => $model->category_id]);
    }

    protected function findModel($id)
    {
        if (($model = DocumentCategory::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    protected function findDocumentModel($documentId)
    {
        if (($model = Document::findOne(['id' => $documentId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
