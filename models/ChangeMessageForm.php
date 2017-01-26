<?php

namespace app\models;

use izumi\longpoll\Event;
use Yii;
use yii\base\Model;

/**
 * Class ChangeMessageForm
 * @author Viktor Khokhryakov <viktor.khokhryakov@gmail.com>
 */
class ChangeMessageForm extends Model
{
    /**
     * @var string
     */
    public $message;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->message = Yii::$app->cache->get('message') ?: 'Try change this message!';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['message', 'required'],
            ['message', 'string', 'min' => 3, 'max' => 64],
        ];
    }

    /**
     * @return bool
     */
    public function saveMessage()
    {
        if ($this->validate()) {
            return Yii::$app->cache->set('message', $this->message) && Event::triggerByKey('newMessage') !== null;
        }
        return false;
    }

}
