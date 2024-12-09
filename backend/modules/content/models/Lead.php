<?php

declare(strict_types=1);

namespace backend\modules\content\models;

use backend\modules\content\models\query\LeadQuery;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%lead}}".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $subject
 * @property string|null $body
 * @property int|null $created_at
 */
class Lead extends \yii\db\ActiveRecord
{
    const FEEDBACK_CONTACT_FORM_SUBJECT = 'Сообщение формы обратной связи';
    
    public static function tableName(): string
    {
        return '{{%lead}}';
    }

    public function rules(): array
    {
        return [
            [['body'], 'string'],
            [['created_at'], 'integer'],
            [['name', 'phone', 'email', 'subject'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Lead Name'),
            'phone' => Yii::t('app', 'Lead Phone'),
            'email' => Yii::t('app', 'Lead Email'),
            'subject' => Yii::t('app', 'Lead Subject'),
            'body' => Yii::t('app', 'Lead Body'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    public static function find(): LeadQuery
    {
        return new LeadQuery(get_called_class());
    }
}
