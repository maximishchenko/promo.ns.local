<?php

namespace frontend\modules\seo\models;

use backend\modules\seo\models\Script as backendScript;
use frontend\modules\seo\models\query\ScriptQuery;
use yii\web\View;
use Yii;
use yii\db\ActiveQuery;

class Script extends backendScript
{
    /**
     * {@inheritdoc}
     * @return ScriptQuery the active query used by this AR class.
     */
    public static function find(): ScriptQuery
    {
        return new ScriptQuery(get_called_class());
    } 

    public static function getScripts($position)
    {
        // View::POS_HEAD, View::POS_BEGIN, View::POS_END
        if (in_array($position, array_keys(self::getScriptPositionsArray()))) {
            switch($position) {
                case self::BEFORE_END_HEAD:
                    $scripts = self::find()->beforeEndHead()->active()->all();
                    // $position = View::POS_HEAD;
                    break;
                case self::AFTER_BEGIN_BODY:
                    $scripts = self::find()->afterBeginBody()->active()->all();
                    // $position = View::POS_BEGIN;
                    break;
                case self::BEFORE_END_BODY:
                    $scripts = self::find()->beforeEndBody()->active()->all();
                    // $position = View::POS_END;
                    break;
            }

            foreach ($scripts as $script) {
                // $js = <<< JS
                // $script->code;
                // JS;
                // \Yii::$app->view->registerJs($js, $position);
                
                echo $script->code;
            }
        }
    }
}