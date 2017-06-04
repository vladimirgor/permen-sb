<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Для регистрации заполните следующие поля, пожалуйста.</p>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'firstname')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'lastname') ?>
    <?= $form->field($model, 'login') ?>
    <?if ( $message_login ) echo 'Entered login already exists. Use another login, please.';?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'password_repeat')->passwordInput() ?>

    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [ 'captchaAction' => 'budget/captcha',
        'template' => '<div class="row"><div class="col-sm-3">{image}</div>
        <div class="col-sm-6">{input}</div></div>',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Зарегистрировать', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>