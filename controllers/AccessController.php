<?php
/**
 * Created by PhpStorm.
 * User: omentes
 * Date: 12/28/18
 * Time: 11:12 AM
 */

namespace app\controllers;


use yii\web\Controller;
use yii\filters\AccessControl;

class AccessController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
        ];
    }
}