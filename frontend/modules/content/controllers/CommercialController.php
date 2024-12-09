<?php
declare(strict_types=1);

namespace frontend\modules\content\controllers;

use frontend\controllers\BaseController;
use frontend\modules\content\models\Premise;
use Yii;
use yii\web\NotFoundHttpException;

class CommercialController extends BaseController
{
    public function actionIndex(): string
    {
        $activeItemId = Yii::$app->configManager->getItemValue('contentCommercialStage');

        $activeItem = Premise::getCommercialActiveItem($activeItemId);
        $stages = Premise::getCommercialStages($activeItemId);
        if ($activeItem || $stages) {
            return $this->render('index', ['activeItem' => $activeItem, 'stages' => $stages]);
        }
        throw new NotFoundHttpException("Запрошенная страница не найдена");
    }
}