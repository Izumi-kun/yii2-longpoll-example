<?php

use app\models\ChangeMessageForm;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model ChangeMessageForm */

$this->title = 'Change message';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-change-message">

    <?php if (Yii::$app->session->hasFlash('messageChanged')): ?>
        <div class="alert alert-success">
            Message changed successfully! Look at the index page.
        </div>
    <?php endif ?>

    <?php $form = ActiveForm::begin() ?>

        <?= $form->field($model, 'message')->textInput(['autofocus' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'submit-button']) ?>
        </div>

    <?php ActiveForm::end() ?>

</div>
