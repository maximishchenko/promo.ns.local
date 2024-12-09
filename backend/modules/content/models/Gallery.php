<?php

declare(strict_types=1);

namespace backend\modules\content\models;

use backend\modules\catalog\models\House;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use backend\modules\content\models\query\GalleryQuery;
use common\models\Sort;
use common\models\Status;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%gallery}}".
 *
 * @property int $id
 * @property string $name
 * @property string $period
 * @property string|null $comment
 * @property int|null $sort
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property-read \yii\db\ActiveQuery $uploads
 * @property GalleryUpload[] $galleryUploads
 */
class Gallery extends \yii\db\ActiveRecord
{
    public $files;

    public $period;

    public static function tableName(): string
    {
        return '{{%gallery}}';
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
            [['name', 'period'], 'required'],
            [['comment'], 'string'],
            [['house_id', 'sort', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'period'], 'string', 'max' => 255],

            [['name'], 'required'],
            [['name'], 'unique'],
            
            ['sort', 'default', 'value' => Sort::DEFAULT_SORT_VALUE],
            ['status', 'in', 'range' => array_keys(Status::getStatusesArray())],
            [['files'], 'safe'],
        ];
    }

    public function getHousesItems(): array
    {
        $houses = House::find()->orderBy(['name' => SORT_ASC])->all();
        return ArrayHelper::map($houses,'id','nameWithPrefix');
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'period' => Yii::t('app', 'Gallery Period'),
            'house_id' => Yii::t('app', 'Gallery House ID'),
            'comment' => Yii::t('app', 'Comment'),
            'files' => Yii::t('app', 'Gallery Files'),
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
        return [];
    }

    public function getUploads(): ActiveQuery
    {
        return $this->hasMany(GalleryUpload::class, ['gallery_id' => 'id'])->orderBy([GalleryUpload::tableName().'.sort' => SORT_ASC]);
    }

    public static function find(): GalleryQuery
    {
        return new GalleryQuery(get_called_class());
    }

    public function afterSave($insert, $changedAttributes): void
    {
        $this->setImageAttributes();
        parent::afterSave($insert, $changedAttributes);
    }
    
    private function setImageAttributes(): void
    {
        $this->files = UploadedFile::getInstances($this, 'files');
        if(isset($this->files) && !empty($this->files))
        {
            foreach ($this->files as $key=>$file) {
                $uploadsModel = new GalleryUpload();
                $uploadsModel->file = $file;
                $uploadsModel->gallery_id = $this->id;
                $uploadsModel->sort = $key;
                $uploadsModel->save();
                if ($uploadsModel->hasErrors()) {
                    foreach($uploadsModel->getErrors() as $error) {
                        Yii::debug($error);
                    }
                }
            }
        }
    }

    public function afterFind()
    {
        if ($this->period_month && $this->period_year) {
            $this->period = $this->period_month . "." . $this->period_year;
        }
        parent::afterFind();
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $period = explode(".", $this->period);
            $this->period_month = $period[0];
            $this->period_year = $period[1];
            return true;
        }
        return false;
    }
}
