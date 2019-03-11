<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use app\models\pricelist\Types;
use app\models\pricelist\Sorts;
use app\models\pricelist\Plantations;
use yii\jui\DatePicker;
?> 

<div class="pricelist-form">
    <?php 
    $form = ActiveForm::begin(['layout' => 'horizontal']);
   
    $sorts = ArrayHelper::map(Sorts::find()->all(), 'id', 'name');
    $types = ArrayHelper::map(Types::find()->all(), 'id', 'name_en');
    $plantations = ArrayHelper::map(Plantations::find()->all(), 'id', 'name');
    ?>
    
<!--     <input type="hidden" name="_csrf" value="8GYLGS3AXm4YGWwqrbVlLG7-8LF7O75W">  -->

    <?php if ($model->isNewRecord):?>
        <?= $form->field($model, 'sorts_id')->dropDownList($sorts,['prompt'=>''])->label('Сорт'); ?>
    	<?= $form->field($model, 'plantations_id')->dropDownList($plantations,['prompt'=>''])->label('Плантация'); ?>
		<?= $form->field($model, 'types_id')->dropDownList($types,['prompt'=>''])->label('Категория'); ?>
		
    <?php endif?>

    <?php if (!$model->isNewRecord):?>
        <?= $form->field($model, 'sorts_id')->dropDownList($sorts,['prompt'=>''])->label('Сорт'); ?>
    	<?= $form->field($model, 'plantations_id')->dropDownList($plantations,['prompt'=>''])->label('Плантация'); ?>
		<?= $form->field($model, 'types_id')->dropDownList($types,['prompt'=>''])->label('Категория'); ?>
    <?php endif?>
    
    <?= $form->field($model, 'quantity')->textInput()->label('Количество в наличии'); ?>        
    <?= $form->field($model, 'quality_group')->textInput(['maxlength' => true])->label('Качество'); ?>
    <?= $form->field($model, 'maturity_stage')->textInput(['maxlength' => true])->label('Размер (см)'); ?>
    
   
    <?=  $form->field($model, 'myCreateDate')->widget(\yii\jui\DatePicker::classname(), 
        ['dateFormat' => 'php:Y-m-d',
        ])->label('Дата');    ?>

    <?php if (!$model->isNewRecord):?>
    
       <?= GridView::widget([
           'dataProvider' => new \yii\data\ActiveDataProvider([
               'query' => $model->getGlaprice(),
               'pagination' => false
           ]),
           'tableOptions' => [
               'class' => 'table table-striped table-bordered'
           ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [ 'attribute' => 'price',
                'label' => 'Цена (евро)',
                'format' => 'raw',
                'value' => function ($data){return Html::label($data['price']); }
            ],
            
            
            [ 'attribute' => 'min_quantity',
                'label' => 'Мин. количество',
                'format' => 'raw',
                'value' => function ($data){return Html::label($data['min_quantity']); }
            ],

            [
                'class' => \yii\grid\ActionColumn::className(),
                'controller' => 'glaprice',
                'header' => Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp;Добавить', ['glaprice/create', 'relation_id' => $model->nl_id]),
                'template' => '{update}{delete}',
            ]
            
        ],
    ]); ?>

    <?php endif?>

    
    <div class="form-group">   
     <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>        
    </div>

    <?php ActiveForm::end(); ?>
    
    


</div>
