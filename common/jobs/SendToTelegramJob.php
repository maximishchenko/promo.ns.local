<?php

namespace common\jobs;

use Yii;
use yii\base\BaseObject;

/**
 * Отправляет текстовое сообщение в Telegram-чат
 */
class SendToTelegramJob extends BaseObject implements \yii\queue\JobInterface
{
    public $chat_ids;
    public $message;

    public function execute($queue)
    {
        foreach ($this->chat_ids as $chat) {
            $chat = str_replace(' ', '', $chat);
            try {
                Yii::$app->telegram->sendMessage([
                    'chat_id' => $chat,
                    'text' => $this->message,
                ]);
            } catch (\Exception $e) {
                Yii::error($e->getMessage());
            }
        }
    }
}