<?php
/**
 * Created by PhpStorm.
 * User: Владимир
 * Date: 20.05.2017
 * Time: 20:39
 */

namespace app\models;
use yii\base\Model;

class ExpenseForm  extends Model{
    public $verifyCode;
    public $article;
    public $amount;
    public function rules()
    {
        return [
            [['amount'], 'required'],
            [['amount'], 'number'],
            ['article','string'],
            ['verifyCode', 'captcha'
                , 'captchaAction' => 'budget/captcha'
            ],
        ];
    }
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Код верификации',
            'amount'    => 'Сумма расхода',
        ];
    }
}