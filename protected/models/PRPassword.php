<?php

class PRPassword extends CFormModel
{
    public $oldpassword;
    public $newpassword;
    public $confpassword;
   // public $rememberMe=false;

    private $_identity;

    public function rules()
    {
        return array(
            array('oldpassword, newpassword, confpassword', 'required'),
        //    array('rememberMe', 'boolean'),
        //    array('password', 'authenticate'),
            array('oldpassword','passvalidate'),
            array('confpassword','equation')
        );
    }

    public function equation($attribute,$params)
    {
        if($this->newpassword != $this->confpassword) {
            $this->addError('confpassword', 'Пароли не совпадают');
        }
    }

    public function passvalidate($attribute,$params)
    {
        $modelPR=Comand::model()->findByAttributes(array('Name'=>Yii::app()->user->name));

        if($modelPR == NULL)
            $this->addError('oldpassword','Пусто');
        elseif(!CPasswordHelper::verifyPassword($this->oldpassword, $modelPR->Pass))
            $this->addError('oldpassword','Неправильный пароль.');

    }

   /* public function authenticate($attribute,$params)
    {
        $this->_identity=new UserIdentity($this->username,$this->password);
        if(!$this->_identity->authenticate())
            $this->addError('password','Неправильное имя пользователя или пароль.');
    }*/
}