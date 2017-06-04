<?php
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->params['breadcrumbs'][] = ['label'=>'Семейный бюджет', 'url' => '/budget/budget'];
$this->params['breadcrumbs'][] = ['label'=>'Ввод доходов и расходов', 'url' => '/budget/input'];
$this->title = 'Бюджет - последние записи';
$this->params['breadcrumbs'][] = $this->title;
//print_r($ref);die;
if ( empty($ref) ) :?> <p>Записей в бюджете нет.</p>
<?php else: ?>
    <div class="site-login">
        <h1><?= Html::encode($this->title) ?></h1>
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