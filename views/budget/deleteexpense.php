<?php
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->params['breadcrumbs'][] = ['label'=>'Семейный бюджет', 'url' => '/budget/budget'];
$this->params['breadcrumbs'][] = ['label'=>'Удаление доходов и расходов', 'url' => '/budget/delete'];
$this->title = 'Удаление расходов';
$this->params['breadcrumbs'][] = $this->title;
if ( empty($ref) ) :?> <p> Расходных записей в бюджете нет.</p>
<?php else: ?>
    <div class="site-login">
        <h1><?= Html::encode($this->title)?></h1>
        <p> Выберите, пожалуйста, записи для удаления из бюджета</p>
        <?php $form = ActiveForm::begin(); ?>
            <?php
            foreach ( $ref as $value ):
                ?>
                <?=$form->field($model, 'budget_id')->checkbox(['name' => 'n'.$value['id'],
                'value' => $value['id'],'label' => $value['date']. ' ' . $value['article'] .' '. $value['amount']])?>
            <?php endforeach; ?>
    </div>
        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [ 'captchaAction' => 'budget/captcha',
            'template' => '<div class="row">
                                <div class="col-sm-3">{image}</div>
                                <div class="col-sm-6">{input}</div>
                            </div>',
        ]) ?>
        <div class="form-group">
            <?= Html::submitButton('Удалить выделенные расходы из бюджета', ['class' => 'btn btn-danger',
                'id' => 'del_inc_exp']) ?>
        </div>
    <?php ActiveForm::end(); ?>
<?php endif; ?>

