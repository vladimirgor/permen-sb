<?php
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->params['breadcrumbs'][] = ['label'=>'Семейный бюджет', 'url' => '/budget'];
$this->params['breadcrumbs'][] = ['label'=>'Статьи доходов и расходов', 'url' => '/reference'];
$this->params['breadcrumbs'][] = ['label'=>'Статьи расходов ', 'url' => '/refexpense'];
$this->title = 'Добавление статьи расходов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Для добавления статьи расхода заполните следующее поле, пожалуйста.</p>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'article')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [ 'captchaAction' => 'budget/captcha',
        'template' => '<div class="row"><div class="col-sm-3">{image}</div>
        <div class="col-sm-6">{input}</div></div>',
    ]) ?>
    <div class="form-group">
        <?= Html::submitButton('Добавить статью расхода', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
