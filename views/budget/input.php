<?php
use yii\bootstrap\Nav;
$this->params['breadcrumbs'][] = ['label'=>'Семейный бюджет', 'url' => '/budget/budget'];
$this->title = 'Ввод доходов и расходов';
$this->params['breadcrumbs'][] = $this->title;
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-left'],
    'items' => [
        ['label' => 'Ввод доходов', 'url' => ['income']],
        ['label' => 'Ввод расходов', 'url' => ['expense']],
    ],
]);