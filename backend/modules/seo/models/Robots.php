<?php
declare(strict_types=1);

namespace backend\modules\seo\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Robots extends Model
{

    public $filecontent;
    public $filename = '@frontend/web/robots.txt';


    public function rules(): array
    {
        return [
            [['filecontent'], 'required'],
            ['filecontent', 'string'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'filecontent' => Yii::t('app', 'ROBOTSCONTENT'),
        ];
    }

    public function createRobotsFile(): void
    {
        if(!file_exists(Yii::getAlias($this->filename)) || !is_file(Yii::getAlias($this->filename))) {
            $content = 'User-agent: *';
            $fp = fopen(Yii::getAlias($this->filename),"wb");
            fwrite($fp,$content);
            fclose($fp);
        }
    }

    public function RobotsReadFile(): string
    {
        $filename = Yii::getAlias($this->filename);
        return file_get_contents($filename);
    }

    public function RobotsWriteFile(): void
    {
        $filename = Yii::getAlias($this->filename);
        $fp = fopen($filename, 'w');
        fwrite($fp, $this->filecontent);
        fclose($fp);
    }

}
