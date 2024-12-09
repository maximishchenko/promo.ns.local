<?php
declare(strict_types=1);

namespace frontend\modules\content\controllers;

use frontend\modules\content\models\Lead;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;

class LeadController extends Controller
{

    /**
     * @return array[]
     */
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'feedback' => ['post'],
                ],
            ],
        ];
    }

    public function actionFeedback()
    {
        $lead = new Lead();
        if (Yii::$app->request->isAjax) {
            if ($lead->load($this->request->post()) && $lead->save()) {
                echo "success";
            } else {
                foreach ($lead->getErrors() as $key => $value) {
                  echo $key.': '.$value[0];
                    Yii::debug($key.': '.$value[0]);
                }
                echo "error";
            }
        }
        else {
            echo "not ajax request";
        }
        exit(1);
    }
}