<?php

class AdminController extends Controller
{
	public function actionComandmanage()
	{
        $this->redirect(Yii::app()->createUrl('team'));
	}

	public function actionGamemanage()
	{
		$this->render('gamemanage');
	}

	public function actionIndex()
	{
		$this->render('index');
	}
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                // TODO: тупое решение с правами админа, лучше изменить
                'roles'=>array('admin'),
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
            'accessControl',
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