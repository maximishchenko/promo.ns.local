<?php

declare(strict_types=1);

namespace backend\modules\content\models;

use backend\modules\content\models\query\StageItemQuery;
use common\components\StagePosition;
use common\models\Sort;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "{{%stage_item}}".
 *
 * @property int $id
 * @property int|null $stage_id
 * @property string|null $name
 * @property string|null $comment
 * @property int|null $sort
 * @property int|null $status
 * @property string|null $position
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Stage $stage
 */
class StageItem extends \yii\db\ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%stage_item}}';
    }

    public function rules(): array
    {
        return [
            [['stage_id', 'sort', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['comment'], 'string'],
            [['name', 'position'], 'string', 'max' => 255],
            [['stage_id'], 'exist', 'skipOnError' => true, 'targetClass' => Stage::class, 'targetAttribute' => ['stage_id' => 'id']],
            ['position', 'default', 'value' => StagePosition::POSITION_ROUND],
            ['position', 'in', 'range' => array_keys(StagePosition::getStagePositionsArray())],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'stage_id' => Yii::t('app', 'Stage ID'),
            'name' => Yii::t('app', 'Stage Item Name'),
            'position' => Yii::t('app', 'Stage Item Position'),
            'comment' => Yii::t('app', 'Comment'),
            'sort' => Yii::t('app', 'Sort'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    public function attributeHints(): array
    {
        return [
            'name' => Yii::t('app', 'Stage Name Hint'),
            'comment' => Yii::t('app', 'Comment Hint'),
            'sort' => Yii::t('app', 'Sort Hint. Default value is {sortDefault}', ['sortDefault' => Sort::DEFAULT_SORT_VALUE]),
            'status' => Yii::t('app', 'Status Hint'),
        ];
    }

    public function getStage(): ActiveQuery
    {
        return $this->hasOne(Stage::class, ['id' => 'stage_id']);
    }

    public static function find(): StageItemQuery
    {
        return new StageItemQuery(get_called_class());
    }
}
