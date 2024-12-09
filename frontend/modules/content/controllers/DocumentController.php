<?php
declare(strict_types=1);

namespace frontend\modules\content\controllers;

use common\models\Status;
use frontend\controllers\BaseController;
use frontend\modules\content\models\DocumentCategory;
use yii\web\NotFoundHttpException;

class DocumentController extends BaseController
{
    public function actionIndex(): string
    {
        $activeCategories = DocumentCategory::getActiveCategories();
        if ($activeCategories) {
            return $this->render('index', [
                'categories' => $activeCategories,
            ]);
        }
        throw new NotFoundHttpException("Запрошенная страница не найдена");
    }
}