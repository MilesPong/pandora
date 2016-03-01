<?php

/*
 * Overwrite Dektrium project.
 */
namespace backend\controllers;

use dektrium\user\controllers\SecurityController as BaseSecurityController;
use Yii;
use dektrium\user\models\LoginForm;

class SecurityController extends BaseSecurityController
{

    /**
     * Displays the login page.
     * 
     * @return string|Response
     */
    public function actionLogin()
    {
        if (! \Yii::$app->user->isGuest) {
            $this->goHome();
        }
        
        $model = \Yii::createObject(LoginForm::className());
        
        $this->performAjaxValidation($model);
        
        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {
            return $this->goBack();
        }
        
        $this->layout = '@backend/views/layouts/login_main';
        
        return $this->render('login', [
            'model' => $model,
            'module' => $this->module
        ]);
    }
}
?>