<?php
use yii\bootstrap\Nav;
$this->title = 'Семейный бюджет';
$this->params['breadcrumbs'][] = $this->title;
if (Yii::$app->user->isGuest): ?>
<div class="alert alert-warning" role="alert">Войдите или зарегистрируйтесь, пожалуйста.</div>
    <?php else:
    echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-left'],
    'items' => [
    ['label' => 'Ввод доходов и расходов','url' => ['input']],
    ['label' => 'Удаление доходов и расходов','url' => ['delete']],
    ['label' => 'Отчет о доходах и расходах', 'url' => ['sheet']],
    ['label' => 'Статьи  доходов и расходов', 'url' => ['reference']],
    ],
    ]);
 endif;
