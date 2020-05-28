<?php
use yii\helpers\Url;

$operators = [ '=', '<=', '>=' ];

$sf = $searchFilter;

?>

<form method="post" action="<?php echo Url::to(['rooms/index-filtered']) ?>">
    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
      <div class="row">
        <?php $operator = $sf['floor']['operator']; ?>
        <?php $value = $sf['floor']['value']; ?>

            <div class="col-md-3"><label>Planta</label>
            <br/>
            <select name="SearchFilter[floor][operator]">
                <?php foreach ($operators as $op) { ?>
                    <?php $selected = ($operator == $op) ? 'selected' : ''; ?>
                    <option value="<?=$op?>" <?=$selected?>><?=$op?></option>
                <?php } ?>=
            </select>

            <input type="text" name="SearchFilter[floor][value]" value="<?=$value?>" />
            </div>

        <?php $operator = $sf['room_number']['operator']; ?>
        <?php $value = $sf['room_number']['value']; ?>

            <div class="col-md-3"><label>Numero de Habitacion</label>
            <br/>
            <select name="SearchFilter[room_number][operator]">
                <?php foreach ($operators as $op) { ?> 
                    <?php $selected = ($operator == $op) ? 'selected:' : ''; ?>
                    <option value="<?=$op?>" <?=$selected?>><?=$op?></option>
                <?php } ?>
                </select>

                <input type="text" name="SearchFilter[room_number][value]" value="<?=$value?>" />
                </div>

        <?php $operator = $sf['price_per_day']['operator']; ?>
        <?php $value = $sf['price_per_day']['value']; ?>

                <div class="col-md-3"><label>Precio por dia</label>
                <br/>
                <select name="SearchFilter[price_per_day][operator]">
                    <?php foreach ($operators as $op) { ?>
                        <?php $selected = ($operator == $op) ? 'selected' : ''; ?>
                        <option value="<?=$op?>" <?=$selected?>><?=$op?></option>
                    <?php } ?>
                    </select>

                    <input type="text" name="SearchFilter[price_per_day][value]" value="<?=$value?>" />
                    </div>            
                    
        </div>
        <br/>
            <div class="row">
                <div class="col-md-3">
                    <input type="submit" value="filter" class="btn btn-primary" />
                    <input type="reset" value="reset" class="btn btn-primary" />
                </div>
            </div>
</form>