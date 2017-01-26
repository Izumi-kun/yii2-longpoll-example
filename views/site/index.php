<?php

use app\models\ChangeMessageForm;
use izumi\longpoll\widgets\LongPoll;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model ChangeMessageForm */

$this->title = 'Long polling demo';

LongPoll::widget([
    'url' => ['polling'],
    'events' => ['newMessage'],
    'callback' => 'function(text){ $("#message").text(text); }',
]);
?>

<div class="site-index">

    <div class="jumbotron">
        <h1>Long polling demo</h1>

        <p id="message" class="lead"><?= Html::encode($model->message) ?></p>

        <p>
            <?= Html::a('Change message', ['/site/change-message'], ['class' => 'btn btn-lg btn-success', 'target' => '_blank']) ?>
        </p>
    </div>

</div>
