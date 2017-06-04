<?php
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->params['breadcrumbs'][] = ['label'=>'Семейный бюджет', 'url' => '/budget'];
$this->params['breadcrumbs'][] = ['label'=>'Статьи доходов и расходов', 'url' => '/reference'];
$this->params['breadcrumbs'][] = ['label'=>'Статьи расходов ', 'url' => '/refexpense'];
$this->title = 'Закрытие статьи расхода';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title). '-'. $expense->article?></h1>
    <p>Для закрытия статьи расхода введите дату закрытия, пожалуйста.</p>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'stop_date')->textInput(['autofocus' => true , 'type' => 'date']) ?>
    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [ 'captchaAction' => 'budget/captcha',
        'template' => '<div class="row"><div class="col-sm-3">{image}</div>
        <div class="col-sm-6">{input}</div></div>',
    ]) ?>
    <div class="form-group">
        <?= Html::submitButton('Закрыть статью расхода', ['class' => 'btn btn-danger']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
