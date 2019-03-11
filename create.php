<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\pricelist\Pricelist */

$this->title = 'Create Pricelist';
$this->params['breadcrumbs'][] = ['label' => 'Pricelists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pricelist-create">

    <h1>Добавить новую позицию</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
