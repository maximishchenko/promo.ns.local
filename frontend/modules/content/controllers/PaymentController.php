<?php

declare(strict_types=1);

namespace frontend\modules\content\controllers;


use frontend\controllers\BaseController;
use frontend\modules\content\models\Bank;
use frontend\modules\content\models\Mortgage;
use frontend\modules\content\models\Payment;
use yii\web\NotFoundHttpException;

class PaymentController extends BaseController
{
    public function actionIndex(): string
    {
        $payments = Payment::getDb()->cache(function() {
            return Payment::find()->active()->all();
        }, Payment::getCacheDuration(), Payment::getCacheDependency());
        return $this->render('index', [
            'banks' => $this->getBanks(),
            'payments' => $payments,
        ]);
    }

    public function actionMortgage(): string
    {
        $mortgages = Mortgage::getActiveMortgages();
        if ($mortgages) {
            return $this->render('mortgage', ['banks' => $this->getBanks(), 'mortgages' => $mortgages]);
        }
        throw new NotFoundHttpException("Запрошенная страница не найдена");
    }

    protected function getBanks()
    {
        $banks = Bank::getDb()->cache(function () {
            return Bank::find()->active()->all();
        }, Bank::getCacheDuration(), Bank::getCacheDependency());
        return $banks;
    }
}