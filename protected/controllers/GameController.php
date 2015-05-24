<?php

class GameController extends Controller
{
	public function actionCreate()
	{
        $model=new Game;
        if(isset($_POST['Game']))
        {
        $model->attributes=$_POST['Game'];
        if($model->validate())
        {
            // form inputs are valid, do something here
            return;
        }
            if($model->save())
            {
                $this->refresh();
            }
    }
		$this->render('Create',array('model'=>$model));
	}

	public function actionPlay()
	{
        $model=new Game;
		$this->render('Play');
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