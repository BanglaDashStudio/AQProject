<?php

class AuthController extends Controller
{
    public $defaultAction = 'signIn';

	public function actionSignIn()
	{
        $model=new ComandSignIn;

        // uncomment the following code to enable ajax-based validation

        if(isset($_POST['ajax']) && $_POST['ajax']==='comand-SignIn-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }


        if(isset($_POST['ComandSignIn']))
        {
            $model->attributes=$_POST['ComandSignIn'];

            if($model->validate())
            {
                // form inputs are valid, do something here
                $login = $_POST['ComandSignIn']['username'];
                $pass = $_POST['ComandSignIn']['password'];
                $this->SignInFunc($login, $pass);
                $this->redirect(Yii::app()->createUrl('home'));
                return;
            }
        }
        $this->render('SignIn',array('model'=>$model));

	}

    private function SignInFunc($login, $pass){
        // Аутентифицируем пользователя по имени и паролю
        $identity = new UserIdentity($login,$pass);

        if($identity->authenticate()) {
            Yii::app()->user->login($identity, 3600*10);
        } else {
            echo $identity->errorMessage;
        }

        // Выходим
        //Yii::app()->user->logout();
    }

    public function actionSignUp()
    {
        $model=new ComandSignUp;

        // uncomment the following code to enable ajax-based validation

        if(isset($_POST['ajax']) && $_POST['ajax']==='comand-SignUp-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }


        if(isset($_POST['ComandSignUp']))
        {
            $model->attributes=$_POST['ComandSignUp'];

            $modelcomand =new Team;
            $modelcomand->NameTeam = $model->username;
            $modelcomand->PasswordTeam = CPasswordHelper::hashPassword($model->password);
            $modelcomand->EmailTeam = $model->mail;
            $modelcomand->PageTeam = 'a.com';
            $modelcomand->PhoneTeam = $model->phone;
            $modelcomand->DescriptionTeam = $model->description;

            if($modelcomand->validate())
            {
                if($modelcomand->save()){
                    $this->SignInFunc($model->username, $model->password);
                    $this->redirect(Yii::app()->createUrl('home'));
                    return;
                }
            }else{
                echo 'nnn';
            }
        }
        $this->render('SignUp',array('model'=>$model));
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

	// Uncomment the following methods and override them if needed

    public function accessRules()
    {
        return array(

            array('allow',  // allow all users to perform 'index' and 'view' actions
                'users'=>array('@'),
                'actions'=>array('logout'),
            ),
            array('allow',
                'users'=>array('?'),
                ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
        return array(
         //   'accessControl',
        );
	}
/*
	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}