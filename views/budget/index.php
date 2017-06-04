<?php if (Yii::$app->user->isGuest): ?>
    <div class="alert alert-warning" role="alert">Войдите или зарегистрируйтесь, пожалуйста.</div>
    <?php  else: ?>
    <div class="alert alert-success" role="alert">Можно перейти в Семейный бюджет.</div>
<? endif;?>