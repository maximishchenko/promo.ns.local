<?php

declare(strict_types=1);

namespace frontend\controllers;

use common\models\Status;
use frontend\components\InlineWidgetsBehavior;
use frontend\modules\seo\models\Redirect;
use Yii;
use yii\base\ExitException;
use yii\base\InvalidRouteException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;

class BaseController extends Controller
{
    
    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function behaviors()
    {
        return [
            'InlineWidgetsBehavior' => [
                'class' => InlineWidgetsBehavior::className(),
                'widgets' => \Yii::$app->params['runtimeWidgets'],
                'classSuffix' => 'Widget',
             ],
        ];
    }

    /**
     * @return void
     */
    public function init(): void
    {
        parent::init();
        \Yii::$app->errorHandler->errorAction = 'error/index';
    }

    /**
     * @param $action
     * @return bool
     */
    public function beforeAction($action): bool
    {
        $this->setUrlRedirect();
        return parent::beforeAction($action);
    }

    /**
     * @param $param
     * @return void
     */
    protected function processPageRequest(string $param='page'): void
    {
        if (Yii::$app->request->isAjax && isset($_POST[$param])) {
            $_GET[$param] = Yii::$app->request->post($param);
        }
    }

    protected function setUrlRedirect()
    {
        $redirect = Redirect::find()
            ->select(['source_url', 'destination_url', 'redirect_code', 'status'])
            ->where([
                'status' => Status::STATUS_ACTIVE,
                'source_url' => parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
            ])
            ->one();
            
        if (!empty($redirect)) {
            $headers = Yii::$app->getResponse()->getHeaders();
            $headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
            $headers->set('Expires', 'Sat, 26 Jul 1997 05:00:00 GMT');
            $dst = Yii::$app->request->hostInfo . $redirect->destination_url;
            if ($redirect->redirect_code == Redirect::CODE_302) {
                return Yii::$app->response->redirect($dst)->send();
            } else {
                return Yii::$app->response->redirect($dst, Redirect::CODE_301)->send();
            }
            Yii::$app->end();
        }
    }
}