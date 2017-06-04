<?php
/**
 * Created by PhpStorm.
 * User: Владимир
 * Date: 29.05.2017
 * Time: 20:42
 */

namespace app\models;

use yii\base\Model;
class IncomeDeleteListForm extends Model {
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