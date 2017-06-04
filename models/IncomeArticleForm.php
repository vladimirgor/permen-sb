<?php
/**
 * Created by PhpStorm.
 * User: Владимир
 * Date: 23.05.2017
 * Time: 17:29
 */

namespace app\models;


use yii\base\Model;
use Yii;
class IncomeArticleForm extends Model {
    public $article;
    public $verifyCode;

    public function rules()
    {
        return [
            ['article', 'required'],
            ['article', 'validateArticle'],
            ['verifyCode', 'captcha'
                , 'captchaAction' => 'budget/captcha'
            ],
        ];
    }

    public function validateArticle($attribute){
        $user_id = Yii::$app->user->identity->id_user;
        $ref =Income::find()->
        where(['and',"`user_id` = $user_id",['or','stop_date is NULL', ['>','stop_date',date('Y-m-d') ] ]
        ])-> asArray()->all();
        foreach ( $ref as $value ) {
            if ( $value['article'] == $this->article ) {
                $this->addError($attribute, 'Такая статья дохода у Вас уже имеется.');
                break;
            }
        }
    }
    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Код верификации',
            'article'  => 'Статья дохода',
        ];
    }

}