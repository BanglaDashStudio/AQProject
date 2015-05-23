<?php

class AuthController extends Controller
{
    public $defaultAction = 'signIn';

	public function actionSignIn()
	{
        $model=new Comand;

        // uncomment the following code to enable ajax-based validation
        /*
        if(isset($_POST['ajax']) && $_POST['ajax']==='comand-SignIn-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        */

        if(isset($_POST['Comand']))
        {
            $model->attributes=$_POST['Comand'];
            if($model->validate())
            {
                // form inputs are valid, do something here
                return;
            }
        }
        $this->render('SignIn',array('model'=>$model));
	}

    public function actionSignUp()
    {
        $model=new Comand;

        // uncomment the following code to enable ajax-based validation
        /*
        if(isset($_POST['ajax']) && $_POST['ajax']==='comand-SignUp-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        */

        if(isset($_POST['Comand']))
        {
            $model->attributes=$_POST['Comand'];
            if($model->validate())
            {
                // form inputs are valid, do something here
                return;
            }
        }
        $this->render('SignUp',array('model'=>$model));
    }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

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