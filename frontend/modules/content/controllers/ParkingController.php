<?php
declare(strict_types=1);

namespace frontend\modules\content\controllers;

use frontend\controllers\BaseController;
use frontend\modules\content\models\Premise;
use Yii;
use yii\web\NotFoundHttpException;

class ParkingController extends BaseController
{
    public function actionIndex(): string
    {
        $activeItemId = Yii::$app->configManager->getItemValue('contentParkingStage');
        
        $activeItem = Premise::getParkingActiveItem($activeItemId);
        $stages = Premise::getParkingStages($activeItemId);
        if ($activeItem || $stages) {
            return $this->render('index', ['activeItem' => $activeItem, 'stages' => $stages]);
        }
        throw new NotFoundHttpException("Запрошенная страница не найдена");
    }
}