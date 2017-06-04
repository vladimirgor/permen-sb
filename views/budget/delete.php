<?php
use yii\bootstrap\Nav;
$this->params['breadcrumbs'][] = ['label'=>'Семейный бюджет', 'url' => '/budget/budget'];
$this->title = 'Удаление доходов и расходов';
$this->params['breadcrumbs'][] = $this->title;
echo Nav::widget([
'options' => ['class' => 'navbar-nav navbar-left'],
'items' => [
['label' => 'Удаление доходов', 'url' => ['deleteincome']],
['label' => 'Удаление расходов', 'url' => ['deleteexpense']],
],
]);