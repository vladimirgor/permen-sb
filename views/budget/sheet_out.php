<?php
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->params['breadcrumbs'][] = ['label'=>'Семейный бюджет', 'url' => '/budget/budget'];
$this->params['breadcrumbs'][] = ['label'=>'Отчет о доходах и расходах', 'url' => '/budget/sheet'];
$this->title = 'Сводный отчет';

if ( empty($ref) ) :?> <p>Записей в бюджете за период с <?=$from?>
     по <?=$to?> нет.</p>
<?php else: ?>
    <div class="site-login">
        <h1><?= Html::encode($this->title). " за период c $from по $to" ?></h1>
        <table class="table table-bordered table-hover">
            <tr>
                <th><h4>Дата и время операции</h4></th>
                <th><h4>Статья</h4></th>
                <th><h4>Сумма</h4></th>
            </tr>
            <?php

            foreach ( $ref as $value ):
                $class = $value['inc_exp'] ? 'inc' : 'exp';?>
                <tr class="<?=$class?>">
                    <td><?=$value['date'] ?></td>
                    <td><?=$value['article'] ?></td>
                    <td><?=$value['amount'] ?></td>
                </tr>
            <?php endforeach; ?>

        </table>
    </div>
<?php endif; ?>