<?php

use yii\bootstrap4\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RoomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Habitaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Habitación', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'room_number',
            [
                'attribute' => 'floor',
                'format' => ['spellout', '%spellout-ordinal-feminine'],
            ],
            'has_conditioner:boolean',
            'has_tv:boolean',
            'has_phone:boolean',
            [
                'attribute' => 'available_from',
                'format' => ['date', "d 'de' MMMM, yyyy"],
            ],
            [
                'attribute' => 'price_per_night',
                'format' => ['Currency', 'EUR'],
            ],
            //'description:ntext',
            [
                //'attribute' => 'Disponible',
                'format' => 'boolean',
                'label' => 'Disponible',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
