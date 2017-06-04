<?php
/**
 * Created by PhpStorm.
 * User: Владимир
 * Date: 30.05.2017
 * Time: 10:17
 */

namespace app\models;


use yii\base\Model;

class ExpenseDeleteListForm extends Model{

    public $budget_id;
    public $verifyCode;

    public function rules()
    {
        return [
            ['budget_id','number'],
            ['verifyCode', 'captcha'
                , 'captchaAction' => 'budget/captcha'
            ],
        ];
    }
    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Код верификации',
        ];
    }

}