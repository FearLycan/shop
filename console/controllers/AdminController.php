<?php

namespace console\controllers;

use common\models\User;
use Yii;
use yii\console\Controller;

class AdminController extends Controller
{
    public function actionAdd()
    {
        $password = Yii::$app->security->generateRandomString(15);
        $username = $this->uniqueUsername();

        $user = new User();
        $user->username = $username;
        $user->email = 'email-' . Yii::$app->security->generateRandomString(5) . '@email.com';
        $user->status = User::STATUS_ACTIVE;
        $user->setPassword($password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        if ($user->save()) {
            echo $username . ' / ' . $password . "\n";
        } else {
            echo json_encode($user->errors);
        }
    }

    private function uniqueUsername()
    {
        $username = 'admin' . rand(1, 100);

        $user = User::findOne(['username' => $username]);

        if (empty($user)) {
            return $username;
        } else {
            return $this->uniqueUsername();
        }
    }
}