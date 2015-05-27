<?php

class PRController extends Controller
{
	public function actionindex()
	{
        $modelPass=new PRPassword;

        // uncomment the following code to enable ajax-based validation

        if(isset($_POST['ajax']) && $_POST['ajax']==='prpassword-form')
        {
            echo CActiveForm::validate($modelPass);
            Yii::app()->end();
        }


        if(isset($_POST['PRPassword']))
        {
            var_dump($_POST['PRPassword']);

            $modelPass->attributes=$_POST['PRPassword'];
            if($modelPass->validate())
            {
                // form inputs are valid, do something here
                return;
            }
        }
        $this->render('PRindex',array('Password'=>$modelPass));
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