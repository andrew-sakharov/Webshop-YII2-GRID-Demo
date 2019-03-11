<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\pricelist\Pricelist */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pricelists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pricelist-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'users_id',
            'plantations_id',
            'types_id',
            'sorts_id',
            'create_date',
            'update_date',
            'is_deleted',
            'group_id',
            'nl_id',
            'nl_product_id',
            'minimum_length',
            'quantity',
            'flag',
            'price_chargeamount',
            'quality_group',
            'packing_innerpackagequantity',
            'quantity_unitcode',
            'grower',
            'maturity_stage',
        ],
    ]) ?>

</div>
