<?php

namespace app\controllers;
use app\models\IncomeDeleteListForm;
use app\models\ExpenseDeleteListForm;
use app\models\RegisterForm;
use app\models\LoginForm;
use app\models\SheetForm;
use app\models\IncomeForm;
use app\models\ExpenseForm;
use app\models\User;
use app\models\Income;
use app\models\Budget;
use app\models\Expense;
use Yii;

/**
 * Description of BudgetController
 *
 * @author Владимир
 */
class BudgetController extends AppController {

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    public function actionIndex() {
        
        return $this->render('index');
    }

    public function actionAbout() {

        return $this->render('about');
    }

    public function actionBudget() {

        return $this->render('budget');
    }

    public function actionRegister()
    {

        $model = new RegisterForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user =  New User();
            $user->first_name = htmlspecialchars($model->firstname,ENT_QUOTES);
            $user->last_name = htmlspecialchars($model->lastname,ENT_QUOTES);
            $user->login = htmlspecialchars($model->login,ENT_QUOTES);
            $user->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
            $user->save();
            $identity = User::findOne(['login' => $user->login]);
            Yii::$app->user->login($identity);
            return $this->redirect(['budget']);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('register', ['model' => $model]);
        }
    }

    public function actionInput(){
        return $this->render('input');
    }

    public function actionDelete(){
        return $this->render('delete');
    }

    public function actionDeleteincome(){
        $user_id = Yii::$app->user->identity->id_user;
        $ref = Budget::find()->where(['user_id' => $user_id, 'inc_exp' => true ])
            -> orderBy(['date'=> SORT_ASC ]) ->asArray()->all();
        $model = new IncomeDeleteListForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            foreach ( $_POST as $key => $value ){
                if ( $key == 'n' . $value  )
                {
                    $budget = Budget::findOne($value);
                    $budget->delete();
                }
            }
            return $this->redirect(['deleteincome']);
        } else {
            return $this->render('deleteincome', compact('ref', 'model'));
        }
    }

    public function actionDeleteexpense(){
        $user_id = Yii::$app->user->identity->id_user;
        $ref = Budget::find()->where(['user_id' => $user_id, 'inc_exp' => false ])
            -> orderBy(['date'=> SORT_ASC ]) ->asArray()->all();
        $model = new ExpenseDeleteListForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            foreach ( $_POST as $key => $value ){
                if ( $key == 'n' . $value  )
                {
                    $budget = Budget::findOne($value);
                    $budget->delete();
                }
            }
            return $this->redirect(['deleteexpense']);
        } else {
            return $this->render('deleteexpense', compact('ref', 'model'));
        }
    }

    public function actionSheet(){
        $model = new SheetForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $from =  $model -> from;
            $from_t = $from .' 00:00:00';
            $from = date('d.m.Y',strtotime($from));
            $to = $model -> to;
            $to_t = $to . ' 24:00:00';
            $to = date('d.m.Y',strtotime($to));
            $user_id = Yii::$app->user->identity->id_user;
            $ref =Budget::find()->select('inc_exp,date,article,amount')->
                where(['and',"user_id = $user_id"
                , ['>=','date',$from_t ]
                ,['<=','date',$to_t ]
            ])-> orderBy(['date'=> SORT_ASC ]) ->asArray()->all();
            return $this->render('sheet_out', compact('ref','from','to'));
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('sheet', ['model' => $model]);
        }
    }

    public function actionReference(){
        return $this->render('reference');
    }

    public function actionRefincome(){
        $user_id = Yii::$app->user->identity->id_user;
        $ref =Income::find()->select('id_income,article')->
            where(['and',"user_id = $user_id",['or','stop_date is NULL',
                ['>','stop_date',date('Y-m-d')] ]])
                -> asArray()->all();
       return $this->render('refincome',compact('ref','user_id'));
    }

    public function actionRefexpense(){
        $user_id = Yii::$app->user->identity->id_user;
        $ref =Expense::find()->select('id_expense,article')->
            where(['and',"user_id = $user_id",['or','stop_date is NULL',
            ['>','stop_date',date('Y-m-d')] ]])
            -> asArray()->all();
        return $this->render('refexpense',compact('ref','user_id'));
    }

    public function actionIncome(){
        $user_id = Yii::$app->user->identity->id_user;
        $ref =Income::find()->select('id_income,article')->
            where(['and',"user_id = $user_id",['or','stop_date is NULL',
            ['>','stop_date',date('Y-m-d')] ]])
            ->asArray()->all();
        $model = new IncomeForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $budget = new Budget();
            $budget -> article = $model -> article;
            $budget -> amount = $model -> amount;
            $budget -> user_id = $user_id;
            $budget -> inc_exp = true;
            $budget -> date = date('Y-m-d H:i:s');
            $budget -> save();
            return $this -> redirect(['last']);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('income', compact('ref','model'));
        }
    }

    public function actionExpense(){
        $user_id = Yii::$app->user->identity->id_user;
        $ref =Expense::find()->select('id_expense,article')->
        where(['and',"user_id = $user_id",['or','stop_date is NULL',
            ['>','stop_date',date('Y-m-d')] ]])
            ->asArray()->all();
        $model = new ExpenseForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $budget = new Budget();
            $budget -> article = $model -> article;
            $budget -> amount = $model -> amount;
            $budget -> user_id = $user_id;
            $budget -> inc_exp = false;
            $budget -> date = date('Y-m-d H:i:s');
            $budget -> save();
            return $this -> redirect(['last']);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this -> render('expense', compact('ref','model'));
        }
    }

    public function actionLast(){
        $user_id = Yii::$app->user->identity->id_user;
        $ref = Budget::find()->select('inc_exp,date,amount,article')->
        where(['user_id' => $user_id])-> orderBy(['date'=> SORT_DESC ])
            ->limit(QNT_LAST)->asArray()->all();
        return $this->render('last', compact('ref'));
    }
    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            //return $this->goBack();
            return $this->redirect(['budget']);

        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
//Проверка выбора хотя бы одного checkbox
//var checkboxes = $("input[type='checkbox']"),
//submitButt = $("input[type='submit']");
//submitButt = $("#del_inc_exp");

//checkboxes.click(function() {
//    submitButt.attr("disabled", !checkboxes.is(":checked"));
//});