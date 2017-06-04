<?php

namespace app\controllers;
use app\models\Income;
use app\models\IncomeArticleForm;
use app\models\IncomeArticleStopForm;
use Yii;
class IncomeController extends AppController {

    public function actionArticleadd($user_id){
        $model = new IncomeArticleForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $income = new Income();
            $income->article = htmlspecialchars($model ->article,ENT_QUOTES);
            $income->user_id = $user_id;
            $income -> save();
            return $this->redirect(['/refincome']);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('article', ['model' => $model]);
        }
    }

    public function actionArticlestop($user_id, $id_article){
        $income = Income::find() -> where([ 'id_income' => $id_article])
            -> andWhere(['user_id' => $user_id]) -> one();
        if ( empty($income) ) throw new \yii\web\HttpException(404,
            'This income article is absent.');$user_id = Yii::$app->user->identity->id_user;
        $model = new IncomeArticleStopForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $income->stop_date = $model->stop_date;
            $income -> save();
            return $this->redirect(['/refincome']);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('article-stop', compact('model','income'));
        }
    }

}