<?php
use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label'=>'Семейный бюджет', 'url' => 'budget'];
$this->params['breadcrumbs'][] = ['label'=>'Статьи доходов и расходов', 'url' => 'reference'];
$this->title = 'Статьи  доходов';
$this->params['breadcrumbs'][] = $this->title;

if ( empty($ref) ): ?> <p>Добавьте ваши статьи доходов, пожалуйста.</p>
<?php else:?>
    <h1><?= Html::encode($this->title)?></h1>
    <?php    foreach ( $ref  as  $value ): ?>
        <div class = 'row'>
            <div class="col-sm-6 alert alert-success" role="alert"><?=$value['article']?>
            </div>
            <div class = "col-sm-2 alert alert-danger" role="alert"><a href ="
                        <?= yii\helpers\Url::to(['income/articlestop','id_article'=>$value['id_income'],
                            'user_id' => $user_id ])?>
                        ">Закрыть статью</a>
            </div>
        </div>
    <?php endforeach;
endif?>

<div class = "row">
    <div class = "col-sm-2 alert alert-primary" role="alert"><a href ="
                    <?= yii\helpers\Url::to(['income/articleadd','user_id' => $user_id ])?>
                    ">Добавить статью</a>
    </div>
</div>