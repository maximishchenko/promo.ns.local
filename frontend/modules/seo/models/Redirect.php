<?php

namespace frontend\modules\seo\models;

use Yii;
use backend\modules\seo\models\Redirect as backendRedirect;
use common\models\Status;

/**
 * Устанавливает редирект, при наличии соответствующей записи в БД
 *
 * Class Redirects
 * @package common\components
 */
class Redirect extends backendRedirect
{
    /**
     * Устанавливает значение редиректа в соотвтествии с полученным кодом http-состояния
     */
    public static function getRedirect()
    {
        $redirect = self::find()
            ->select(['source_url', 'destination_url', 'redirect_code', 'status'])
            ->where([
                'status' => Status::STATUS_ACTIVE,
                'source_url' => parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
            ])
            ->one();
            
        if (isset($redirect) && !empty($redirect)) {
            $headers = Yii::$app->getResponse()->getHeaders();
            $headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
            $headers->set('Expires', 'Sat, 26 Jul 1997 05:00:00 GMT');
            $dst = Yii::$app->request->hostInfo . $redirect->destination_url;
            if ($redirect->redirect_code == static::CODE_302) {
                Yii::$app->response->redirect($dst)->send();
            } else {
                Yii::$app->response->redirect($dst, static::CODE_301)->send();
            }
            Yii::$app->end();
        }
    }
}