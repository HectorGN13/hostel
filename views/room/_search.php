<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RoomSearch */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="room-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?php $form->field($model, 'id') ?>

    <?= $form->field($model, 'floor') ?>

    <?= $form->field($model, 'room_number') ?>

    <?= $form->field($model, 'has_conditioner')->checkbox() ?>

    <?= $form->field($model, 'has_tv')->checkbox() ?>

    <?= $form->field($model, 'has_phone')->checkbox() ?>

    <?= $form->field($model, 'available_from') ?>

    <?= $form->field($model, 'price_per_night') ?>


    <?php // echo $form->field($model, 'has_phone')->checkbox() ?>

    <?php // echo $form->field($model, 'available_from') ?>

    <?php // echo $form->field($model, 'price_per_night') ?>

    <?php // echo $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
