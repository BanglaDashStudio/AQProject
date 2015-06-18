<?php

class PRController extends Controller
{
	public function actionindex()
	{
        $modelPass = new PRPassword;
        $modelInfo = new PRInfo;
        $userInfo = Team::model()->findByAttributes(array('name'=>Yii::app()->user->name));

        if($userInfo == null){
            echo 'ошибка';
            return;
        }

        $modelInfo->phone = $userInfo->phone;
        $modelInfo->mail = $userInfo->email;
        $modelInfo->page = $userInfo->page;
        $modelInfo->inform = $userInfo->description;

        if(isset($_POST['ajax']) && $_POST['ajax']==='prpassword-form')
        {
            echo CActiveForm::validate($modelPass);
            Yii::app()->end();
        }

        if(isset($_POST['ajax']) && $_POST['ajax']==='prinfo-form')
        {
            echo CActiveForm::validate($modelInfo);
            Yii::app()->end();
        }

        if(isset($_POST['PRPassword']))
        {
            $modelPass->attributes=$_POST['PRPassword'];
            if($modelPass->validate())
            {
                $userInfo->password = CPasswordHelper::hashPassword($modelPass->newpassword);

                if($userInfo->save()) {
                    $this->render('PRindex', array('Password' => new PRPassword(), 'Info' => $modelInfo, 'alertFlag' => true));
                    return;
                }
            }
        }

        if(isset($_POST['PRInfo']))
        {
            $modelInfo->attributes=$_POST['PRInfo'];
            if($modelInfo->validate())
            {
                $userInfo->phone = $_POST['PRInfo']['phone'];
                $userInfo->description = $_POST['PRInfo']['inform'];
                $userInfo->page = $_POST['PRInfo']['page'];
                $userInfo->email = $_POST['PRInfo']['mail'];

                if($userInfo->save()) {
                    $this->render('PRindex', array('Password' => new PRPassword(), 'Info' => $modelInfo, 'alertFlag' => true));
                    return;
                }
            }
        }

        $this->render('PRindex',array('Password'=>$modelPass,'Info'=>$modelInfo, 'alertFlag'=>false));
	}

    public function accessRules()
    {
        return array(

            array('allow',  // allow all users to perform 'index' and 'view' actions
                'users'=>array('@'),
            ),

            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

	// Uncomment the following methods and override them if needed

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