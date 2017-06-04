<?php
use yii\bootstrap\Nav;
$this->params['breadcrumbs'][] = ['label'=>'Семейный бюджет', 'url' => '/budget/budget'];
$this->title = 'Статьи  доходов и расходов';
$this->params['breadcrumbs'][] = $this->title;
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-left'],
    'items' => [
        ['label' => 'Статьи доходов', 'url' => ['refincome']],
        ['label' => 'Статьи расходов', 'url' => ['refexpense']],
    ],
]);