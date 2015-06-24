<?php
/* @var $panel yii\debug\panels\LogPanel */
/* @var $searchModel yii\debug\models\search\Log */
/* @var $dataProvider yii\data\ArrayDataProvider */

use bedezign\yii2\audit\Audit;
use bedezign\yii2\audit\models\AuditTrailSearch;
use yii\helpers\Html;
use yii\grid\GridView;

echo '<h1>' . Yii::t('audit', 'Database Trails') . '</h1>';

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'id' => 'log-panel-detailed-grid',
    'options' => ['class' => 'detail-grid-view table-responsive'],
    'filterModel' => $searchModel,
    'columns' => [
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}',
            'buttons' => [
                'view' => function ($url, $model, $key) {
                    return Html::a(
                        Html::tag('span', '', ['class' => 'glyphicon glyphicon-eye-open']), ['trail/view', 'id' => $model->id]
                    );
                }
            ],
            'options' => [
                'width' => '30px',
            ],
        ],
        [
            'attribute' => 'id',
            'options' => [
                'width' => '80px',
            ],
        ],
        [
            'attribute' => 'user_id',
            'label' => Yii::t('audit', 'User ID'),
            'class' => 'yii\grid\DataColumn',
            'value' => function ($data) {
                return Audit::current()->getUserIdentifier($data->user_id);
            },
            'options' => [
                'width' => '150px',
            ],
        ],
        [
            'attribute' => 'action',
            'filter' => AuditTrailSearch::actionFilter(),
            'options' => [
                'width' => '150px',
            ],
        ],
        [
            'attribute' => 'model',
            'options' => [
                'width' => '150px',
            ],
        ],
        [
            'attribute' => 'model_id',
            'options' => [
                'width' => '80px',
            ],
        ],
        [
            'attribute' => 'field',
            'options' => [
                'width' => '100px',
            ],
        ],
        [
            'label' => Yii::t('audit', 'Diff'),
            'value' => function ($data) {
                return $data->getDiffHtml();
            },
            'format' => 'raw',
        ],
        [
            'attribute' => 'stamp',
            'options' => [
                'width' => '150px',
            ],
        ],
    ],
]);