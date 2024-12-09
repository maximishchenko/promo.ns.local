<?php
declare(strict_types=1);

namespace backend\modules\seo\models;

use backend\modules\seo\models\query\RedirectQuery;
use common\models\Sort;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "redirect".
 *
 * @property int $id
 * @property string|null $source_url
 * @property string|null $destination_url
 * @property int|null $redirect_code
 * @property string|null $comment
 * @property int|null $sort
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class Redirect extends \yii\db\ActiveRecord
{

    const CODE_301 = 301;
    const CODE_302 = 302;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%redirect}}';
    }

    /**
     * Возвращает массив кодов перенаправления
     *
     * @return array
     */
    public static function getRedirectCodeArray(): array
    {
        return [
            static::CODE_301 => 301,
            static::CODE_302 => 302,
        ];
    }
    

    public function behaviors(): array
    {
        return[
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => function () {
                    return date('U');
                },
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }  


    public function rules(): array
    {
        return [
            [['redirect_code', 'sort', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['comment'], 'string'],
            [['source_url', 'destination_url'], 'string', 'max' => 255],

            [['source_url', 'destination_url'], 'required'],
            [['source_url'], 'unique'],

            ['redirect_code', 'in', 'range' => array_keys(self::getRedirectCodeArray())],
            ['redirect_code', 'default', 'value' => self::CODE_301],
            ['sort', 'default', 'value' => Sort::DEFAULT_SORT_VALUE],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'source_url' => Yii::t('app', 'Source Url'),
            'destination_url' => Yii::t('app', 'Destination Url'),
            'redirect_code' => Yii::t('app', 'Redirect Code'),
            'comment' => Yii::t('app', 'Comment'),
            'sort' => Yii::t('app', 'Sort'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }


    public static function find(): RedirectQuery
    {
        return new RedirectQuery(get_called_class());
    } 
}
