<?php

namespace app\controllers;
use app\models\Expense;
use app\models\ExpenseArticleForm;
use app\models\ExpenseArticleStopForm;
use Yii;

class ExpenseController extends AppController  {

    public function actionArticleadd($user_id){
        $model = new ExpenseArticleForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $expense = new Expense();
            $expense->article = htmlspecialchars($model ->article,ENT_QUOTES);
            $expense->user_id = $user_id;
            $expense -> save();
            return $this->redirect(['/refexpense']);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('article', ['model' => $model]);
        }
    }

    public function actionArticlestop($user_id, $id_article){
        $expense = Expense::find() -> where([ 'id_expense' => $id_article])
            -> andWhere(['user_id' => $user_id]) -> one();
        if ( empty($expense) ) throw new \yii\web\HttpException(404,
            'This expense article is absent.');$user_id = Yii::$app->user->identity->id_user;
        $model = new ExpenseArticleStopForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $expense->stop_date = $model->stop_date;
            $expense -> save();
            return $this->redirect(['/refexpense']);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('article-stop', compact('model','expense'));
        }
    }

}