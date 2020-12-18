<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\User;

class SiteController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }



}
