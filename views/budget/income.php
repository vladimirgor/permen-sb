<?php
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->params['breadcrumbs'][] = ['label'=>'Семейный бюджет', 'url' => '/budget/budget'];
$this->params['breadcrumbs'][] = ['label'=>'Ввод доходов и расходов', 'url' => '/budget/input'];
$this->title = 'Ввод доходов';
$this->params['breadcrumbs'][] = $this->title;
if ( empty($ref) ) :?> <p>Добавьте ваши статьи доходов в разделе "Статьи доходов и расходов", пожалуйста.</p>
<?php else: ?>

<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Для добавления дохода в бюджет выберите статью и введите сумму дохода, пожалуйста.</p>
    <?php $form = ActiveForm::begin(); ?>
       <?php
       foreach ( $ref as $value ):?>

           <?=$form->field($model, 'article')->radio(['label' => $value['article'],
               'value' => $value['article'],
               'uncheck' => null]);?>

        <?php endforeach; ?>
    <?= $form->field($model, 'amount') ?>
    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [ 'captchaAction' => 'budget/captcha',
        'template' => '<div class="row"><div class="col-sm-3">{image}</div>
        <div class="col-sm-6">{input}</div></div>',
    ]) ?>
    <div class="form-group">
        <?= Html::submitButton('Добавить доход в бюджет', ['class' => 'btn btn-primary',
            'id' => 'add_inc_exp']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php endif; ?>