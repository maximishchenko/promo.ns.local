<?php

namespace backend\modules\management\models;

use backend\modules\management\models\query\UserQuery;
use common\models\User as commonUser;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 * @property string|null $name
 * @property string|null $surname
 */
class User extends commonUser
{

    public $newPassword;

    public $repeatPassword;
    
    const SCENARIO_ADMIN_CREATE = 'adminCreate';
    const SCENARIO_ADMIN_UPDATE = 'adminUpdate';
    const SCENARIO_CONSOLE_CREATE = 'consoleCreate';
    const SCENARIO_CONSOLE_UPDATE = 'consoleUpdate';
    
    const SCENARIO_PROFILE = 'profile';
    
    public function behaviors()
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
        ];
    }  

    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * Возвращает массив статусов пользователей
     *
     * @return array
     */
    public static function getStatusesArray(): array
    {
        return [
            static::STATUS_ACTIVE => Yii::t('app', 'Status Active'),
            static::STATUS_INACTIVE => Yii::t('app', 'Status Blocked'),
        ];
    }

    /**
     * Возвращает массив статусов сотрудников, имеющих доступ в панель управления
     *
     * @return array
     */
    public static function getEmployeesStatusesArray(): array
    {
        return [
            static::STATUS_ACTIVE => Yii::t('app', 'STATUS_ACTIVE'),
            static::STATUS_INACTIVE => Yii::t('app', 'STATUS_BLOCKED'),
        ];
    } 

    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    public function getFullName()
    {
        return (!empty($this->name) && !empty($this->surname)) ? $this->name . " " . $this->surname : $this->username; 
    }

    public function rules()
    {
        return [
            [['username', 'email', 'name', 'surname'], 'required'],
            [['username', 'email'], 'unique'],
            [['email'], 'email'],
            [['fullName'], 'safe'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE, 'on' => self::SCENARIO_ADMIN_CREATE],
            ['status', 'in', 'range' => array_keys(self::getStatusesArray())],

            [['newPassword', 'repeatPassword'], 'required', 'on' => self::SCENARIO_ADMIN_CREATE],
            ['newPassword', 'string', 'min' => 6],
            ['repeatPassword', 'compare', 'compareAttribute' => 'newPassword'],
        ];
    }
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_ADMIN_CREATE] = ['username', 'email', 'status', 'newPassword', 'newPasswordRepeat', 'name', 'surname'];

        $scenarios[self::SCENARIO_ADMIN_UPDATE] = ['username', 'email', 'status', 'newPassword', 'repeatPassword', 'name', 'surname'];
        
        $scenarios[self::SCENARIO_CONSOLE_CREATE] = ['username', 'email'];
        
        $scenarios[self::SCENARIO_CONSOLE_UPDATE] = ['username', 'email'];

        return $scenarios;
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'name' => Yii::t('app', 'User Name'),
            'surname' => Yii::t('app', 'User Surname'),
            'newPassword' => Yii::t('app', 'New Password'),
            'repeatPassword' => Yii::t('app', 'Repeat Password'),
            'fullName' => Yii::t('app', 'Full Name'),
            'company' => Yii::t('app', 'Client Company'),
            'phone' => Yii::t('app', 'Client Phone'),
            'city' => Yii::t('app', 'Client City'),
            'bussiness_region_id' => Yii::t('app', 'Client Bussiness Region'),
            'created_at' => Yii::t('app', 'Client Registration Date'),
            'updated_at' => Yii::t('app', 'Client Last Update Date'),
            'is_personal_data_agreement' => Yii::t('app', 'Client Personal Data Agreement'),
            'is_adv_agreement' => Yii::t('app', 'Client Adv Agreement'),
        ];
    }
    
    public function beforeSave($insert)
    {
        $this->generateAuthKey();
        $this->setPassword($this->newPassword);
        return parent::beforeSave($insert);
    }
}
