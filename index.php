<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\models\pricelist\Sorts;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\pricelist\Pricelistsearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Прайс лист';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pricelist-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать новую позицию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['style' => 'width:100%'],
        'columns' => [          
                       
            [ 'attribute' => 'plantations_id',
                'label' => 'Плантация',
                'format' => 'raw',
                'value' => 'plantations.name',
            ],
            
            [ 'attribute' => 'types_id',
                'label' => 'Категория',
                'format' => 'raw',
                'value' => 'types.name_ru',
            ],
            
            
            [ 'attribute' => 'sorts_id',
                'label' => 'Сорт',
                'format' => 'raw',
                'value' => 'sorts.name', 
            ],
            
            [ 'attribute' => 'minimum_length',
                'label' => 'Размер',
                'format' => 'raw',
                'value' => 'minimum_length',
            ],
            
            [ 'attribute' => 'maturity_stage',
                'label' => 'Зрелость',
                'format' => 'raw',
                'value' => 'maturity_stage',
            ],
            
            [ 'attribute' => 'quality_group',
                'label' => 'Качество',
                'format' => 'raw',
                'value' => 'quality_group',
            ],
            
            [ 'attribute' => 'quantity',
                'label' => 'Наличие',
                'format' => 'raw',
                'value' => 'quantity',
            ],
                      
            [
                'attribute' => 'glaprice',
                'label' => 'Цена',
                'format' => 'paragraphs',
                'value' => function ($model) {
                $result = '';
                foreach ($model->glaprice as $price) {
                    $result .= $price->price . "\n\n";
                }
                return $result;
                }
            ], 
                
            [
                'attribute' => 'glaprice',
                'label' => 'Мин.',
                'format' => 'paragraphs',
                'value' => function ($model) {
                    $result = '';
                    foreach ($model->glaprice as $price) {
                        $result .= $price->min_quantity . "\n\n";
                    }
                    return $result;
                }
            ],
            
            [ 'label' => 'Фото',
                'format' => 'html',
                'value' => function($model){
                    $nl_id = $model->nl_id;                 
                    $result = Url::base() . "/image/" . $nl_id . ".jpg";                    
                    //  вариант адрес фото в таблице Glnsupply *******************************************************************
                        //  $res = Glnsupply::find()->select(['referenceddocument_uriid'])->where(['product_id' => $nl_id])->one();
                        //  $result = $res->referenceddocument_uriid;
                        //  ******************************************************************************************************                   
                    return Html::img($result,['style' => 'width:40px;']);
                },
            ],
            
/*            
            [
                'attribute' => ' ',
                'format' => 'html',
                'value' => function($model){
                
                $nl_id = $model->nl_id;
                $result = Url::base() . "/image/" . $nl_id . ".jpg";
                $result2 =  "../image/" . $nl_id . ".jpg";
                //  вариант адрес фото в таблице Glnsupply *******************************************************************
                //  $res = Glnsupply::find()->select(['referenceddocument_uriid'])->where(['product_id' => $nl_id])->one();
                //  $result = $res->referenceddocument_uriid;
                //  ******************************************************************************************************
                return Html::a("Фото",[$result2]);
                },
             ],
*/            

            
                [
                    /**
                     * Указываем класс колонки ActionColumn
                     */
                    'class' => \yii\grid\ActionColumn::class,
                    
                    /**
                     * Определяем набор кнопок. По умолчанию {view} {update} {delete}
                     */
                    'template' => '{view} {update} {delete} {info}',
                    
                    'buttons' => [
                        'info' => function ($url, $model, $key) {
                        $iconName = "picture";
                        
                        //Текст в title ссылки, что виден при наведении
                        $title = \Yii::t('yii', 'Посмотреть фото');
                        
                        $id = 'info-'.$key;
                        $options = [
                            'title' => $title,
                            'aria-label' => $title,
                            'data-pjax' => '0',
                            'id' => $id
                        ];
                        
                        $nl_id = $model->nl_id;
                        $result = Url::base() . "/image/" . $nl_id . ".jpg";                        
                        $result = '<img src=' . $result . '>';                       
                        $sort_id = $model->sorts_id;
                        $res = Sorts::find()->select(['name'])->where(['id' => $sort_id])->one();
                        $sort_name = 'Сорт: ' . $res->name;                        
                        $url = Url::current(['', 'id' => $key]);
                        
                        //Для стилизации используем библиотеку иконок
                        $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-$iconName"]);
                        
                        //Обработка клика на кнопку
                        $js = <<<JS
                            $("#{$id}").on("click",function(event){
                            event.preventDefault();
                            var myModal = $("#myModal");
                            var modalBody = myModal.find('.modal-body');
                            var modalTitle = myModal.find('.modal-header');                           
                            modalTitle.find('h2').html('$sort_name');
                            modalBody.html('$result');                            
                            myModal.modal("show");        
                            }
            );
JS;
                        
                        //Регистрируем скрипты
                        $this->registerJs($js, \yii\web\View::POS_READY, $id);
                        
                        return Html::a($icon, $url, $options);
                        },
                        ],
                        ],                
        ],
    ]); 
                        
    Modal::begin([
        
        //Этот текст заменяется в javascripte
        'header' => '<h2>'.\Yii::t('yii', 'Page info').'</h2>',
        'options' => ['id' => 'myModal'],
        
    ]);
    

    
    //Этот текст заменяется в javascripte
//    echo \Yii::t('yii', 'Text...');

//    $as = 'localhost/yii2as/web/image/147182350.jpg';

//    echo Html::img(null, $this->imageOptions);
//    echo Html::img($as);
//    echo Html::beginTag('div', ['class' => 'image-container']);
//    echo Html::endTag('div');
    
    Modal::end();
    
    ?>
</div>
