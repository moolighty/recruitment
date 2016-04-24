<?php

use yii\grid\GridView;
use yii\helpers\Html;

$this->title="职位管理";

echo GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'columns' =>[
            'id',
            'name',
            'company',
            'city',
            'url',
            'min_salary',
            'max_salary',
            'publish_time',
            [
                'class' =>'yii\grid\ActionColumn',
                'header'=>'operations',
                'template'=>"{view}{update}{delete}{add}",
                'buttons'=>[
                    'add'=>function($url,$model,$key){
                        return Html::a('<span class="glyphicon glyphicon-plus"></span>',
                                        $url , ['title' => 'add']);
                    }
                ],
            ],
        ],
    ]
);
