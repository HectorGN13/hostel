<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Room */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="room-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'floor')->textInput() ?>

    <?= $form->field($model, 'room_number')->textInput() ?>

    <?= $form->field($model, 'has_conditioner')->checkbox() ?>

    <?= $form->field($model, 'has_tv')->checkbox() ?>

    <?= $form->field($model, 'has_phone')->checkbox() ?>

    <?= $form->field($model, 'available_from')->textInput() ?>

    <?= $form->field($model, 'price_per_night')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
