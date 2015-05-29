<?php

class PRController extends Controller
{
	public function actionindex()
	{
        $modelPass=new PRPassword;
        $modelInfo=new PRInfo;
        $userInfo = Comand::model()->findByAttributes(array('Name'=>Yii::app()->user->name));

        $modelInfo->phone = $userInfo->Phone;
        //TODO: раскомментить когда будет добавлен емэйл в таблицу команд
        //$modelInfo->mail = $userInfo->Mail;
        $modelInfo->mail = 'пусто@пус.то';
        $modelInfo->inform = $userInfo->Description;

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
                //TODO: тут сохраняется вся модель. Надо быть осторожным с этим местом.
                $userInfo->Pass = CPasswordHelper::hashPassword($modelPass->newpassword);
                $userInfo->save();
                $this->render('PRindex',array('Password'=>$modelPass,'Info'=>$modelInfo, 'alertFlag'=>true));
                return;
            }
        }

        if(isset($_POST['PRInfo']))
        {
            $modelInfo->attributes=$_POST['PRInfo'];
            if($modelInfo->validate())
            {
                $userInfo->Phone = $modelInfo->phone;
                $userInfo->Description = $modelInfo->inform;
                $userInfo->save();
                $this->render('PRindex',array('Password'=>$modelPass,'Info'=>$modelInfo, 'alertFlag'=>true));
                return;
            }
        }

        $this->render('PRindex',array('Password'=>$modelPass,'Info'=>$modelInfo, 'alertFlag'=>false));
	}

    public function accessRules()
    {
        return array(

            //TODO: когда будут роли, админу надо разрешить личный кабинет
            array('deny',  // allow all users to perform 'index' and 'view' actions
                'users'=>array('admin'),
            ),

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