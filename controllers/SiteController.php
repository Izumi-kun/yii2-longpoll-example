<?php

namespace app\controllers;

use app\models\ChangeMessageForm;
use izumi\longpoll\Server;
use Yii;
use yii\web\Controller;

class SiteController extends Controller
{

    public function actions()
    {
        return [
            'polling' => [
                'class' => 'izumi\longpoll\LongPollAction',
                'events' => ['newMessage'],
                'callback' => [$this, 'longPollCallback'],
            ],
        ];
    }

    public function longPollCallback(Server $server)
    {
        $server->responseData = Yii::$app->cache->get('message');
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new ChangeMessageForm();
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionChangeMessage()
    {
        $model = new ChangeMessageForm();
        if ($model->load(Yii::$app->request->post()) && $model->saveMessage()) {
            Yii::$app->session->setFlash('messageChanged');

            return $this->refresh();
        }
        return $this->render('changeMessage', [
            'model' => $model,
        ]);
    }
}
