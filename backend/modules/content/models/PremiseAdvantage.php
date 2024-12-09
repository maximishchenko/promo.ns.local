<?php

declare(strict_types=1);

namespace backend\modules\content\models;

use backend\modules\content\models\query\PremiseAdvantageQuery;
use backend\traits\fileTrait;
use common\models\Sort;
use common\models\Status;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%premise_advantage}}".
 *
 * @property int $id
 * @property int $premise_id
 * @property string $name
 * @property string|null $text
 * @property string|null $comment
 * @property int|null $sort
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Premise $premise
 */
class PremiseAdvantage extends ActiveRecord
{
    use fileTrait;

    const UPLOAD_PATH = 'upload/premise_advantage/';

    public $imageFile;
    
    public static function tableName(): string
    {
        return '{{%premise_advantage}}';
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
            [['premise_id', 'name'], 'required'],
            [['premise_id', 'sort', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['text', 'comment'], 'string'],
            [['name'], 'string', 'max' => 255],
            // [['premise_id'], 'exist', 'skipOnError' => true, 'targetClass' => Premise::class, 'targetAttribute' => ['premise_id' => 'id']],
            ['sort', 'default', 'value' => Sort::DEFAULT_SORT_VALUE],
            ['status', 'in', 'range' => array_keys(Status::getStatusesArray())],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'premise_id' => Yii::t('app', 'Premise ID'),
            'name' => Yii::t('app', 'Name'),
            'text' => Yii::t('app', 'Advantage Text'),
            'comment' => Yii::t('app', 'Comment'),
            'sort' => Yii::t('app', 'Sort'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    public function getPremise(): ActiveQuery
    {
        return $this->hasOne(Premise::class, ['id' => 'premise_id']);
    }

    public static function find(): PremiseAdvantageQuery
    {
        return new PremiseAdvantageQuery(get_called_class());
    }

    public function beforeSave($insert): bool
    {
        if (parent::beforeSave($insert)) {
            $this->uploadFile('imageFile', 'image', self::UPLOAD_PATH);
            return true;
        }
        return false;
    }

    public function beforeDelete(): bool
    {
        if (parent::beforeDelete()) {
            $this->deleteSingleFile('image', self::UPLOAD_PATH);
            return true;
        } else {
            return false;
        }
    }
}
