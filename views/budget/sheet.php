<?php
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->params['breadcrumbs'][] = ['label'=>'Семейный бюджет', 'url' => 'budget'];
$this->title = 'Отчет о доходах и расходах';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Для формирования отчета заполните следующие поля, пожалуйста.</p>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'from')->textInput(['autofocus' => true, 'type' => 'date']) ?>
    <?= $form->field($model, 'to') ->textInput(['type' => 'date'])?>
    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [ 'captchaAction' => 'budget/captcha',
        'template' => '<div class="row"><div class="col-sm-3">{image}</div>
        <div class="col-sm-6">{input}</div></div>',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сформировать отчет', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
