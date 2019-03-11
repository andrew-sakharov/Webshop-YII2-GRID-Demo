<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\pricelist\Pricelistsearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pricelist-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'users_id') ?>

    <?= $form->field($model, 'plantations_id') ?>

    <?= $form->field($model, 'types_id') ?>

    <?= $form->field($model, 'sorts_id') ?>

    <?php // echo $form->field($model, 'create_date') ?>

    <?php // echo $form->field($model, 'update_date') ?>

    <?php // echo $form->field($model, 'is_deleted') ?>

    <?php // echo $form->field($model, 'group_id') ?>

    <?php // echo $form->field($model, 'nl_id') ?>

    <?php // echo $form->field($model, 'nl_product_id') ?>

    <?php // echo $form->field($model, 'minimum_length') ?>

    <?php // echo $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'flag') ?>

    <?php // echo $form->field($model, 'price_chargeamount') ?>

    <?php // echo $form->field($model, 'quality_group') ?>

    <?php // echo $form->field($model, 'packing_innerpackagequantity') ?>

    <?php // echo $form->field($model, 'quantity_unitcode') ?>

    <?php // echo $form->field($model, 'grower') ?>

    <?php // echo $form->field($model, 'maturity_stage') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
