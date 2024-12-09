<?php

namespace common\jobs;

use Yii;
use yii\base\BaseObject;

/**
 * Отправляет текстовое сообщение в Telegram-чат
 */
class SendToEmailJob extends BaseObject implements \yii\queue\JobInterface
{
    public $emails;
    public $body;
    public $subject;

    public function execute($queue)
    {
        try {
            foreach ($this->emails as $email) {
                $email = str_replace(' ', '', $email);

                Yii::$app->mailer->compose()
                    ->setTextBody($this->body)
                    ->setFrom(Yii::$app->params['senderEmail'])
                    ->setTo($email)
                    ->setSubject($this->subject)
                    ->send();
            }

        } catch (\Exception $e) {
            print($e->getMessage());
            Yii::error($e->getMessage());
        }
    }
}