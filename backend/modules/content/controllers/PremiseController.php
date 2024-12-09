<?php

declare(strict_types=1);

namespace backend\modules\content\controllers;

use backend\modules\content\models\Premise;
use backend\modules\content\models\PremiseAdvantage;
use backend\modules\content\models\search\PremiseAdvantageSearch;
use ValueError;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class PremiseController extends Controller
{
    
    public function behaviors(): array
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

    public function actionUpdate(int $id): Response | string
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

    public function actionDelete(int $id): Response
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('danger', Yii::t('app', 'Record deleted'));

        return $this->redirect(['index']);
    }

    public function actionAdvantages(int $id): string
    {
        $model = $this->findModel($id);
        $searchModel = new PremiseAdvantageSearch();
        $dataProvider = $searchModel->search($id, $this->request->queryParams);

        return $this->render('//layouts/content/premise/index_advantage', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreateAdvantage(int $id): Response | string
    {
        $model = $this->findModel($id);
        $advantageModel = new PremiseAdvantage();
        $advantageModel->premise_id = $id;

        if ($this->request->isPost) {
            if ($advantageModel->load($this->request->post()) && $advantageModel->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Record added'));
                return $this->redirect(['update-advantage', 'advantageId' => $advantageModel->id]);
            }
        } else {
            $advantageModel->loadDefaultValues();
        }

        return $this->render('//layouts/content/premise/create_advantage', [
            'model' => $model,
            'advantageModel' => $advantageModel,
        ]);
    }

    public function actionUpdateAdvantage(int $advantageId): Response | string
    {
        
        $advantageModel = $this->findPremiseAdvantageModel($advantageId);
        $model = Premise::find()->where(['id' => $advantageModel->premise_id])->one();

        if ($this->request->isPost && $advantageModel->load($this->request->post()) && $advantageModel->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Record changed'));
            return $this->refresh();
        }

        return $this->render('//layouts/content/premise/update_advantage', [
            'model' => $model,
            'advantageModel' => $advantageModel,
        ]);
    }

    public function actionDeleteAdvantage(int $advantageId): Response
    {
        $model = $this->findPremiseAdvantageModel($advantageId);
        $model->delete();
        Yii::$app->session->setFlash('danger', Yii::t('app', 'Record deleted'));

        return $this->redirect(['advantages', 'id' => $model->premise_id]);
    }

    public function actionDeleteImage(int $id): Response
    {
        $model = $this->findModel($id);
        $file = $model->getPath(Premise::UPLOAD_PATH, $model->image);
        $model->removeSingleFileIfExist($file);
        $model->image = null;
        $model->save();
        Yii::$app->session->setFlash('danger', Yii::t('app', 'Record deleted'));
        return $this->redirect(Yii::$app->request->referrer);
    }  

    public function actionDeleteLayoutImage(int $id): Response
    {
        $model = $this->findModel($id);
        $file = $model->getPath(Premise::UPLOAD_PATH, $model->layout_image);
        $model->removeSingleFileIfExist($file);
        $model->layout_image = null;
        $model->save();
        Yii::$app->session->setFlash('danger', Yii::t('app', 'Record deleted'));
        return $this->redirect(Yii::$app->request->referrer);
    }  

    public function actionSetDefaultItem(int $id, string $settingType): Response
    {
        $this->validateSettingType($settingType);
        $configManager = Yii::$app->get('configManager');
        $configManager->setItemValues([$settingType => $id]);
        $configManager->saveValues();
        Yii::$app->session->setFlash('success', Yii::t('app', 'Record updated'));
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionClearStage(string $settingType): Response
    {
        $this->validateSettingType($settingType);
        $configManager = Yii::$app->get('configManager');
        $configManager->setItemValues([$settingType => ""]);
        $configManager->saveValues();
        Yii::$app->session->setFlash('warning', Yii::t('app', 'Record disabled'));
        return $this->redirect(Yii::$app->request->referrer);
    }

    protected function validateSettingType(string $settingType): void
    {
        if (!in_array($settingType, array_values(Premise::getSettingsNamesArray()))) {
            throw new ValueError(Yii::t('app', 'Incorrect config parameter name'));
        }
    }

    protected function findModel(int $id): Premise
    {
        throw new MethodNotAllowedHttpException(Yii::t('app', 'You must implement this method inside child classes'));
    }

    protected function findPremiseAdvantageModel(int $advantageId)
    {
        if (($model = PremiseAdvantage::findOne(['id' => $advantageId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}